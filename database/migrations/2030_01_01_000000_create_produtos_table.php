<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('item')->nullable();
            $table->text('nome');
            $table->string('codigo')->nullable();
            $table->string('ncm');
            $table->string('unidade')->default('UN');
            $table->string('peso')->nullable();
            $table->unsignedInteger('origem')->nullable();
            $table->string('desconto')->nullable();
            $table->string('subtotal');

            $table->string('classe_imposto')->nullable()->comment('classe de imposto cadastrado no painel de controle da WebmaniaBR');

            $table->bigInteger('impostos_id')->unsigned();
            $table->foreign('impostos_id')->references('id')->on('impostos');

            $table->string('veiculo_usado')->nullable();
            $table->string('ind_escala')->nullable();
            $table->string('cnpj_fabricante')->nullable();
            $table->string('beneficio_fiscal')->nullable();
            $table->string('gtin')->nullable();
            $table->string('gtin_tributavel')->nullable();
            $table->string('cest')->nullable();
            $table->string('nve')->nullable();
            $table->string('nrecopi')->nullable();
            $table->string('informacoes_adicionais')->nullable();
            $table->string('ativo_permanente')->nullable();

            /**
             * Detalhamento específico de combustíveis, medicamentos, armamentos e veículos novos
             * deixados de lado neste momento (https://webmaniabr.com/docs/rest-api-nfe/#emitir-nfe)
             */

            // Estimativa de tributos
            /**
             * As estimativas de tributos estão disponíveis somente nas Notas Fiscais de saída 
             * referente a venda e nas de entrada referente a devolução de produtos para o consumidor final.
             * *Obrigatório caso não informado o Token IBPT
             */

            $table->string('tributos_federais')->default(0)->comment('*Obrigatório caso não informado o Token IBPT');
            $table->string('tributos_estaduais')->default(0)->comment('*Obrigatório caso não informado o Token IBPT');

            // Rastreamento do produto
            $table->bigInteger('rastro_id')->unsigned()->nullable();
            $table->foreign('rastro_id')->references('id')->on('rastro');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
