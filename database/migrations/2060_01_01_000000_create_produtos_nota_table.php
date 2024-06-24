<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosNotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_nota', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('quantidade');
            $table->string('total');

            $table->bigInteger('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('produtos');

            $table->bigInteger('nota_fiscal_id')->unsigned();
            $table->foreign('nota_fiscal_id')->references('id')->on('nota_fiscal');

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
        Schema::dropIfExists('produtos_nota');
    }
}
