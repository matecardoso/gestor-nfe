<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'nome' => $faker->realText($maxNbChars = 20, $indexSize = 2),
        'ncm' => '12345678',
        'origem' => 1,
        'subtotal' => rand(1,100),
        'impostos_id' => 1
    ];
});
