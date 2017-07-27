<?php

use Illuminate\Database\Seeder;
use Maeli\Parceiro;
use Maeli\Servico;

class PrestacaoServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parceiros = Parceiro::all();

        foreach ($parceiros as $parceiro) {
            $prestacoes_servicos = factory('Maeli\PrestacaoServico', rand(1, 3))->make();

            foreach ($prestacoes_servicos as $prestacao_servico) {
                $servico = Servico::all()->random(1)->first();
                $prestacao_servico->servico()->associate($servico->id);
                $parceiro->servicos_prestados()->save($prestacao_servico);
            }
        }
    }
}
