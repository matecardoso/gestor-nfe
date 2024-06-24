<?php

use App\Models\Endereco;
use Illuminate\Database\Seeder;

class EnderecosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Endereco::class, 1)->create();
    }
}
