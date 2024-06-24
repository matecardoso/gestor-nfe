<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\NotaFiscal;
use App\Models\WebManiaBr;
use Illuminate\Http\Request;
use App\Services\ClienteService;
use App\Services\WebManiaBrService;
use App\Http\Resources\NotaFiscalResource;
use App\Http\Requests\NotaFiscalEnviarRequest;

class NotaFiscalController extends Controller
{
    function __construct(){
        $this->webmaniabr = new WebManiaBr();
        $this->webmaniabrService = new WebManiaBrService();
        $this->notaFiscal = new NotaFiscal();
        $this->clienteService = new ClienteService();
    }

    public function index()
    {
        $tiposPessoa = json_encode(Cliente::getTiposPessoa());

        return view('nota-fiscal.index', compact('tiposPessoa'));
    }

    public function notas() {

        $query = $this->notaFiscal->orderBy('created_at', 'desc')->paginate(10);
        
        return NotaFiscalResource::collection($query);
    }

    public function nota() {

        $query = NotaFiscal::where('chave', request('chave'))->get();
        
        return NotaFiscalResource::collection($query)->first();
    }

    public function devolucao(Request $request) {

        // $nota = NotaFiscal::where('chave', request('chave'))->get();
        // dd(request('produtos'));

        // return response()->json($request->all());

        // $produtos = [];
        // $quantidades = [];
        // foreach(request('produtos')['ativo'] as $chave => $valor) {
        //     if($valor) {
        //         array_push($produtos, $chave);
        //         array_push($quantidades, request('produtos')['quantidade'][$chave]);
        //     };
        // };

        $produtos = request('produtos');
        $quantidades = request('quantidade');

        $retorno = $this->webmaniabrService->devolucao(request('chave'), request('natureza_operacao'), 2, request('cfop'), $produtos, $quantidades);

        return response()->json($retorno);
    }

    private function trataEnvio(Array $request) {

        // return response()->json($request);

        $dados = $this->webmaniabr->normalizaDadosEmissaoNota($request);

        // return response()->json($dados);
        // dd($dados);
        
        // 1 : 'NF-e normal'
        // 2 : 'NF-e complementar'
        // 3 : 'NF-e de ajuste'
        // 4 : 'Devolução/Retorno'
        // 5 : 'Carta de Correção'
        // 6 : 'Inutilizar Numeração'

        if($dados['finalidade'] == 1 || $dados['finalidade'] == 4) {
            
            $retorno = $this->webmaniabrService->emissao($dados);

        } elseif($dados['finalidade'] == 2) {
            
            $retorno = $this->webmaniabrService->complementar($dados);

        } elseif($dados['finalidade'] == 3) {
           
            $retorno = $this->webmaniabrService->ajuste($dados);

        } elseif($dados['finalidade'] == 5) {

            $retorno = $this->webmaniabrService->cartaCorrecao($dados);

        } elseif($dados['finalidade'] == 6) {

            $retorno = $this->webmaniabrService->inutilizarNumeracao($dados);

        };

        if(array_key_exists('status', $retorno) ) {

            if(array_key_exists('salvar_cliente', $request['cliente'])) {
                $this->clienteService->salvar($request['cliente']);
            }

            $this->notaFiscal->chave = $retorno['chave'];
            $this->notaFiscal->dados_formulario = $request;
            $this->notaFiscal->dados_envio = $dados;
            
            $this->notaFiscal->dados_retorno = $retorno;
            $this->notaFiscal->save();

        };

        return response()->json($retorno);
    }

