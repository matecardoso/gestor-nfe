<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Icms;
use Faker\Generator as Faker;

$factory->define(Icms::class, function (Faker $faker) {
    return [
        'codigo_cfop' => '501',
        'tipo_tributacao' => '1',
        'situacao_tributaria' => '1',
    ];
});
