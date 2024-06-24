<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pis;
use Faker\Generator as Faker;

$factory->define(Pis::class, function (Faker $faker) {
    return [
        'situacao_tributaria' => '1',
        'aliquota' => '1',
    ];
});