    /**
     *  @SWG\Post(
     *      path="/nota-fiscal/enviar",
     *      tags={"Nota-fiscal"},
     *      summary="Enviar nota fiscal para api",
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Dados para envio da nota fiscal",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              required={
     *                  "nome", "codigo"
     *              },
     *              @SWG\Property(property="operacao", type="string"),
     *              @SWG\Property(property="natureza_operacao", type="string"),
     *              @SWG\Property(property="modelo", type="string"),
     *              @SWG\Property(property="finalidade", type="string"),
     *              @SWG\Property(property="ambiente", type="string"),
     *              @SWG\Property(property="cliente", 
     *                  type="object",
     *                  @SWG\Property(property="cpf", type="string"),
     *                  @SWG\Property(property="nome_completo", type="string"),
     *                  @SWG\Property(property="cnpj", type="string"),
     *                  @SWG\Property(property="razao_social", type="string"),
     *                  @SWG\Property(property="ie", type="string"), 
     *                  @SWG\Property(property="suframa", type="string"), 
     *                  @SWG\Property(property="substituto_tributario", type="string"),
     *                  @SWG\Property(property="consumidor_final", type="string"),
     *                  @SWG\Property(property="contribuinte", type="string"),
     *                  @SWG\Property(property="endereco", type="string"),
     *                  @SWG\Property(property="complemento", type="string"),
     *                  @SWG\Property(property="numero", type="string"),
     *                  @SWG\Property(property="bairro", type="string"),
     *                  @SWG\Property(property="cidade", type="string"),
     *                  @SWG\Property(property="uf", type="string"), 
     *                  @SWG\Property(property="cep", type="string"),
     *                  @SWG\Property(property="telefone", type="string"),
     *                  @SWG\Property(property="email", type="string"),
     *                  @SWG\Property(property="produtos", type="string"),
     *                  @SWG\Property(property="pedido", type="string"),
     *                  @SWG\Property(property="transporte", type="string"),
     *              ),
     *              @SWG\Property(property="produtos", 
     *                  type="array",
     *                  description="Um array contendo multiplos objetos de cada produto",
     *                  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="item", type="string"),
     *                      @SWG\Property(property="nome", type="string"),
     *                      @SWG\Property(property="codigo", type="string"),
     *                      @SWG\Property(property="ncm", type="string"),
     *                      @SWG\Property(property="cest", type="string"),
     *                      @SWG\Property(property="quantidade", type="string"),
     *                      @SWG\Property(property="unidade", type="string"),
     *                      @SWG\Property(property="peso", type="string"),
     *                      @SWG\Property(property="origem", type="string"),
     *                      @SWG\Property(property="desconto", type="string"),
     *                      @SWG\Property(property="subtotal", type="string"),
     *                      @SWG\Property(property="total", type="string"),
     *                      @SWG\Property(property="tributos_federais", type="string"),
     *                      @SWG\Property(property="tributos_estaduais", type="string"),
     *                      @SWG\Property(property="impostos", 
     *                           type="object",
     *                           @SWG\Property(property="icms", 
     *                               type="object",
     *                               @SWG\Property(property="codigo_cfop", type="string"),                            
     *                               @SWG\Property(property="situacao_tributaria", type="string"),                            
     *                               @SWG\Property(property="aliquota_reducao", type="string"),                            
     *                               @SWG\Property(property="aliquota_credito", type="string"),                            
     *                               @SWG\Property(property="aliquota_mva", type="string"),                            
     *                               @SWG\Property(property="aliquota_diferimento", type="string"),                            
     *                               @SWG\Property(property="aliquota_importacao", type="string"),                            
     *                               @SWG\Property(property="aliquota_reducao_st", type="string"),                            
     *                               @SWG\Property(property="motivo_desoneracao", type="string"),                            
     *                               @SWG\Property(property="bc_st_retido", type="string"),                            
     *                               @SWG\Property(property="aliquota_st_retido", type="string"),                            
     *                               @SWG\Property(property="valor_st_retido", type="string"),                            
     *                               @SWG\Property(property="valor_fcp_retido", type="string"),                            
     *                               @SWG\Property(property="aliquota_fcp_retido", type="string"),                            
     *                               @SWG\Property(property="icms_efetivo", type="string"),                            
     *                               @SWG\Property(property="industria", type="string"),                            
     *                           ),
     *                           @SWG\Property(property="ipi", 
     *                               type="object",
     *                               @SWG\Property(property="situacao_tributaria", type="string"),  
     *                               @SWG\Property(property="codigo_enquadramento", type="string"),  
     *                               @SWG\Property(property="aliquota", type="string"),  
     *                               @SWG\Property(property="codigo_selo", type="string"),  
     *                               @SWG\Property(property="qtd_selo", type="string"),
     *                           ),
     *                           @SWG\Property(property="pis", 
     *                               type="object",
     *                               @SWG\Property(property="situacao_tributaria", type="string"),
     *                               @SWG\Property(property="aliquota", type="string"),
     *                           ),
     *                           @SWG\Property(property="cofins", 
     *                               type="object",
     *                               @SWG\Property(property="situacao_tributaria", type="string"),
     *                               @SWG\Property(property="aliquota", type="string"),
     *                           ),
     *                      ),
     *                  ),
     *              ),
     *              @SWG\Property(property="pedido", 
     *                   type="object",
     *                   @SWG\Property(property="presenca", type="string"),
     *                   @SWG\Property(property="modalidade_frete", type="string"),
     *                   @SWG\Property(property="frete", type="string"),
     *                   @SWG\Property(property="desconto", type="string"),
     *                   @SWG\Property(property="total", type="string"),
     *                   @SWG\Property(property="despesas_acessorias", type="string"),
     *                   @SWG\Property(property="despesas_aduaneiras", type="string"),
     *                   @SWG\Property(property="informacoes_fisco", type="string"),
     *                   @SWG\Property(property="informacoes_complementares", type="string"),
     *                   @SWG\Property(property="observacoes_contribuinte", type="string"),
     *              ),
     *              @SWG\Property(property="transporte", 
     *                   type="object",
     *                   @SWG\Property(property="volume", type="string"),
     *                   @SWG\Property(property="especie", type="string"),
     *                   @SWG\Property(property="peso_bruto", type="string"),
     *                   @SWG\Property(property="peso_liquido", type="string"),
     *                   @SWG\Property(property="marca", type="string"),
     *                   @SWG\Property(property="numeracao", type="string"),
     *                   @SWG\Property(property="lacres", type="string"),
     *                   @SWG\Property(property="cnpj", type="string"),
     *                   @SWG\Property(property="razao_social", type="string"),
     *                   @SWG\Property(property="ie", type="string"),
     *                   @SWG\Property(property="cpf", type="string"),
     *                   @SWG\Property(property="nome_completo", type="string"),
     *                   @SWG\Property(property="endereco", type="string"),
     *                   @SWG\Property(property="uf", type="string"),
     *                   @SWG\Property(property="cidade", type="string"),
     *                   @SWG\Property(property="cep", type="string"),
     *                   @SWG\Property(property="placa", type="string"),
     *                   @SWG\Property(property="uf_veiculo", type="string"),
     *                   @SWG\Property(property="rntc", type="string"),
     *                   @SWG\Property(property="seguro", type="string"),
     *                   @SWG\Property(property="reboque_placa", type="string"),
     *                   @SWG\Property(property="reboque_uf_veiculo", type="string"),
     *                   @SWG\Property(property="reboque_rntc", type="string"),
     *                   @SWG\Property(property="vagao", type="string"),
     *                   @SWG\Property(property="balsa", type="string"),
     *              ),
     *          ),       
     *      ),
     *      @SWG\Response(response=200, description="Successful operation"),
     *      @SWG\Response(response=400, description="Bad request"),
     *      @SWG\Response(response=404, description="Resource Not Found")
     *  )
     */

