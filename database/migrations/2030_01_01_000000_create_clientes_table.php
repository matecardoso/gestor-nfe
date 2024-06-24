<?php

use App\Models\Cliente;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('cpf_cnpj')->nullable();
            $table->enum('tipo_pessoa', array_keys(Cliente::getTiposPessoa()));
            $table->string('nome_completo')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('ie')->nullable();
            $table->string('suframa')->nullable();
            $table->unsignedTinyInteger('substituto_tributario')->nullable();
            $table->string('consumidor_final')->nullable();
            $table->string('contribuinte')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();

            $table->bigInteger('endereco_id')->unsigned();
            $table->foreign('endereco_id')->references('id')->on('enderecos');

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
        Schema::dropIfExists('clientes');
    }
}
