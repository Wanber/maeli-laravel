@extends('layouts.blank')

@section('main_container')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2></h2>
                        <ul class="nav navbar-right panel_toolbox">
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="bs-example" data-example-id="simple-jumbotron">


                            @if($status == 'ok')

                                <div class="jumbotron bg-blue">
                                    <h1>Pagamento aprovado!</h1>
                                    <p>
                                        Seu pagamento foi processado e aprovado, em até um mês o montante estará
                                        disponível em sua conta MercadoPago.
                                    </p>
                                    <div class="text-right">
                                        <a class="btn btn-primary" href="#"
                                           onclick="window.top.location.href = '{{route('mercadopago.emitir_pagamento')}}';">
                                            Emitir outro pagamento
                                        </a>
                                    </div>
                                </div>

                            @elseif($status == 'pendente')

                                <div class="jumbotron bg-primary">
                                    <h1>Processando pagamento</h1>
                                    <p>
                                        Seu pagamento esta sendo processado e será aprovado em até 2 dias úteis.
                                    </p>
                                    <div class="text-right">
                                        <a class="btn btn-primary" href="#"
                                           onclick="window.top.location.href = '{{route('mercadopago.emitir_pagamento')}}';">
                                            Emitir outro pagamento
                                        </a>
                                    </div>
                                </div>

                            @elseif($status == 'falha')

                                <div class="jumbotron bg-red">
                                    <h1>Pagamento não aprovado</h1>
                                    <p>
                                        Seu pagamento não foi efetivado porque você cancelou a operação ou a operadora
                                        do cartão de crédito negou a a opeção.
                                    </p>
                                    <div class="text-right">
                                        <a class="btn btn-primary" href="#"
                                           onclick="window.top.location.href = '{{route('mercadopago.emitir_pagamento')}}';">
                                            Emitir outro pagamento
                                        </a>
                                    </div>
                                </div>

                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection