<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exportacao extends Model
{
    protected $table = 'exportacao';

	protected $fillable = [
		'drawback',
        'reg_exportacao',
        'nfe_exportacao',
        'qtd_exportacao',
	];
}
