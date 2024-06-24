<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Exportacao;
use Faker\Generator as Faker;

$factory->define(Exportacao::class, function (Faker $faker) {
    return [
        'drawback' => '1',
        'reg_exportacao' => '1',
        'nfe_exportacao' => '1',
        'qtd_exportacao' => '1',
    ];
});
