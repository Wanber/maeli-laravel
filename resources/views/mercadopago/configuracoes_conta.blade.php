@extends('layouts.base')

@push('stylesheets')
<!-- PNotify -->
<link href="{{ url("vendor/pnotify/dist/pnotify.css") }}" rel="stylesheet">
<link href="{{ url("vendor/pnotify/dist/pnotify.buttons.css") }}" rel="stylesheet">
<link href="{{ url("vendor/pnotify/dist/pnotify.nonblock.css") }}" rel="stylesheet">
@endpush

@push('scripts')
<!-- PNotify -->
<script src="{{ url('vendor/pnotify/dist/pnotify.js') }}"></script>
<script src="{{ url('vendor/pnotify/dist/pnotify.buttons.js') }}"></script>
<script src="{{ url('vendor/pnotify/dist/pnotify.nonblock.js') }}"></script>

@if(!$mp_sdk)
    <script language="JavaScript">
        $(function () {
            new PNotify({
                title: 'Configurações inválidas',
                type: 'warning',
                text: 'As configurações deste módulo são inválidas, recursos referentes a este módulo ficarão indisponíveis até que isto mude.',
                nonblock: {
                    nonblock: true
                },
                styling: 'bootstrap3',
                hide: false
            });
        });
    </script>
@endif
@endpush

@section('titulo')
    Configurações da conta - MercadoPago
@endsection

@section('modulo_nome')
    Configurações da conta MercadoPago
@endsection

@section('modulo_desc')
    Estas informações estão disponíveis
    <a class="text-danger"
       href="https://www.mercadopago.com/mlb/account/credentials">aqui</a>
@endsection

@section('main_container')

    <div class="row" style="margin-top: 10px">

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Checkout básico</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <!--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>-->
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! BootForm::open([
                        'url' => route('mercadopago.configuracoes_conta.save'),
                        'method' => 'post',
                        'class' => 'form-horizontal form-label-left',
                        'data-parsley-validate'
                    ]) !!}

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="mp_client_id">CLIENT_ID</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {{Form::text('mp_client_id', $mp_confs['mp_client_id'], [
                                'id' => 'mp_client_id',
                                'required' => 'required',
                                'data-parsley-type' => 'alphanum',
                                'placeholder' => 'CLIENT_ID',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="mp_client_secret">CLIENT_SECRET</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {{Form::text('mp_client_secret', $mp_confs['mp_client_secret'], [
                                'id' => 'mp_client_secret',
                                'required' => 'required',
                                'data-parsley-type' => 'alphanum',
                                'placeholder' => 'CLIENT_SECRET',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3 text-right">
                            {!! BootForm::submit('Salvar', ['class' => 'btn btn-dark']) !!}
                        </div>
                    </div>

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Checkout transparente
                        <small>Modo Produção</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <!--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>-->
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>

                    {!! BootForm::open([
                        'url' => route('mercadopago.configuracoes_conta.save'),
                        'method' => 'post',
                        'class' => 'form-horizontal form-label-left',
                        'data-parsley-validate'
                    ]) !!}

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="mp_public_key">Public key</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {{Form::text('mp_public_key', $mp_confs['mp_public_key'], [
                                'id' => 'mp_public_key',
                                'required' => 'required',
                                'data-parsley-type' => 'alphanum',
                                'placeholder' => 'Public key',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="mp_access_token">Access token</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {{Form::text('mp_access_token', $mp_confs['mp_access_token'], [
                                'id' => 'mp_access_token',
                                'required' => 'required',
                                'data-parsley-type' => 'alphanum',
                                'placeholder' => 'Access token',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3 text-right">
                            {!! BootForm::submit('Salvar', ['class' => 'btn btn-dark']) !!}
                        </div>
                    </div>

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>

    </div>

@endsection