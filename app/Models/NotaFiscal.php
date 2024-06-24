<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    protected $table = 'nota_fiscal';

    protected $casts = [
        'dados_formulario' => 'array',
        'dados_envio' => 'array',
        'dados_retorno' => 'array',
        'dados_cancelamento' => 'array'
    ];
    
    public function tiposOperacoes() {
        return [
            1 => 'Saída',
            0 => 'Entrada'
        ];
    }

    public function modelosNotas() {
        return [
            1 => 'NF-e',
            2 => 'NFC-e'
        ];
    }

    public function finalidades() {
        return [
            1 => 'NF-e normal',
            4 => 'Devolução/Retorno'
        ];
    }

    public function ambientes() {
        return [
            1 => 'Produção',
            2 => 'Homologação'
        ];
    }
}
