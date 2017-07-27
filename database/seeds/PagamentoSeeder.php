<?php

use Illuminate\Database\Seeder;
use Maeli\Consorcio;
use Maeli\Pagamento;
use Maeli\Venda;

class PagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    function gerar_pagamentos($valor_total)
    {
        $faker = \Faker\Factory::create('pt_BR');
        $formass_pagamento = ['avista', 'cartao', 'cheque', 'promissoria', 'deposito', 'saldo'];

        switch (rand(1, 2)) {
            case 1:
                $pagamentos = factory(Pagamento::class, 1)->make([
                    'forma' => 'avista',
                    'valor' => $valor_total,
                    'observacao' => rand(0, 1) == 0 ? $faker->word : NULL
                ]);
                break;
            case 2:
                $num_formas = rand(1, 3);
                $pagamentos = factory(Pagamento::class, $num_formas)->make([
                    'forma' => $formass_pagamento[array_rand($formass_pagamento, 1)],
                    'valor' => round(($valor_total) / $num_formas),
                    'observacao' => rand(0, 1) == 0 ? $faker->word : NULL
                ]);
                break;
        }

        return $pagamentos;
    }

    public function run()
    {
        $consorcios = Consorcio::all();
        $vendas = Venda::all();

        foreach ($consorcios as $consorcio)
            $consorcio->pagamentos()->saveMany($this->gerar_pagamentos($consorcio->valor));

        foreach ($vendas as $venda)
            $venda->pagamentos()->saveMany($this->gerar_pagamentos($venda->valor));
    }
}
