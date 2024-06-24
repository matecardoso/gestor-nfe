<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
	use SoftDeletes;

    protected $table = 'produtos';

	protected $fillable = [
        'id',
		'item',
		'nome',
		'codigo',
		'ncm',
		'unidade',
		'peso',
		'origem',
        'desconto',
        'subtotal',
		'classe_imposto',
		'veiculo_usado',
		'ind_escala',
		'cnpj_fabricante',
		'beneficio_fiscal',
		'gtin',
		'gtin_tributavel',
		'cest',
		'nve',
		'nrecopi',
		'informacoes_adicionais',
		'ativo_permanente',
		'tributos_federais',
		'tributos_estaduais',
	];
	
	public function impostos()
    {
        return $this->belongsTo(Imposto::class);
	}

}