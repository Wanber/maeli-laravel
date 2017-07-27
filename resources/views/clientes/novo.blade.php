@extends('layouts.base')

@push('stylesheets')
@endpush

@push('scripts')
<!-- Busca Cep -->
<script src="{{ url("js/buscacep.min.js") }}"></script>
@endpush

@section('titulo')
    Novo Cliente
@endsection

@section('modulo_nome')

@endsection

@section('modulo_desc')

@endsection

@section('main_container')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Novo Cliente
                        <small>(*) campos obrigatórios</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox"></ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! BootForm::open([
                        'url' => route('clientes.novo.salvar'),
                        'method' => 'post',
                        'class' => 'form-horizontal form-label-left',
                        'data-parsley-validate'
                    ]) !!}

                    <div class="item form-group {!! $errors->has('nome') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="nome">Nome <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('nome', old('nome'), [
                                'id' => 'nome',
                                'required' => 'required',
                                'placeholder' => 'Informe um nome',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('cpf') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="cpf">CPF <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('cpf', old('cpf'), [
                                'id' => 'cpf',
                                'required' => 'required',
                                'placeholder' => 'Informe um CPF',
                                'data-parsley-cpf' => 'cpf',
                                'data-inputmask' => "'mask': '999.999.999-99'",
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('rg') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="rg">RG <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('rg', old('rg'), [
                                'id' => 'rg',
                                'required' => 'required',
                                'placeholder' => 'Informe um RG',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('dt_nascimento') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="dt_nascimento">Data de nascimento <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('dt_nascimento', old('dt_nascimento'), [
                                'id' => 'dt_nascimento',
                                'required' => 'required',
                                'placeholder' => 'Informe uma data',
                                'data-inputmask' => "'mask': '99/99/9999'",
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::email('email', old('email'), [
                                'id' => 'email',
                                'required' => 'required',
                                'placeholder' => 'Informe um email',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('telefone') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="telefone">Telefone principal <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('telefone', old('telefone'), [
                                'id' => 'telefone',
                                'required' => 'required',
                                'data-inputmask' => "'mask': '(99)9999[9]-9999', 'greedy': 'false'",
                                'placeholder' => 'Informe um telefone',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('telefone2') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="telefone2">Telefone secundário
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('telefone2', old('telefone2'), [
                                'id' => 'telefone2',
                                'data-inputmask' => "'mask': '(99)9999[9]-9999', 'greedy': 'false'",
                                'placeholder' => 'Informe um telefone',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('sexo') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="sexo">Sexo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <div class="radio">
                                <div style="padding-left: 22px">
                                    <div style="display: none">
                                        {!! Form::radio('sexo', '', false, ['required']) !!}
                                    </div>
                                </div>
                                <label>
                                    {!! Form::radio('sexo', 'm', false, ['class' => 'flat']) !!}
                                    Masculino
                                </label>
                                <label>
                                    {!! Form::radio('sexo', 'f', false, ['class' => 'flat']) !!}
                                    Feminino
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('estado_civil') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="estado_civil">Estado civil <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <div class="radio">
                                <div style="padding-left: 22px">
                                    <div style="display: none">
                                        {!! Form::radio('estado_civil', '', false, ['required']) !!}
                                    </div>
                                </div>
                                <label>
                                    {!! Form::radio('estado_civil', 'solteiro', old('estado_civil') == 'solteiro' ? true : false, ['class' => 'flat']) !!}
                                    Solteiro
                                </label>
                                <label>
                                    {!! Form::radio('estado_civil', 'casado', old('estado_civil') == 'casado' ? true : false, ['class' => 'flat']) !!}
                                    Casado
                                </label>
                                <label>
                                    {!! Form::radio('estado_civil', 'divorciado', old('estado_civil') == 'divorciado' ? true : false, ['class' => 'flat']) !!}
                                    Divorciado
                                </label>
                                <label>
                                    {!! Form::radio('estado_civil', 'viuvo', old('estado_civil') == 'viuvo' ? true : false, ['class' => 'flat']) !!}
                                    Viuvo
                                </label>
                                <label>
                                    {!! Form::radio('estado_civil', 'separado', old('estado_civil') == 'separado' ? true : false, ['class' => 'flat']) !!}
                                    Separado
                                </label>
                            </div>
                        </div>
                    </div>

                    <br/>
                    <div class="ln_solid"></div>
                    <br/>

                    <div class="item form-group {!! $errors->has('cep') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="cep">CEP <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12 ">
                            {{Form::text('cep', old('cep'), [
                                'id' => 'cep',
                                'required' => 'required',
                                'data-parsley-cep' => 'cep',
                                'data-inputmask' => "'mask': '99999-999'",
                                'placeholder' => 'Informe um cep',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                            <div id="cep_status"></div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label class="control-label">
                                <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/"
                                   target="_blank">Não sei meu CEP</a>
                            </label>
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('cidade') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="cidade">Cidade <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('cidade', old('cidade'), [
                                'id' => 'cidade',
                                'required' => 'required',
                                'readonly',
                                'placeholder' => 'Informe uma cidade',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('bairro') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="bairro">Bairro <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('bairro', old('bairro'), [
                                'id' => 'bairro',
                                'required' => 'required',
                                $errors->has('bairro') ? '' : 'readonly',
                                'placeholder' => 'Informe um bairro',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('rua') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="rua">Rua <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('rua', old('rua'), [
                                'id' => 'rua',
                                'required' => 'required',
                                $errors->has('rua') ? '' : 'readonly',
                                'placeholder' => 'Informe uma rua',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('numero') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="numero">Número <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('numero', old('numero'), [
                                'id' => 'numero',
                                'required' => 'required',
                                'data-parsley-type'=> 'integer',
                                'data-inputmask' => "'mask': '9{1,5}'",
                                'placeholder' => 'Informe um número',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('complemento') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="complemento">Complemento
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('complemento', old('complemento'), [
                                'id' => 'complemento',
                                'placeholder' => 'Informe um complemento',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                            <a href="{{route('clientes.listar')}}" class="btn btn-default" type="button">Cancelar</a>
                            <button class="btn btn-primary" type="reset">Limpar</button>
                            <button type="submit" class="btn btn-success">Salvar Cliente</button>
                        </div>
                    </div>


                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection