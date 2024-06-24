<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRastroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rastro', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('lote');
            $table->string('quantidade');
            $table->string('data_fabricacao');
            $table->string('data_validade');
            $table->string('codigo_agregacao');
            
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
        Schema::dropIfExists('rastro');
    }
}
