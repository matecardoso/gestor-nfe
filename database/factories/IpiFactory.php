<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ipi;
use Faker\Generator as Faker;

$factory->define(Ipi::class, function (Faker $faker) {
    return [
        'situacao_tributaria' => '1',
        'codigo_enquadramento' => '1',
        'aliquota' => '1',
    ];
});
