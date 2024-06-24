<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Importacao extends Model
{
    protected $table = 'importacao';

	protected $fillable = [
		'aliquota',
        'iof',
        // 'subtotal',
        // 'total',
        'ndoc_importacao',
        'ddoc_importacao',
        'local_desembaraco',
        'uf_desembaraco',
        'data_desembaraco',
        'via_transporte',
        'intermediacao',
        'adicao',
        'seq_adicao',
        'fabricante',
        'afrmm',
        'cnpj_terceiro',
        'uf_terceiro',
        'cod_exportador',
        'nfci'
	];
}
