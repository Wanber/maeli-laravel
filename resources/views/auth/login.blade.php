@extends('layouts.blank')

@section('titulo')
    {{config('app.name')}} | Login
@endsection

@section('main_container')

    <div class="login_wrapper">
        <div class="animate form login_form">

            @include('includes.mensagens')

            <section class="login_content">
                {!! BootForm::open(['url' => route('postLogin'), 'method' => 'post', 'data-parsley-validate']) !!}

                <h1>{{config('app.name')}}</h1>

                {!! BootForm::email('email', 'Email', old('email'), [
                    'placeholder' => 'Email',
                    'required' => 'required'
                  ] ) !!}

                {!! BootForm::password('password', 'Senha', [
                    'required' => 'required',
                    'pattern' => ".{6,}",
                    'title' => 'mínimo 6 caracteres',
                    'placeholder' => 'Senha'
                ]) !!}

                <div class="form-group">
                    {!! Form::submit('Fazer Login', [
                        'class' => 'btn btn-primary submit left',
                        'style' => 'margin-left: 40px'
                    ]) !!}

                    <div class="checkbox col-md-7">
                        <label>
                            {!! Form::checkbox('remember', 'sim', true,
                                ['class' => 'flat']
                            ) !!}
                            Lembrar credenciais
                        </label>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <a class="reset_pass" href="{{route('resetar_senha')}}">Esqueceu sua senha ?</a>
                <br/>

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