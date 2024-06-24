<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Imposto;
use Faker\Generator as Faker;

$factory->define(Imposto::class, function (Faker $faker) {
    return [
        'icms_id' => 1,
        'ipi_id' => 1,
        'pis_id' => 1,
        'cofins_id' => 1,
        'importacao_id' => 1,
        'exportacao_id' => 1
    ];
});
