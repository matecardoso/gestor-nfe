<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Endereco;
use Faker\Generator as Faker;

$factory->define(Endereco::class, function (Faker $faker) {
    return [
        'endereco' => 'Rua Teste',
        'numero' => '123',
        'bairro' => 'Centro',
    ];
});
