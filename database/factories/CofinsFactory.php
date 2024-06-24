<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cofins;
use Faker\Generator as Faker;

$factory->define(Cofins::class, function (Faker $faker) {
    return [
        'situacao_tributaria' => '1',
        'aliquota' => '1',
    ];
});
