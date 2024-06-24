<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';

	protected $fillable = [
		'endereco',
		'pais',
		'complemento',
		'numero',
		'bairro',
		'cidade',
		'uf',
		'cep',
	];
}
