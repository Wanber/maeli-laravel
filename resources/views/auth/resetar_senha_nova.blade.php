@extends('layouts.blank')

@section('titulo')
    {{config('app.name')}} | Resetar senha
@endsection

@section('main_container')

    <div class="login_wrapper">
        <div class="animate form login_form">

            @include('includes.mensagens')

            <section class="login_content">
                {!! BootForm::open(['url' => route('atualizar_senha'), 'method' => 'post', '']) !!}

                <h1>{{config('app.name')}}</h1>

                {!! BootForm::password('nova_senha', 'Nova senha', [
                    'placeholder' => 'Nova senha',
                    'data-parsley-minlength' => '6',
                    'required' => 'required'
                  ] ) !!}

                {!! BootForm::password('nova_senha2', false, [
                    'placeholder' => 'Confirme a senha',
                    'required' => 'required',
                    'data-parsley-minlength' => '6',
                    'data-parsley-equalto' => '#nova_senha'
                  ]) !!}

                {!! Form::hidden('token', $token) !!}

                <div class="col-md-12 text-center">
                    {!! Form::submit('Resetar senha', [
                        'class' => 'btn btn-primary submit left',
                        'style' => 'margin-left: 40px'
                    ]) !!}

                    <a class="reset_pass" href="{{route('login')}}">Ir para o login</a>
                </div>

                <br/><br/><br/>


                <div class="separator">
                <!--<p class="change_link">New to site?
                        <a href="{{ url('/register') }}" class="to_register"> Create Account </a>
                    </p>-->

                    <div class="clearfix"></div>
                    <br/>

                    <div>
                        <h1><i class="fa fa-paw"></i> {{config('app.name')}}</h1>
                    <!--<p>©2017 {{config('app.name')}} é uma marca registrada</p>-->
                    </div>

                </div>
                {!! BootForm::close() !!}
            </section>
        </div>
    </div>

@endsection