<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIcmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icms', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('codigo_cfop')->nullable();
            $table->string('tipo_tributacao')->comment('TRIBUTAÇÃO SIMPLES NACIONAL / TRIBUTAÇÃO NORMAL');
            $table->string('situacao_tributaria');
            $table->string('aliquota_credito')->nullable();
            $table->string('aliquota_reducao')->nullable();
            $table->string('aliquota_mva')->nullable();
            $table->string('aliquota_diferimento')->nullable();
            $table->string('aliquota_importacao')->nullable();
            $table->string('aliquota_reducao_st')->nullable();
            $table->string('motivo_desoneracao')->nullable();
            $table->string('bc_st_retido')->nullable();
            $table->string('aliquota_st_retido')->nullable();
            $table->string('valor_st_retido')->nullable();
            $table->string('valor_fcp_retido')->nullable();
            $table->string('aliquota_fcp_retido')->nullable();
            $table->string('industria')->nullable();

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
        Schema::dropIfExists('icms');
    }
}
