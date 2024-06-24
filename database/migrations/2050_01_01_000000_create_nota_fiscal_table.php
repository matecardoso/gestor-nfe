<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaFiscalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_fiscal', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('chave');

            $table->json('dados_formulario');

            $table->json('dados_envio');

            $table->json('dados_retorno');

            $table->json('dados_cancelamento')->nullable();

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
        Schema::dropIfExists('nota_fiscal');
    }
}
