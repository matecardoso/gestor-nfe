<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    protected $table = 'faturas';

    protected $fillable = [
        'numero',
        'valor',
        'desconto',
        'valor_liquido'
    ];
}
