@extends('layouts.base')

@push('stylesheets')
@endpush

@push('scripts')
@endpush

@section('titulo')
    Emitir Pagamento - MercadoPago
@endsection

@section('modulo_nome')
    Emitir pagamento
@endsection

@section('modulo_desc')
    Certifique-se de estar deslogado de sua conta MercadoPago
@endsection

<!--desloga do MercadoPago automaticamente-->
<iframe src="https://www.mercadolibre.com/jms/mlb/lgz/logout?go=URL" style="display: none"></iframe>

@section('main_container')

    @if(!$mp_sdk)
        @push('link_configuracoes')
        {{route('mercadopago.configuracoes_conta')}}
        @endpush
        @include('includes.configuracoes_invalidas')
    @else

        @if($link_pagamento)
            <iframe src="{{$link_pagamento}}" frameborder="0" width="100%" height="540px"
                    scrolling="no"></iframe>
        @else

            <div class="row">
                {!! BootForm::open([
                    'url' => route('mercadopago.emitir_pagamento'),
                    'method' => 'post',
                    'class' => 'form-horizontal form-label-left',
                    'data-parsley-validate'
                ]) !!}

                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Informações do pagamento</h2>
                            <ul class="nav navbar-right panel_toolbox">

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>

                            <div class="item form-group {!! $errors->has('mp_pg_titulo') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="mp_pg_titulo">Título</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    {{Form::text('mp_pg_titulo', old('mp_pg_titulo'), [
                                        'id' => 'mp_pg_titulo',
                                        'required' => 'required',
                                        'placeholder' => 'Ex.: Maeli - Pacote Porto Seguro (550,00)',
                                        'class' => 'form-control col-md-7 col-xs-12'
                                    ])}}
                                </div>
                            </div>
                            <div class="item form-group {!! $errors->has('mp_pg_desc') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="mp_pg_desc">Descrição</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    {{Form::textarea('mp_pg_desc', old('mp_pg_desc'), [
                                        'id' => 'mp_pg_desc',
                                        'required' => 'required',
                                        'placeholder' => 'Ex.: Cobrança referente ao parcelamento do pacote Porto Seguro - 550,00',
                                        'rows' => '4',
                                        'class' => 'form-control'
                                    ])}}
                                </div>
                            </div>
                            <div class="item form-group {!! $errors->has('mp_pg_valor') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="mp_pg_valor">Valor</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    {{Form::text('mp_pg_valor', old('mp_pg_valor'), [
                                        'id' => 'mp_pg_valor',
                                        'required' => 'required',
                                        'placeholder' => 'Ex.: 550.00',
                                        'data-parsley-type' => 'number',
                                        'data-inputmask' => "'mask': '9{1,5}.99'",
                                        'class' => 'form-control col-md-7 col-xs-12 has-feedback-left',
                                        'style' => 'padding-left: 60px'
                                    ])}}
                                    <span class="form-control-feedback left" aria-hidden="true">R$</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Informações do cliente</h2>
                            <ul class="nav navbar-right panel_toolbox">

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>


                            <div class="item form-group {!! $errors->has('mp_pg_nome') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="mp_pg_nome">Nome</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    {{Form::text('mp_pg_nome', old('mp_pg_nome'), [
                                        'id' => 'mp_pg_nome',
                                        'required' => 'required',
                                        'placeholder' => 'Ex.: Pedro',
                                        'class' => 'form-control col-md-7 col-xs-12'
                                    ])}}
                                </div>
                            </div>
                            <div class="item form-group {!! $errors->has('mp_pg_sobrenome') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="mp_pg_sobrenome">Sobrenome</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    {{Form::text('mp_pg_sobrenome', old('mp_pg_sobrenome'), [
                                        'id' => 'mp_pg_sobrenome',
                                        'required' => 'required',
                                        'placeholder' => 'Ex.: Siqueira Silva',
                                        'class' => 'form-control col-md-7 col-xs-12'
                                    ])}}
                                </div>
                            </div>
                            <div class="item form-group {!! $errors->has('mp_pg_cpf') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="mp_pg_cpf">CPF</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    {{Form::text('mp_pg_cpf', old('mp_pg_cpf'), [
                                        'id' => 'mp_pg_cpf',
                                        'required' => 'required',
                                        'data-parsley-cpf' => 'cpf',
                                        'data-inputmask' => "'mask': '999.999.999-99'",
                                        'placeholder' => 'Ex.: 123.456.789.00',
                                        'class' => 'form-control col-md-7 col-xs-12'
                                    ])}}
                                </div>
                            </div>


                            <div class="item form-group {!! $errors->has('mp_pg_email') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="mp_pg_email">Email</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    {{Form::email('mp_pg_email', old('mp_pg_email'), [
                                        'id' => 'mp_pg_email',
                                        'required' => 'required',
                                        'placeholder' => 'Ex.: pedro@exemplo.com',
                                        'class' => 'form-control col-md-7 col-xs-12'
                                    ])}}
                                </div>

                                <div class="col-md-12 text-right">
                                    <div class="row">
                                        <div class="col-md-5 col-md-offset-3" style="margin-top: 20px">
                                            O recibo chegará neste email.
                                        </div>
                                        <div class="col-md-3 text-right">
                                            {!! BootForm::submit('Emitir Pagamento',
                                                ['class' => 'btn btn-dark', 'style' => 'margin-top: 10px'])
                                            !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {!! BootForm::close() !!}

            </div>

        @endif

    @endif

@endsection