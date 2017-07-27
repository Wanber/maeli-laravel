<?php

use Illuminate\Database\Seeder;
use Maeli\PrestacaoServico;
use Maeli\Servico;

class PacoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('Maeli\Pacote', 15)->create()->each(function ($pacote) {
            $faker = \Faker\Factory::create('pt_BR');

            $prestacoes_servicos = PrestacaoServico::all()->random(rand(1, 5));

            foreach ($prestacoes_servicos as $prestacao_servico)
                $pacote->prestacao_servicos()->attach($prestacao_servico->id, ['preco' => rand(10, 999).rand(10, 99), 'descricao' => $faker->paragraph]);
        });
    }
}
