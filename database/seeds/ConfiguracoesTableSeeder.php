<?php

use App\Models\Configuracao;
use Illuminate\Database\Seeder;

class ConfiguracoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Configuracao::class, 1)->create();
    }
}
