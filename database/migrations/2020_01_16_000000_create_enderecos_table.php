<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('endereco');
            $table->string('pais')->nullable();
            $table->string('complemento')->nullable();
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade')->nullable();
            $table->string('uf')->nullable();
            $table->string('cep')->nullable();

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
        Schema::dropIfExists('enderecos');
    }
}
