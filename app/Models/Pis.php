<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pis extends Model
{
    protected $table = 'pis';

	protected $fillable = [
		'situacao_tributaria',
        'aliquota'
	];
}
