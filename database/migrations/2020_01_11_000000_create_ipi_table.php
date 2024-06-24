<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipi', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('situacao_tributaria');
            $table->string('codigo_enquadramento');
            $table->float('aliquota')->default(0);
            $table->string('codigo_selo')->nullable();
            $table->string('qtd_selo')->nullable();

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
        Schema::dropIfExists('ipi');
    }
}
