<?php

namespace Maeli\Http\Controllers;

require_once base_path() . '/vendor/mercadopago-sdk/MercadoPago.php';

use Exception;
use Illuminate\Http\Request;
use Maeli\Http\Requests\EmitirPagamentoRequest;
use Maeli\MercadoPagoConfig;
use Maeli\MercadoPagoTransacao;
use MercadoPagoSdk\MercadoPago;
use MercadoPagoSdk\MercadoPagoException;


class MercadoPagoController extends Controller
{
    /**
     * @var MercadoPagoConfig
     */
    private $mp_sdk;
    private $mercadoPagoConfig;
    private $mp_confs;
    private $mp_user;

    public function __construct(MercadoPagoConfig $mercadoPagoConfig)
    {
        $this->mercadoPagoConfig = $mercadoPagoConfig;
        $this->mp_confs['mp_client_id'] = @$mercadoPagoConfig->where('config', 'mp_client_id')->first()->valor;
        $this->mp_confs['mp_client_secret'] = @$mercadoPagoConfig->where('config', 'mp_client_secret')->first()->valor;
        $this->mp_confs['mp_public_key'] = @$mercadoPagoConfig->where('config', 'mp_public_key')->first()->valor;
        $this->mp_confs['mp_access_token'] = @$mercadoPagoConfig->where('config', 'mp_access_token')->first()->valor;

        try {
            $this->mp_sdk = new MercadoPago($this->mp_confs['mp_client_id'], $this->mp_confs['mp_client_secret']);
            $this->mp_user = $this->mp_sdk->get('/users/me?access_token=' . $this->mp_sdk->get_access_token())['response'];
        } catch (MercadoPagoException $mercadoPagoException) {
            $this->mp_sdk = null;
            $this->mp_user = null;
            $this->mp_saldo = null;
        }
    }

    public function emitir_pagamento($link_pagamento = false)
    {
        return view('mercadopago.emitir_pagamento', ['mp_sdk' => $this->mp_sdk, 'link_pagamento' => $link_pagamento]);
    }

    public function gerar_pagamento(EmitirPagamentoRequest $emitirPagamentoRequest)
    {
        $preference_data = array(
            "operation_type" => "regular_payment",
            "items" => array(
                array(
                    "title" => $emitirPagamentoRequest->get('mp_pg_titulo'),
                    "description" => $emitirPagamentoRequest->get('mp_pg_desc'),
                    "picture_url" => "",
                    "quantity" => 1,
                    "currency_id" => "BRL",
                    "unit_price" => (float)$emitirPagamentoRequest->get('mp_pg_valor')
                )
            ),
            "payer" => array(
                "type" => "guest",
                "name" => $emitirPagamentoRequest->get('mp_pg_nome'),
                "surname" => $emitirPagamentoRequest->get('mp_pg_sobrenome'),
                "email" => $emitirPagamentoRequest->get('mp_pg_email'),
                "identification" => array(
                    "type" => "cpf",
                    "number" => $emitirPagamentoRequest->get('mp_pg_cpf')
                )
            ),
            "back_urls" => array(
                "success" => route('mercadopago.emitir_pagamento.callback') . '?s=ok',
                "pending" => route('mercadopago.emitir_pagamento.callback') . '?s=pendente',
                "failure" => route('mercadopago.emitir_pagamento.callback') . '?s=falha'
            ),
            "notification_url" => route('mercadopago.emitir_pagamento.notification'),
            "auto_return" => "all",
            "expires" => false,
            "additional_info" => $emitirPagamentoRequest->get('mp_pg_desc')
        );

        try {
            $pagamento = $this->mp_sdk->create_preference($preference_data);
            return $this->emitir_pagamento($pagamento['response']['init_point']);

        } catch (MercadoPagoException $mercadoPagoException) {
            return redirect()->route('mercadopago.emitir_pagamento')
                ->withInput()
                ->withErrors([$mercadoPagoException->getMessage()]);
        }
    }

