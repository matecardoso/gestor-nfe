<?php

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ProdutoResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'apilogger'], function(){

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');

    Route::group(['middleware' => 'auth:api'], function(){

        Route::post('details', 'API\UserController@details');

        /**
        * Rotas helpers
        */
        Route::get('get/estados', 'HelperController@getEstados')->name('get.estados');
        Route::get('get/paises', 'HelperController@getPaises')->name('get.paises');

        /**
         * ClienteController
         */
        Route::post('cliente/salvar', 'ClienteController@salvar')->name('cliente.salvar');
        Route::get('cliente/{cliente}', 'ClienteController@cliente')->name('cliente');
        Route::get('clientes', 'ClienteController@clientes')->name('clientes');

        /**
         * ProdutoController
         */
        Route::post('produto/salvar', 'ProdutoController@salvar')->name('produto.salvar');
        Route::get('produto/{produto}', 'ProdutoController@produto')->name('produto');
        Route::get('produtos', 'ProdutoController@produtos')->name('produtos');

        /**
         * ImpostoController
         */
        Route::get('opcoes/form-icms', 'ImpostoController@opcoesFormIcms')->name('opcoes.form-icms');
        Route::get('opcoes/form-ipi', 'ImpostoController@opcoesFormIpi')->name('opcoes.form-ipi');
        Route::get('opcoes/form-pis', 'ImpostoController@opcoesFormPis')->name('opcoes.form-pis');
        Route::get('opcoes/form-cofins', 'ImpostoController@opcoesFormCofins')->name('opcoes.form-cofins');
        Route::get('opcoes/form-importacao', 'ImpostoController@opcoesFormImportacao')->name('opcoes.form-importacao');
        Route::get('opcoes/form-exportacao', 'ImpostoController@opcoesFormExportacao')->name('opcoes.form-exportacao');
        Route::get('opcoes/form-detalhamento', 'ImpostoController@opcoesFormDetalhamento')->name('opcoes.form-detalhamento');

        Route::get('opcoes/forms-impostos', 'ImpostoController@opcoesFormsImpostos')->name('opcoes.forms-impostos');

        /**
         * NotaFiscalController
         */
        Route::post('nota-fiscal/enviar', 'NotaFiscalController@enviar')->name('nota-fiscal.enviar');
        Route::post('nota-fiscal/cancelar', 'NotaFiscalController@cancelar')->name('nota-fiscal.cancelar');
        Route::post('nota-fiscal/carta-correcao', 'NotaFiscalController@cartaCorrecao')->name('nota-fiscal.carta-correcao');
        Route::post('nota-fiscal/inutilizar-numeracao', 'NotaFiscalController@inutilizarNumeracao')->name('nota-fiscal.inutilizar-numeracao');
        Route::get('nota-fiscal/notas', 'NotaFiscalController@notas')->name('nota-fiscal.notas');

        Route::post('nota-fiscal/devolucao', 'NotaFiscalController@devolucao')->name('nota-fiscal.devolucao');

        Route::get('nota-fiscal/nota', 'NotaFiscalController@nota')->name('nota-fiscal.nota');

    });

    /**
     * ConfiguracaoController
     */
    Route::get('nota-fiscal/configuracao/unidades', 'ConfiguracaoController@unidades')->name('configuracao.unidades');
    Route::get('nota-fiscal/configuracao/opcoes-unidades', 'ConfiguracaoController@opcoesUnidades')->name('configuracao.opcoes-unidades');
    Route::post('nota-fiscal/configuracao/unidades/cadastrar', 'ConfiguracaoController@cadastroUnidade')->name('configuracao.unidades.cadastrar');

});
