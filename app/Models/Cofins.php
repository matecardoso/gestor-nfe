<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cofins extends Model
{
    protected $table = 'cofins';

	protected $fillable = [
		'situacao_tributaria',
        'aliquota'
	];
}
