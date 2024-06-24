<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ipi extends Model
{
    protected $table = 'ipi';

	protected $fillable = [
		'situacao_tributaria',
        'codigo_enquadramento',
        'aliquota',
        'codigo_selo',
        'qtd_selo'
	];
}
