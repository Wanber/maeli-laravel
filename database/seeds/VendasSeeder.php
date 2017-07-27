<?php

use Illuminate\Database\Seeder;
use Maeli\Cliente;

class VendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('Maeli\Venda', 85)->create()->each(function ($venda) {
            $passageiros = Cliente::all()->random(rand(1, 4));

            $c = 1;
            foreach ($passageiros as $passageiro)
                $venda->passageiros()->attach($passageiro->id, ['responsavel' => $c++ == 1 ? true : false]);
        });
    }
}
