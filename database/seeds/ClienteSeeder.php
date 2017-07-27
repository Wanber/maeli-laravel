<?php

use Illuminate\Database\Seeder;
use Maeli\Consorcio;
use Maeli\Telefone;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('Maeli\Cliente', 75)->create()->each(function ($cliente) {
            $telefones = factory(Telefone::class, rand(1,2))->make();
            $consorcios = factory(Consorcio::class, rand(1,2))->make();

            $cliente->telefones()->saveMany($telefones);
            $cliente->consorcios()->saveMany($consorcios);
        });
    }
}
