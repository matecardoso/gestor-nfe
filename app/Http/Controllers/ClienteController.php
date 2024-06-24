<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Services\ClienteService;
use App\Http\Resources\ClienteResource;
use App\Http\Requests\ClienteSalvarRequest;

/**
 * @group Cliente
 */
class ClienteController extends Controller
{
    protected $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
        $this->clienteService = new ClienteService();
    }

    /**
     * @SWG\Get(
     *    path="/clientes",
     *    tags={"Clientes"},
     *    summary="Lista de de clientes cadastrados",
     *    @SWG\Parameter(
     *        name="paginate",
     *        description="Indica se o retorno vem sem páginação, para isso o parâmetro deve receber o valor 0 ou false",
     *        required=false,
     *        in="query",
     *        type="boolean"
     *    ),
     *    @SWG\Response(response=200, description="Successful operation"),
     *    @SWG\Response(response=400, description="Bad request"),
     *    @SWG\Response(response=404, description="Resource Not Found"),
     *    @SWG\Response(response="500", description="Internal Server Error"),
     *    security={{"Bearer":{}}}
     * )
     */

    /**
     * Clientes
     * 
     * Retorna um objeto contendo dados dos clientes cadastrados
     * 
     * @apiResourceCollection App\Http\Resources\ClienteResource
     * @apiResourceModel App\Models\Cliente
     * @authenticated
     * 
     * @queryParam paginate Indica se o retorno vem sem páginação, para isso o parâmetro deve receber o valor 0 ou false. Example: 0
     */
    public function clientes()
    {
        if(request('tipo')) {
            $query = $this->cliente->whereTipoPessoa(request('tipo'))->orderBy('nome_completo');
        } else {
            $query = $this->cliente->orderBy('nome_completo');
        };

        if(request('paginate') == 'false' || request('paginate') == '0') {
            $clientes = $query->get();
        } else {
            $clientes = $query->paginate(10);
        }

        return ClienteResource::collection($clientes);
    }

    /**
     * @SWG\Get(
     *   path="/cliente/{cliente}",
     *   tags={"Clientes"},
     *   summary="Dados do cliente",
     *   @SWG\Parameter(
     *       name="cliente",
     *       description="Id do cliente",
     *       required=true,
     *       in="path",
     *       type="integer"
     *    ),
     *    @SWG\Response(response=200, description="Successful operation"),
     *    @SWG\Response(response=400, description="Bad request"),
     *    @SWG\Response(response=404, description="Resource Not Found"),
     *    @SWG\Response(response="500", description="Internal Server Error"),
     *    security={{"Bearer":{}}}
     * )
     */

    /**
     * Cliente
     * 
     * Retorna um objeto contendo dados de um cliente cadastrado
     * 
     * @apiResourceModel App\Models\Cliente
     * @authenticated
     * 
     * @urlParam cliente Id do cliente Example: 1
     */
    public function cliente(Cliente $cliente)
    {
        if($endereco = Endereco::find($cliente['endereco_id'])) {
            $cliente = array_merge($cliente->toArray(), $endereco->toArray());
        }

        return response()->json($cliente);
    }

    /**
     * @SWG\Post(
     *   path="/cliente/salvar",
     *   tags={"Clientes"},
     *   summary="Salvar dados do cliente",
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Dados do cliente",
     *         required=true,
     *         @SWG\Schema(
     *             type="object",
     *              required={
     *                  "tipo_pessoa", "nome_completo", "cpf_cnpj", "cep", 
     *                  "endereco", "numero", "bairro", "cidade", "uf", 
     *                  "email", "telefone" 
     *              },
     *              @SWG\Property(property="tipo_pessoa", type="string"),
     *              @SWG\Property(property="nome_completo", type="string"),
     *              @SWG\Property(property="cpf_cnpj", type="string"),
     *              @SWG\Property(property="consumidor_final", type="string"),
     *              @SWG\Property(property="cep", type="string"),
     *              @SWG\Property(property="endereco", type="string"),
     *              @SWG\Property(property="numero", type="string"),
     *              @SWG\Property(property="complemento", type="string"),
     *              @SWG\Property(property="bairro", type="string"),
     *              @SWG\Property(property="cidade", type="string"),
     *              @SWG\Property(property="uf", type="string"),
     *              @SWG\Property(property="email", type="string"),
     *              @SWG\Property(property="telefone", type="string"),
     *         )
     *     ),
     *    @SWG\Response(response=200, description="Successful operation"),
     *    @SWG\Response(response=400, description="Bad request"),
     *    @SWG\Response(response=404, description="Resource Not Found"),
     *    @SWG\Response(response="500", description="Internal Server Error"),
     *    security={{"Bearer":{}}}
     * )
     */

    /**
     * Salvar/Editar
     * 
     * Salva um novo cliente ou sobrescreve os dados de um cliente já existente
     * 
     * @apiResourceModel App\Models\Cliente
     * @authenticated
     * 
     * @bodyParam id int Informar no caso de edição de dados de um cliente Example: 1
     * @bodyParam tipo_pessoa string required Example: 1
     * @bodyParam nome_completo string required Example: 1
     * @bodyParam cpf_cnpj string required Example: 1
     * @bodyParam consumidor_final string Example: 1
     * @bodyParam cep string required Example: 1
     * @bodyParam endereco string required Example: 1
     * @bodyParam numero string required Example: 1
     * @bodyParam complemento string required Example: 1
     * @bodyParam bairro string required Example: 1
     * @bodyParam cidade string required Example: 1
     * @bodyParam uf string required Example: 1
     * @bodyParam email string required Example: 1
     * @bodyParam telefone string required Example: 1
     */
    public function salvar(ClienteSalvarRequest $request) {

        $this->clienteService->salvar($request->all());

        return response()->json("Cadastro realizado com sucesso", 200);
    }

}
