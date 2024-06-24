<?php

namespace App\Http\Controllers;

use App\Models\Ipi;
use App\Models\Pis;
use App\Models\Icms;
use App\Models\Cofins;
use App\Models\Imposto;
use App\Models\Produto;
use App\Models\Exportacao;
use App\Models\Importacao;
use App\Http\Requests\ProdutoSalvarRequest;
use App\Http\Resources\Produto\ProdutoResource;
use App\Http\Resources\Produto\ListaProdutosResource;
use App\Http\Resources\Produto\SelectProdutosResource;

/**
 * @group Produto
 */
class ProdutoController extends Controller
{
    protected $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    /**
     * Produtos
     * 
     * Retorna um objeto contendo dados dos produtos cadastrados
     * 
     * @apiResourceCollection App\Http\Resources\Produto\ListaProdutosResource
     * @apiResourceModel App\Models\Produto
     * @authenticated
     * 
     * @queryParam paginate Indica se o retorno vem sem páginação, para isso o parâmetro deve receber o valor 0 ou false. Example: 0
     */
    public function produtos()
    {
        $query = $this->produto->orderBy('nome');

        if(request('paginate') == 'false' || request('paginate') == '0') {
            $produtos = $query->get();
        } else {
            $produtos = $query->paginate(10);
        }

        if(request('select') == '1') {
            return SelectProdutosResource::collection($produtos);
        }
        
        return ListaProdutosResource::collection($produtos);
    }

    /**
     * Produto
     * 
     * Retorna um objeto contendo dados de um produto cadastrado
     * 
     * @apiResourceCollection App\Http\Resources\Produto\ProdutoResource
     * @apiResourceModel App\Models\Produto
     * @authenticated
     * 
     * @urlParam produto Id do produto Example: 1
     */
    public function produto(Produto $produto)
    {
        $produto->load(['impostos' => function($impostos) {
            // $impostos->with('icms', 'ipi', 'pis', 'cofins', 'importacao', 'exportacao');
            $impostos->with('icms', 'ipi', 'pis', 'cofins', 'importacao');
        }]);

        return new ProdutoResource($produto);
    }

    /**
     * Salvar/Editar
     * 
     * Salva um novo produto ou sobrescreve os dados de um produto já existente
     * 
     * @apiResourceModel App\Models\Produto
     * @authenticated
     * 
     * @bodyParam id int Informar no caso de edição de dados de um produto Example: 1
     * @bodyParam nome string required
     * @bodyParam codigo string required
     * @bodyParam ean string
     * @bodyParam ncm string
     * @bodyParam cest string
     * @bodyParam quantidade string
     * @bodyParam unidade string
     * @bodyParam origem string
     * @bodyParam subtotal string
     * @bodyParam total string
     * @bodyParam impostos object
     * @bodyParam impostos.icms object required
     * @bodyParam impostos.icms.codigo_cfop string required Código Fiscal de Operações e Prestações (CFOP)
     * @bodyParam impostos.icms.situacao_tributaria string required Código da situação tributária
     * @bodyParam impostos.icms.tipo_tributacao required string
     * @bodyParam impostos.icms.aliquota_credito string
     * @bodyParam impostos.icms.aliquota_mva string
     * @bodyParam impostos.icms.aliquota_importacao string
     * @bodyParam impostos.icms.aliquota_reducao_st string
     * @bodyParam impostos.icms.bc_st_retido string
     * @bodyParam impostos.icms.aliquota_st_retido string
     * @bodyParam impostos.icms.valor_st_retido string
     * @bodyParam impostos.icms.valor_fcp_retido string
     * @bodyParam impostos.icms.aliquota_fcp_retido string
     * @bodyParam impostos.icms.icms_efetivo string
     * @bodyParam impostos.icms.industria string
     * @bodyParam impostos.ipi object required
     * @bodyParam impostos.ipi.situacao_tributaria string required
     * @bodyParam impostos.ipi.codigo_enquadramento string required
     * @bodyParam impostos.ipi.aliquota string required
     * @bodyParam impostos.pis object required
     * @bodyParam impostos.pis.situacao_tributaria string required
     * @bodyParam impostos.pis.aliquota string required
     * @bodyParam impostos.cofins object required
     * @bodyParam impostos.cofins.situacao_tributaria string required
     * @bodyParam impostos.cofins.aliquota string required
     */
     public function salvar(ProdutoSalvarRequest $request) {

        $dados = $request->all();

        $impostos = $dados['impostos'];

        if(!array_key_exists('id', $dados)) {

            $icms = Icms::create($impostos['icms']);
            $ipi = Ipi::create($impostos['ipi']);
            $pis = Pis::create($impostos['pis']);
            $cofins = Cofins::create($impostos['cofins']);

            $importacao = null;
            $exportacao = null;

            if(data_get($dados, 'impostos.show_tab_importacao')) {
                $importacao = Importacao::create($impostos['importacao']);
            }
            if(data_get($dados, 'impostos.show_tab_exportacao')) {
                $exportacao = Exportacao::create($impostos['exportacao']);
            }

            $imposto = Imposto::create([
                'icms_id' => $icms->id,
                'ipi_id' => $ipi->id,
                'pis_id' => $pis->id,
                'cofins_id' => $cofins->id,
                'importacao_id' => $importacao ? $importacao->id : null,
                'exportacao_id' => $exportacao ? $exportacao->id : null
            ]);

            $produto = (new Produto)->fill($dados);
            $produto->impostos_id = $imposto->id;

        } else {

            $produto = Produto::findOrFail($dados['id'])->fill($dados);
            $imposto = $produto->impostos;

            $imposto->icms->update($impostos['icms']);
            $imposto->ipi->update($impostos['ipi']);
            $imposto->pis->update($impostos['pis']);
            $imposto->cofins->update($impostos['cofins']);

            if(data_get($dados, 'impostos.show_tab_importacao') || !empty(data_get($dados, 'impostos.importacao'))) {

                if(!$imposto->importacao) {
                    $importacao = Importacao::create($impostos['importacao']);
                    $imposto->update(['importacao_id' => $importacao->id]);
                } else {
                    $imposto->importacao->update($impostos['importacao']);
                };
            }

            if(data_get($dados, 'impostos.show_tab_exportacao') || !empty(data_get($dados, 'impostos.exportacao'))) {
                if(!$imposto->exportacao) {
                    $exportacao = Exportacao::create($impostos['exportacao']);
                    $imposto->update(['exportacao_id' => $exportacao->id]);
                } else {
                    $imposto->exportacao->update($impostos['exportacao']);
                };
            }

        };

        $produto->tributos_federais = $impostos['estimativa']['tributos_federais'] ?: 0;
        $produto->tributos_estaduais = $impostos['estimativa']['tributos_estaduais'] ?: 0;
        
        $produto->save();

        return response()->json("Cadastro realizado com sucesso", 200);
    }

}
