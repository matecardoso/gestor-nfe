<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'presenca',
        'modalidade_frete',
        'frete',
        'desconto',
        'total',
        'despesas_acessorias',
        'despesas_aduaneiras',
        'informacoes_fisco',
        'informacoes_complementares',
        'observacoes_contribuinte'
    ];
}