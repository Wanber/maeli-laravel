<?php

use Illuminate\Database\Seeder;

class MercadoPagoConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('Maeli\MercadoPagoConfig')->create([
            'config' => 'mp_client_id',
            'valor' => '4365829764087449'
        ]);

        factory('Maeli\MercadoPagoConfig')->create([
            'config' => 'mp_client_secret',
            'valor' => 'cQI82PJXbvhm7LfDJDojOeZepzFKzUa6'
        ]);
    }
}