    /**
     * 
     * @group Nota Fiscal
     * 
     * Enviar
     * 
     * Envia dados para api de emissão de nota fiscal
     * 
     * Required dos campos podem variar conforme o valor da finalidade
     * 
     * Nos campos obrigatórios pela finalidade possuem em sua descrição '*' seguido pelo valor da finalidade onde é obrigatório
     * 
     * Valores das finalidades:
     * 
     * 1 : NF-e normal
     * 
     * 2 : NF-e complementar
     * 2.1 : Preço e/ou quantidade
     * 2.2 : Imposto Complementar
     * 
     * 3 : NF-e de ajuste
     * 
     * 4 : Devolução/Retorno
     * 
     * 5 : Carta de Correção
     * 
     * 6 : Inutilizar Numeração
     * 
     * Mais infos: https://webmaniabr.com/docs/rest-api-nfe/
     *  
     * @apiResourceModel App\Models\NotaFiscal
     * @authenticated
     * 
     * @bodyParam operacao array required 
     * @bodyParam operacao.ambiente string *1, 2, 3
     * @bodyParam operacao.operacao string *1, 2, 3
     * @bodyParam operacao.natureza_operacao string *1, 2, 3
     * @bodyParam operacao.modelo string *1
     * @bodyParam operacao.finalidade string required 1 : NF-e normal, 2 : NF-e complementar, 3 : NF-e de ajuste, 4 : Devolução/Retorno, 5 : Carta de Correção, 6 : Inutilizar Numeração
     * @bodyParam operacao.nfe_complementar string *2
     * @bodyParam operacao.nfe_referenciada string *2 Chave de acesso da NF-e emitida anteriormente, 4: Chave de acesso da NF-e emitida anteriormente
     * @bodyParam operacao.codigo_cfop string *3, 4: Para Notas Fiscais emitidas com Impostos via API: Código CFOP de devolução
     * @bodyParam operacao.valor_icms string *3
     * @bodyParam operacao.classe_imposto string *4 Para Notas Fiscais emitidas com Classe de Imposto: Classe de imposto de devolução.
     * @bodyParam operacao.chave string *5 Chave de acesso da NF-e
     * @bodyParam operacao.correcao string *5 Justificativa da correção
     * @bodyParam cliente object *1, 2, 3
     * @bodyParam cliente.tipo_pessoa string
     * @bodyParam cliente.nome_completo string *Pessoa Física
     * @bodyParam cliente.cpf_cnpj string
     * @bodyParam cliente.razao_social string
     * @bodyParam cliente.ie string *Caso isento deve trazer o valor 0 (zero)
     * @bodyParam cliente.suframa string *Pessoa Jurídica
     * @bodyParam cliente.substituto_tributario string
     * @bodyParam cliente.consumidor_final string
     * @bodyParam cliente.contribuinte string
     * @bodyParam cliente.endereco string required
     * @bodyParam cliente.complemento string
     * @bodyParam cliente.numero string required
     * @bodyParam cliente.bairro string required
     * @bodyParam cliente.cidade string required
     * @bodyParam cliente.uf string required
     * @bodyParam cliente.cep string required
     * @bodyParam cliente.telefone string
     * @bodyParam cliente.email string
     * @bodyParam produtos array *1 Contém objetos com os dados dos produtos, 2 ou 3: Obrigatório para complemento de preço e/ou quantidade: Informações somente dos produtos complementares
     * @bodyParam produtos.* object
     * @bodyParam produtos.*.item string
     * @bodyParam produtos.*.nome string required
     * @bodyParam produtos.*.codigo string required Código do produto (Tag cProd do XML)
     * @bodyParam produtos.*.ncm string required
     * @bodyParam produtos.*.cest string *Identificado automaticamente de acordo com o NCM. Caso seja identificado mais de um código CEST para o mesmo NCM será obrigatório informar o código correto.
     * @bodyParam produtos.*.quantidade string *1 required, 2.1: Obrigatório para complementar quantidade: Quantidade de itens
     * @bodyParam produtos.*.unidade string required
     * @bodyParam produtos.*.peso string *Caso não seja informado o peso do produto é obrigatório informar o Peso Bruto e Peso Líquido dentro da array transporte.
     * @bodyParam produtos.*.origem string required
     * @bodyParam produtos.*.desconto string
     * @bodyParam produtos.*.subtotal string *1 required, 2.1: Obrigatório para complementar preço: Preço unitário do produto
     * @bodyParam produtos.*.total string *1 required, 2.1: Obrigatório para complementar preço: Preço total (quantidade x preço unitário)
     * @bodyParam produtos.*.tributos_federais string
     * @bodyParam produtos.*.tributos_estaduais string
     * @bodyParam produtos.*.codigo_cfop *1 Código Fiscal de Operações e Prestações (CFOP), 2 Código Fiscal de Operações e Prestações (CFOP) Informar o código CFOP da operação do ICMS complementar
     * @bodyParam produtos.*.impostos object
     * @bodyParam produtos.*.impostos.icms object required
     * @bodyParam produtos.*.impostos.icms.situacao_tributaria string *1 Código da situação tributária, 2.1 Código da situação tributária Informar a situação tributária da operação do ICMS complementar, 2.2 Obrigatório para complementar ICMS e ICMS-ST: Código da situação tributária Informar a situação tributária da operação do ICMS complementar
     * @bodyParam produtos.*.impostos.icms.tipo_tributacao string
     * @bodyParam produtos.*.impostos.icms.aliquota_credito string
     * @bodyParam produtos.*.impostos.icms.aliquota_mva string
     * @bodyParam produtos.*.impostos.icms.aliquota_importacao string
     * @bodyParam produtos.*.impostos.icms.aliquota_reducao_st string
     * @bodyParam produtos.*.impostos.icms.bc_st_retido string
     * @bodyParam produtos.*.impostos.icms.aliquota_st_retido string
     * @bodyParam produtos.*.impostos.icms.valor_st_retido string
     * @bodyParam produtos.*.impostos.icms.valor_fcp_retido string
     * @bodyParam produtos.*.impostos.icms.aliquota_fcp_retido string
     * @bodyParam produtos.*.impostos.icms.icms_efetivo string
     * @bodyParam produtos.*.impostos.icms.industria string
     * @bodyParam produtos.*.impostos.ipi object required
     * @bodyParam produtos.*.impostos.ipi.situacao_tributaria string required
     * @bodyParam produtos.*.impostos.ipi.codigo_enquadramento string required
     * @bodyParam produtos.*.impostos.ipi.aliquota string required
     * @bodyParam produtos.*.impostos.pis object required
     * @bodyParam produtos.*.impostos.pis.situacao_tributaria string required
     * @bodyParam produtos.*.impostos.pis.aliquota string required
     * @bodyParam produtos.*.impostos.cofins object required
     * @bodyParam produtos.*.impostos.cofins.situacao_tributaria string required
     * @bodyParam produtos.*.impostos.cofins.aliquota string required
     * @bodyParam produtos array 4: Obrigatório para devolução parcial: Número sequencial dos produtos Para a devolução parcial dos produtos é necessário informar quais produtos serão devolvidos, indique por ordem sequencial. Por exemplo, caso os produtos devolvidos sejam o segundo e o terceiro da nota fiscal indique o número 2 e 3 na array.
     * @bodyParam quantidade array 4: Opcional para devolução parcial: Número da quantidade de unidades devolvidas na devolução parcial. Indique na ordem correspondente da array produtos.
     * @bodyParam impostos array *2.2 ou 3: Obrigatório para complemento do ICMS, ICMS-ST e IPI: Informações somente dos impostos complementares
     * @bodyParam impostos string *2.2 Obrigatório para complementar ICMS: Base de cálculo do complemento do ICMS
     * @bodyParam impostos.bc_icms string *2.2 Obrigatório para complementar ICMS: Base de cálculo do complemento do ICMS
     * @bodyParam impostos.valor_icms string *2.2 Obrigatório para complementar ICMS: Valor do complemento do ICMS
     * @bodyParam impostos.bc_icms_st string *2.2 Obrigatório para complementar ICMS-ST: Base de cálculo do complemento do ICMS-ST
     * @bodyParam impostos.valor_icms_st string *2.2 Obrigatório para complementar ICMS-ST: Valor do complemento do ICMS-ST
     * @bodyParam impostos.aliquota_mva string *2.2 Obrigatório para complementar ICMS-ST: Percentual da Margem de Valor Agregado Original (MVA/IVA)
     * @bodyParam impostos.bc_ipi string *2.2 Obrigatório para complementar IPI: Base de cálculo do complemento do IPI
     * @bodyParam impostos.valor_ipi string *2.2 Obrigatório para complementar IPI: Valor do complemento do IPI
     * @bodyParam transporte array required
     * @bodyParam transporte.peso_bruto string
     * @bodyParam transporte.peso_liquido string
     * @bodyParam transporte.volume string
     * @bodyParam transporte.especie string
     * @bodyParam transporte.marca string
     * @bodyParam transporte.numeracao string
     * @bodyParam transporte.lacres string
     * @bodyParam transporte.uf string A UF deve ser informada se informado uma IE. Informar "EX" para Exterior.
     * @bodyParam transporte.razao_social string
     * @bodyParam transporte.cnpj string
     * @bodyParam transporte.ie string 0 - Isento ou Nº da Inscrição Estadual
     * @bodyParam transporte.cep string
     * @bodyParam transporte.endereco string
     * @bodyParam transporte.cidade string
     * @bodyParam transporte.placa string Informar em um dos seguintes formatos: XXX9999, XXX999, XX9999 ou XXXX999.
     * @bodyParam transporte.uf_veiculo string
     * @bodyParam transporte.rntc string Registro Nacional de Transportador de Carga (ANTT)
     * @bodyParam transporte.seguro string
     * @bodyParam transporte.reboque_placa string
     * @bodyParam transporte.reboque_uf_veiculo string
     * @bodyParam transporte.reboque_rntc string
     * @bodyParam transporte.vagao string
     * @bodyParam transporte.balsa string
     * @bodyParam pedido array required
     * @bodyParam pedido.*.pagamento array required
     * @bodyParam pedido.*.pagamento.*.forma_pagamento string
     * @bodyParam pedido.*.pagamento.*.pagamento string
     * @bodyParam pedido.*.pagamento.*.valor_pagamento string
     * @bodyParam pedido.*.pagamento.*.bandeira string
     * @bodyParam pedido.*.pagamento.*.cnpj_credenciadora string
     * @bodyParam pedido.*.pagamento.*.autorizacao string
     * @bodyParam pedido.*.fatura array required
     * @bodyParam pedido.*.fatura.numero string required
     * @bodyParam pedido.*.fatura.valor string required
     * @bodyParam pedido.*.fatura.valor_liquido string required
     * @bodyParam pedido.*.fatura.desconto string required
     * @bodyParam pedido.*.parcelas array required
     * @bodyParam pedido.*.parcelas.*.vencimento string required
     * @bodyParam pedido.*.parcelas.*.valor string required
     * @bodyParam frete string required Para nota fiscal de importação não inserir o valor do frete. Podendo ser informado o valor somente no campo Informações ao Fisco.
     * @bodyParam desconto string required
     * @bodyParam despesas_acessorias string
     * @bodyParam total string
     * @bodyParam modalidade_frete string required
     * @bodyParam ID string Número do pedido de compra por produto. (Tag xPed do XML)
     * @bodyParam data_entrada_saida string
     * @bodyParam presenca string required
     * @bodyParam informacoes_complementares string
     * @bodyParam informacoes_fisco string
     * @bodyParam volume string 4: Quantidade de volumes transportados
     * 
     */
    // public function enviar(NotaFiscalEnviarRequest $request) {
    public function enviar(Request $request) {

        return $this->trataEnvio($request->all());
    }

