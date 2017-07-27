@extends('layouts.base')

@push('stylesheets')
@endpush

@push('scripts')
@endpush

@section('titulo')
    Saldo da conta - MercadoPago
@endsection

@section('modulo_nome')
    Saldo da conta MercadoPago
@endsection

@section('modulo_desc')
    Exibe o saldo atual da conta
@endsection

@section('main_container')

    @if(!$mp_sdk)
        @push('link_configuracoes')
        {{route('mercadopago.configuracoes_conta')}}
        @endpush
        @include('includes.configuracoes_invalidas')
    @else

        <div class="row">

            <br />

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-check"></i>
                    </div>
                    <div class="count text-success">R$ {{$saldo['available_balance']}}</div>

                    <h3>Saldo disponível</h3>
                    <p>Saldo atual da conta</p>
                </div>
            </div>

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-refresh"></i>
                    </div>
                    <div class="count text-info">R$ {{$saldo['unavailable_balance']}}</div>

                    <h3>Saldo pendente</h3>
                    <p>Saldo em processamento</p>
                </div>
            </div>

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-money"></i>
                    </div>
                    <div class="count text-warning">R$ {{$saldo['total_amount']}}</div>

                    <h3>Saldo futuro</h3>
                    <p>Saldo atual mais lançamentos pendentes</p>
                </div>
            </div>

        </div>

    @endif

@endsection