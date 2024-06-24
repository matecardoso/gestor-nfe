<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Importacao;
use Faker\Generator as Faker;

$factory->define(Importacao::class, function (Faker $faker) {
    return [
        'aliquota' => '1',
        'iof' => '1',
        'subtotal' => '1',
        'total' => '1',
        'ndoc_importacao' => '1',
        'ddoc_importacao' => '1',
        'local_desembaraco' => '1',
        'uf_desembaraco' => '1',
        'data_desembaraco' => '1',
        'via_transporte' => '1',
        'intermediacao' => '1',
        'adicao' => '1',
        'seq_adicao' => '1',
        'fabricante' => '1'
    ];
});