    /**
     * 
     * @group Nota Fiscal
     * 
     * Cancelar
     * 
     * Envia dados para api de cancelamento de nota fiscal
     *  
     * @apiResourceModel App\Models\NotaFiscal
     * @authenticated
     * 
     * @bodyParam chave string required Chave de acesso da NF-e
     * @bodyParam motivo string required Justificativa do cancelamento
     * @bodyParam operacao array required 
     * @bodyParam operacao.ambiente string required
     * @bodyParam operacao.modelo string required
     * @bodyParam operacao.finalidade string required
     * 
     */
    public function cancelar(Request $request) {

        $retorno = $this->webmaniabrService->cancelar($request->get('chave'), $request->get('motivo'));

        if(!array_key_exists('error', $retorno) && $notaFiscal = NotaFiscal::where('chave', $request->get('chave'))->first()) {
            $notaFiscal->dados_cancelamento = $retorno;
            $notaFiscal->save();
        };

        return response()->json($retorno);
    }

    /**
     * 
     * @group Nota Fiscal
     * 
     * Carta de correção (CC-e)
     * 
     * A Carta de Correção Eletrônica (CC-e) é um evento legal e tem por objetivo corrigir algumas informações da NF-e que já foi emitida.
     * 
     * O que NÃO é permitido corrigir com a carta de correção?
     * 
     * - Valores como base de cálculo, alíquota, diferença de preço e quantidade.
     * 
     * - Dados cadastrais que implique mudança do remetente ou do destinatário.
     * 
     * - A data de emissão ou de saída.
     * 
     * - Série e número da nota fiscal.
     * 
     * A sua alteração não se enquadra na carta de correção?
     * 
     * Emita uma nota fiscal de devolução para anular os efeitos fiscais da NF-e emitida anteriormente, logo após emita uma nova nota fiscal normalmente.
     *  
     * @apiResourceModel App\Models\NotaFiscal
     * @authenticated
     * 
     * @bodyParam carta_correcao array required
     * @bodyParam carta_correcao.chave string required Chave de acesso da NF-e
     * @bodyParam carta_correcao.correcao string required Justificativa da correção
     * @bodyParam operacao array required 
     * @bodyParam operacao.ambiente string required
     * @bodyParam operacao.modelo string required
     * @bodyParam operacao.finalidade string required
     * 
     */
    public function cartaCorrecao(NotaFiscalEnviarRequest $request) {

        return $this->trataEnvio($request->all());
    }

    /**
     * 
     * @group Nota Fiscal
     * 
     * Inutilizar numeração
     * 
     * Inutilizar uma sequência de numeração de Nota Fiscal
     *  
     * @apiResourceModel App\Models\NotaFiscal
     * @authenticated
     * 
     * @bodyParam sequencia string required Sequência da numeração
     * @bodyParam motivo string required Justificativa da inutilização
     * @bodyParam ambiente string required Identificação do Ambiente do Sefaz
     * @bodyParam serie string required Série da numeração
     * @bodyParam modelo string required Modelo da numeração
     * 
     */
    public function inutilizarNumeracao(NotaFiscalEnviarRequest $request) {

        return $this->trataEnvio($request->all());
    }

}
