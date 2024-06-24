<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
	use SoftDeletes;
	
    protected $table = 'clientes';

	protected $fillable = [
        'id',
		'cpf_cnpj',
		'tipo_pessoa',
		'nome_completo',
		'razao_social',
		'ie',
		'suframa',
		'substituto_tributario',
		'consumidor_final',
        'contribuinte',
        'telefone',
		'email',
    ];

    const TIPO_PESSOA_FISICA = 'pessoa-fisica'; 
	const TIPO_PESSOA_JURIDICA = 'pessoa-juridica';
	const TIPO_ESTRANGEIRO = 'estrangeiro';

	public static function getTiposPessoa($valor = null) {

		$valores = [
			self::TIPO_PESSOA_FISICA => 'Pessoa física',
			self::TIPO_PESSOA_JURIDICA => 'Pessoa jurídica',
			self::TIPO_ESTRANGEIRO => 'Estrangeiro',
		];

		return $valor ? data_get($valores, $valor) : $valores;
	}

	public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

}
