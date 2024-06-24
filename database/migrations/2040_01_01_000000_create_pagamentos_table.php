<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('pagamento');
            $table->string('forma_pagamento');
            $table->string('tipo_integracao');
            $table->string('valor_pagamento');
            $table->string('cnpj_credenciadora');
            $table->string('bandeira');
            $table->string('autorizacao');

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
        Schema::dropIfExists('pagamentos');
    }
}
