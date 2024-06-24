<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('aliquota');
            $table->string('iof')->nullable();
            // $table->string('subtotal');
            // $table->string('total');
            $table->string('ndoc_importacao');
            $table->string('ddoc_importacao');
            $table->string('local_desembaraco');
            $table->string('uf_desembaraco');
            $table->string('data_desembaraco');
            $table->string('via_transporte');
            $table->string('forma_intermediacao');
            $table->string('adicao');
            $table->string('seq_adicao');
            $table->string('fabricante');
            $table->string('afrmm')->nullable();
            $table->string('cnpj_terceiro')->nullable();
            $table->string('uf_terceiro')->nullable();
            $table->string('cod_exportador')->nullable();
            $table->string('nfci')->nullable();

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
        Schema::dropIfExists('importacao');
    }
}
