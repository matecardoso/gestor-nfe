<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exportacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('drawback');
            $table->string('reg_exportacao');
            $table->string('nfe_exportacao');
            $table->string('qtd_exportacao');

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
        Schema::dropIfExists('exportacao');
    }
}
