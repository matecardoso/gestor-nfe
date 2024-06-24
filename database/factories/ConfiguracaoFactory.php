<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Configuracao;
use Faker\Generator as Faker;

$factory->define(Configuracao::class, function (Faker $faker) {
    return [
        'tipo' => Configuracao::TIPO_AMBIENTE,
        'descricao' => 'Ambiente de emissão da nota fiscal',
        'valor' => '2',
    ];
});
