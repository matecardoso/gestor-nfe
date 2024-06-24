<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    protected $table = 'configuracoes';

    protected $fillable = [
        'id',
        'tipo',
        'descricao',
        'valor'
    ];

    const TIPO_UNIDADE = 'UND'; 

    public function scopeTipoUnidade($query) {
      	return $query->where('tipo', self::TIPO_UNIDADE);
    }

    const TIPO_AMBIENTE = 'AMB'; 

    public function scopeTipoAmbiente($query) {
        return $query->where('tipo', self::TIPO_AMBIENTE);
    }

}
