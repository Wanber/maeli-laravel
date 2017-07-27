<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Maeli\Pacote;

$faker = \Faker\Factory::create('pt_BR');

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Maeli\User::class, function ($faker) {
    static $password;
    $foto = rand(1, 2) == 1 ? 'guest' : 'user';

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'foto_path' => 'images/usuarios/' . $foto . '.png',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Maeli\MercadoPagoConfig::class, function ($faker) {
    static $password;

    return [
        'config' => $faker->word(1),
        'valor' => str_random(10),
    ];
});

$factory->define(Maeli\Cliente::class, function ($faker) {

    $sexo = ['m', 'f'];
    $estado_civil = ['solteiro', 'casado', 'divorciado', 'viuvo', 'separado'];
    $complemento = ['Apto', 'Loja', 'Sala', 'Galpao'];

    return [
        'nome' => $faker->name,
        'cpf' => rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(10, 99),
        'rg' => 'MG' . rand(100, 999) . rand(100, 999) . rand(10, 99),
        'sexo' => $sexo[array_rand($sexo, 1)],
        'dt_nascimento' => date("Y-m-d H:i:s"),
        'estado_civil' => $estado_civil[array_rand($estado_civil, 1)],
        'email' => $faker->unique()->safeEmail,
        'cidade' => $faker->word . ' ' . $faker->word,
        'rua' => $faker->word . ' ' . $faker->word,
        'bairro' => $faker->word . ' ' . $faker->word,
        'cep' => rand(100, 999) . rand(100, 999) . rand(10, 99),
        'numero' => rand(1, 9999),
        'complemento' => rand(1, 2) == 1 ? $complemento[array_rand($complemento, 1)] . ' ' . rand(1, 99) : ''
    ];
});

$factory->define(Maeli\Telefone::class, function () {

    return [
        'numero' => rand(10, 99) . rand(1, 9) . rand(1000, 9999) . rand(1000, 9999)
    ];
});

$factory->define(Maeli\Parceiro::class, function ($faker) {

    $tipo = ['hotel', 'restaurante', 'transporte', 'guia', 'servico_bordo'];
    $complemento = ['Apto', 'Loja', 'Sala', 'Galpao'];

    $cpf = rand(1, 2) == 1 ? rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(10, 99) : NULL;

    if ($cpf == NULL)
        $cnpj = rand(10, 99) . rand(100, 999) . rand(100, 999) . rand(1000, 9999) . rand(10, 99);
    else
        $cnpj = rand(1, 2) == 1 ? rand(10, 99) . rand(100, 999) . rand(100, 999) . rand(1000, 9999) . rand(10, 99) : NULL;

    return [
        'nome' => $faker->name,
        'cpf' => $cpf,
        'cnpj' => $cnpj,
        'email' => $faker->unique()->safeEmail,
        'telefone' => rand(10, 99) . rand(1, 9) . rand(1000, 9999) . rand(1000, 9999),
        'telefone2' => rand(1, 2) == 1 ? rand(10, 99) . rand(1, 9) . rand(1000, 9999) . rand(1000, 9999) : '',
        'cidade' => $faker->word . ' ' . $faker->word,
        'rua' => $faker->word . ' ' . $faker->word,
        'bairro' => $faker->word . ' ' . $faker->word,
        'cep' => rand(100, 999) . rand(100, 999) . rand(10, 99),
        'numero' => rand(1, 9999),
        'complemento' => rand(1, 2) == 1 ? $complemento[array_rand($complemento, 1)] . ' ' . rand(1, 99) : ''
    ];
});

$factory->define(Maeli\Servico::class, function ($faker) {
    $tipos = ['Hotel', 'Restaurante', 'Guia Turístico', 'Serviço de bordo'];

    return [
        'tipo' => $tipos[array_rand($tipos, 1)],
        'descricao' => $faker->paragraph(1)
    ];
});

$factory->define(Maeli\Pacote::class, function ($faker) {

    return [
        'nome' => $faker->name,
        'descricao' => $faker->paragraph(1),
        'valor' => rand(10, 99) . '00',
        'vagas' => rand(10, 99),
        'dt_partida' => Pacote::format_data(time('now'), "Y-m-d H:i:s"),
        'dt_retorno' => Pacote::format_data(time('now') + (rand(1, 9) * 24 * 60 * 60), "Y-m-d H:i:s"),
        'local_embarque' => $faker->name,
        'destino' => $faker->name
    ];
});

$factory->define(Maeli\PrestacaoServico::class, function ($faker) {
    return [];
});

$factory->define(Maeli\Venda::class, function ($faker) {

    return [
        'valor' => rand(100, 999) . rand(10, 99)
    ];
});

$factory->define(Maeli\Consorcio::class, function ($faker) {

    return [
        'valor' => rand(1000, 9999) . rand(10, 99)
    ];
});

$factory->define(Maeli\Pagamento::class, function ($faker) {

    return [
        'data' => Pacote::format_data(time('now'), "Y-m-d H:i:s"),
        'recebido' => rand(0, 1) == 1 ? true : false
    ];
});