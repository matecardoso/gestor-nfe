<?php

use App\Models\Ipi;
use App\Models\Pis;
use App\Models\Icms;
use App\Models\Cofins;
use App\Models\Imposto;
use App\Models\Exportacao;
use App\Models\Importacao;
use Illuminate\Database\Seeder;

class ImpostosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Icms::class, 1)->create();
        factory(Ipi::class, 1)->create();
        factory(Pis::class, 1)->create();
        factory(Cofins::class, 1)->create();
        factory(Importacao::class, 1)->create();
        factory(Exportacao::class, 1)->create();
        factory(Imposto::class, 200)->create();
    }
}
