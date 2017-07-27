<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', ['as' => 'dashboard', 'middleware' => 'auth', 'uses' => 'DashboardController@index']);
Route::get('teste', ['as' => 'teste', 'uses' => 'DashboardController@teste']);//remover
Route::get('configuracoes', ['as' => 'configuracoes', 'middleware' => ['auth', 'permission:conf-sistema'], 'uses' => 'ConfiguracoesController@index']);

Route::group(['prefix' => 'auth'], function () {

    Route::get('login', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
    Route::post('postLogin', ['as' => 'postLogin', 'uses' => 'AuthController@postLogin']);

    Route::group(['prefix' => 'resetar_senha'], function () {
        Route::get('', ['as' => 'resetar_senha', 'uses' => 'AuthController@resetar_senha']);
        Route::post('_post', ['as' => 'postResetar_senha', 'uses' => 'AuthController@postResetar_senha']);
        Route::get('/{token}', ['as' => 'tokenResetar_senha', 'uses' => 'AuthController@tokenResetar_senha']);
        Route::post('/atualizar', ['as' => 'atualizar_senha', 'uses' => 'AuthController@atualizar_senha']);
    });

});

Route::group(['prefix' => 'clientes', 'middleware' => ['auth', 'permission:manter-clientes']], function () {

    Route::get('', ['as' => 'clientes.listar', 'uses' => 'ClienteController@listar']);
    Route::get('editar/{id}', ['as' => 'clientes.editar', 'uses' => 'ClienteController@editar']);
    Route::post('atualizar', ['as' => 'clientes.atualizar', 'uses' => 'ClienteController@atualizar']);

    Route::group(['prefix' => 'novo'], function () {
        Route::get('', ['as' => 'clientes.novo', 'uses' => 'ClienteController@novo']);
        Route::post('salvar', ['as' => 'clientes.novo.salvar', 'uses' => 'ClienteController@novo_salvar']);
    });

    Route::get('excluir/{id}', ['as' => 'clientes.excluir', 'uses' => 'ClienteController@excluir']);

});

Route::group(['prefix' => 'servicos', 'middleware' => ['auth', 'permission:manter-servicos']], function () {

    Route::get('', ['as' => 'servicos.listar', 'uses' => 'ServicoController@listar']);
    Route::get('editar/{id}', ['as' => 'servicos.editar', 'uses' => 'ServicoController@editar']);
    Route::post('atualizar', ['as' => 'servicos.atualizar', 'uses' => 'ServicoController@atualizar']);

    Route::group(['prefix' => 'novo'], function () {
        Route::get('', ['as' => 'servicos.novo', 'uses' => 'ServicoController@novo']);
        Route::post('salvar', ['as' => 'servicos.novo.salvar', 'uses' => 'ServicoController@novo_salvar']);
    });

    Route::get('excluir/{id}', ['as' => 'servicos.excluir', 'uses' => 'ServicoController@excluir']);

});

Route::group(['prefix' => 'parceiros', 'middleware' => ['auth', 'permission:manter-parceiros']], function () {

    Route::get('', ['as' => 'parceiros.listar', 'uses' => 'ParceirosController@listar']);
    Route::get('editar/{id}', ['as' => 'parceiros.editar', 'uses' => 'ParceirosController@editar']);
    Route::post('atualizar', ['as' => 'parceiros.atualizar', 'uses' => 'ParceirosController@atualizar']);

    Route::group(['prefix' => 'novo'], function () {
        Route::get('', ['as' => 'parceiros.novo', 'uses' => 'ParceirosController@novo']);
        Route::post('salvar', ['as' => 'parceiros.novo.salvar', 'uses' => 'ParceirosController@novo_salvar']);
    });

    Route::get('excluir/{id}', ['as' => 'parceiros.excluir', 'uses' => 'ParceirosController@excluir']);

});

Route::group(['prefix' => 'pacotes', 'middleware' => ['auth', 'permission:manter-pacotes']], function () {

    Route::get('', ['as' => 'pacotes.listar', 'uses' => 'PacoteController@listar']);
    Route::get('editar/{id}', ['as' => 'pacotes.editar', 'uses' => 'PacoteController@editar']);
    Route::post('atualizar', ['as' => 'pacotes.atualizar', 'uses' => 'PacoteController@atualizar']);

    Route::group(['prefix' => 'novo'], function () {
        Route::get('', ['as' => 'pacotes.novo', 'uses' => 'PacoteController@novo']);
        Route::post('salvar', ['as' => 'pacotes.novo.salvar', 'uses' => 'PacoteController@novo_salvar']);
    });

    Route::get('excluir/{id}', ['as' => 'pacotes.excluir', 'uses' => 'PacoteController@excluir']);

});


Route::group(['prefix' => 'mercadopago', 'middleware' => ['auth', 'permission:mod-mercadopago']], function () {

    Route::group(['prefix' => 'emitir_pagamento'], function () {
        Route::get('', [
            'as' => 'mercadopago.emitir_pagamento',
            'uses' => 'MercadoPagoController@emitir_pagamento'
        ]);
        Route::post('', [
            'as' => 'mercadopago.emitir_pagamento.gerar',
            'uses' => 'MercadoPagoController@gerar_pagamento'
        ]);
        Route::get('callback', [
            'as' => 'mercadopago.emitir_pagamento.callback',
            'uses' => 'MercadoPagoController@gerar_pagamento_callback'
        ]);
        Route::get('notification', [
            'as' => 'mercadopago.emitir_pagamento.notification',
            'uses' => 'MercadoPagoController@emitir_pagamento_notification'
        ]);
    });

    Route::get('saldo', [
        'as' => 'mercadopago.saldo',
        'uses' => 'MercadoPagoController@saldo'
    ]);
    Route::get('historico', [
        'as' => 'mercadopago.historico',
        'uses' => 'MercadoPagoController@historico'
    ]);

    Route::group(['prefix' => 'configuracoes_conta'], function () {
        Route::get('', [
            'as' => 'mercadopago.configuracoes_conta',
            'uses' => 'MercadoPagoController@configuracoes_conta'
        ]);
        Route::post('save', [
            'as' => 'mercadopago.configuracoes_conta.save',
            'uses' => 'MercadoPagoController@save_configuracoes_conta'
        ]);
    });
});

Route::group(['prefix' => 'usuarios', 'middleware' => ['auth', 'permission:manter-usuarios']], function () {

    Route::get('', ['as' => 'usuarios.listar', 'uses' => 'UsuariosController@listar']);
    Route::get('editar/{id}', ['as' => 'usuarios.editar', 'uses' => 'UsuariosController@editar']);
    Route::post('atualizar', ['as' => 'usuarios.atualizar', 'uses' => 'UsuariosController@atualizar']);

    Route::group(['prefix' => 'novo'], function () {
        Route::get('', ['as' => 'usuarios.novo', 'uses' => 'UsuariosController@novo']);
        Route::post('salvar', ['as' => 'usuarios.novo.salvar', 'uses' => 'UsuariosController@novo_salvar']);
    });

    Route::get('excluir/{id}', ['as' => 'usuarios.excluir', 'uses' => 'UsuariosController@excluir']);
});

Route::group(['prefix' => 'perfis_permissoes', 'middleware' => ['auth', 'permission:mod-perfis-permissoes']], function () {
    Route::get('', ['as' => 'perfis_permissoes.listar', 'uses' => 'PerfisPermissoesController@listar']);
    Route::get('editar/{id}', ['as' => 'perfis_permissoes.editar', 'uses' => 'PerfisPermissoesController@editar']);
    Route::post('atualizar', ['as' => 'perfis_permissoes.atualizar', 'uses' => 'PerfisPermissoesController@atualizar']);

    Route::group(['prefix' => 'novo'], function () {
        Route::get('', ['as' => 'perfis_permissoes.novo', 'uses' => 'PerfisPermissoesController@novo']);
        Route::post('salvar', ['as' => 'perfis_permissoes.novo.salvar', 'uses' => 'PerfisPermissoesController@novo_salvar']);
    });

    Route::get('excluir/{id}', ['as' => 'perfis_permissoes.excluir', 'uses' => 'PerfisPermissoesController@excluir']);
});