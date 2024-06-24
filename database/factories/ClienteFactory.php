<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cliente;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'cpf_cnpj' => Str::random(15),
        'tipo_pessoa' => $faker->randomElement(array_keys(Cliente::getTiposPessoa())),
        'nome_completo' => $faker->name,
        'razao_social' => $faker->name,
        'endereco_id' => 1
    ];
});
