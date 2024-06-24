<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpostosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impostos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('icms_id')->unsigned()->nullable();
            $table->foreign('icms_id')->references('id')->on('icms');

            $table->bigInteger('ipi_id')->unsigned()->nullable();
            $table->foreign('ipi_id')->references('id')->on('ipi');

            $table->bigInteger('pis_id')->unsigned()->nullable();
            $table->foreign('pis_id')->references('id')->on('pis');

            $table->bigInteger('cofins_id')->unsigned()->nullable();
            $table->foreign('cofins_id')->references('id')->on('cofins');

            $table->bigInteger('importacao_id')->unsigned()->nullable();
            $table->foreign('importacao_id')->references('id')->on('importacao');

            $table->bigInteger('exportacao_id')->unsigned()->nullable();
            $table->foreign('exportacao_id')->references('id')->on('exportacao');

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
        Schema::dropIfExists('impostos');
    }
}
