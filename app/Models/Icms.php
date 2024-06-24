<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icms extends Model
{
    protected $table = 'icms';

	protected $fillable = [
		'codigo_cfop',
        'tipo_tributacao',
        'situacao_tributaria',
        'aliquota_credito',
        'aliquota_reducao',
        'aliquota_mva',
        'aliquota_diferimento',
        'aliquota_importacao',
        'aliquota_reducao_st',
        'motivo_desoneracao',
        'bc_st_retido',
        'aliquota_st_retido',
        'valor_st_retido',
        'valor_fcp_retido',
        'aliquota_fcp_retido',
        'industria',
	];
}
