<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table = 'pagamentos';

    protected $fillable = [
        'pagamento',
        'forma_pagamento',
        'tipo_integracao',
        'valor_pagamento',
        'cnpj_credenciadora',
        'bandeira',
        'autorizacao',
    ];
}
