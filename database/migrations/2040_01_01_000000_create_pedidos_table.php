<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('presenca');
            $table->string('modalidade_frete');
            $table->string('frete');
            $table->string('desconto');
            $table->string('total')->nullable();
            $table->string('despesas_acessorias')->nullable();
            $table->string('despesas_aduaneiras')->nullable();
            $table->string('informacoes_fisco')->nullable();
            $table->string('informacoes_complementares')->nullable();
            $table->string('observacoes_contribuinte')->nullable();

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
        Schema::dropIfExists('pedidos');
    }
}
