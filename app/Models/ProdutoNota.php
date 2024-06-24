<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoNota extends Model
{
    protected $table = 'produto_nota';

	protected $fillable = [
		'quantidade',
        'total',
	];
}