    public function gerar_pagamento_callback(Request $request)
    {
        $status = $request->get('s', 'falha');

        return view('mercadopago.emitir_pagamento_callback', ['status' => $status]);
    }

    public function emitir_pagamento_notification()
    {
        return 'ok';
        //tratar pagamentos pendentes
    }

    public function saldo()
    {
        if (!$this->mp_sdk)
            $saldo = '';
        else
            $saldo = $this->mp_sdk->get("/users/" . $this->mp_user['id'] . "/mercadopago_account/balance")['response'];

        return view('mercadopago.saldo', ['saldo' => $saldo, 'mp_sdk' => $this->mp_sdk]);
    }

    public function historico(Request $request)
    {
        $r_pagina = 30;
        $pagina = $request->get('p', 1);
        $offset = $r_pagina * ($pagina - 1);


        $filters = array();

        if (!$this->mp_sdk)
            $transacoes = array();
        else {
            $historico_search = $this->mp_sdk->search_payment($filters, $offset, $r_pagina);
            $transacoes = $historico_search['response']['results'];
        }

        $transacoes_obj = array();

        foreach ($transacoes as $transacao) {
            $transacao = $transacao['collection'];
            $transacoes_obj[] = new MercadoPagoTransacao($transacao);
        }

        array_multisort($transacoes_obj);

        $paginas = max(floor(sizeof($transacoes) / $r_pagina), 1);

        return view('mercadopago.historico', ['transacoes' => $transacoes_obj,
            'mp_sdk' => $this->mp_sdk,
            'paginacao' => ['paginas' => $paginas, 'pagina' => $pagina]]);
    }

    public function configuracoes_conta()
    {
        return view('mercadopago.configuracoes_conta', ['mp_confs' => $this->mp_confs, 'mp_sdk' => $this->mp_sdk]);
    }

    public function save_configuracoes_conta(Request $request)
    {
        if ($request->get('mp_client_id', '') != '') {
            if ($mp_client_id = $this->mercadoPagoConfig->where('config', 'mp_client_id')->first()) {
                $mp_client_id->valor = $request->get('mp_client_id', '');
                $mp_client_id->save();

            } else {
                $mp_config = new MercadoPagoConfig();
                $mp_config->config = 'mp_client_id';
                $mp_config->valor = $request->get('mp_client_id', '');
                $mp_config->save();
            }
        }

        if ($request->get('mp_client_secret', '') != '') {
            if ($mp_client_secret = $this->mercadoPagoConfig->where('config', 'mp_client_secret')->first()) {
                $mp_client_secret->valor = $request->get('mp_client_secret', '');
                $mp_client_secret->save();

            } else {
                $mp_config = new MercadoPagoConfig();
                $mp_config->config = 'mp_client_secret';
                $mp_config->valor = $request->get('mp_client_secret', '');
                $mp_config->save();
            }
        }

        if ($request->get('mp_public_key', '') != '') {
            if ($mp_public_key = $this->mercadoPagoConfig->where('config', 'mp_public_key')->first()) {
                $mp_public_key->valor = $request->get('mp_public_key', '');
                $mp_public_key->save();

            } else {
                $mp_config = new MercadoPagoConfig();
                $mp_config->config = 'mp_public_key';
                $mp_config->valor = $request->get('mp_public_key', '');
                $mp_config->save();
            }
        }
        if ($request->get('mp_access_token', '') != '') {
            if ($mp_access_token = $this->mercadoPagoConfig->where('config', 'mp_access_token')->first()) {
                $mp_access_token->valor = $request->get('mp_access_token', '');
                $mp_access_token->save();

            } else {
                $mp_config = new MercadoPagoConfig();
                $mp_config->config = 'mp_access_token';
                $mp_config->valor = $request->get('mp_access_token', '');
                $mp_config->save();
            }
        }

        return redirect()->route('mercadopago.configuracoes_conta')
            ->with(['msgs' =>
                [
                    [
                        'tipo' => 'success',
                        'text' => 'Suas configurações foram salvas'
                    ],
                ]
            ]);
    }
}
