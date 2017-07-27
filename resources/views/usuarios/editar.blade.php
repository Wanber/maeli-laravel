@extends('layouts.base')

@push('stylesheets')
<!-- bootstrap fileupload -->
<link href="{{url('vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet"/>
@endpush

@push('scripts')

<script language="JavaScript">
    $(function () {
        $("#upload").fileinput({
            language: 'pt-BR',
            required: false,
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            showUpload: false,
            showRemove: false,
        });
    });

    function permissoes(perfil, permissoes) {

        var permissoes_tr = '';

        permissoes.forEach(function (permissao, p2, p3) {
            permissoes_tr += '<tr><td style="font-weight: bold;">' + permissao.display_name + '</td><td>' + permissao.description + '</td></tr>';
        });


        $.alert({
            title: perfil,
            content: '<table class="table table-striped table-bordered">' +
            permissoes_tr +
            '</table>',
            type: 'blue',
            theme: 'material',
            buttons: {
                ok: {
                    text: 'OK',
                    btnClass: 'btn-success',
                    keys: ['enter'],
                    action: function () {
                        //
                    }
                }
            }
        });
    }
</script>
@endpush

@section('titulo')
    Editar Usuário
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
                    <h2>Editar Usuário - {{$usuario->name}}
                        <small>(*) campos obrigatórios</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox"></ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <br/>

                    @if($usuario->roles->get(0)->name == 'dev' && Auth::user()->id != $usuario->id)
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
                                            <div class="jumbotron">
                                                <h1>Olá, {{Auth::user()->name}}!</h1>
                                                <p>
                                                    Você não pode editar usuários Desenvolvedores.
                                                </p>
                                                <div class="text-right">
                                                    <a class="btn btn-primary"
                                                       href="{{route('usuarios.listar')}}">
                                                        Voltar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @else



                        {!! BootForm::open([
                            'enctype' => 'multipart/form-data',
                            'url' => route('usuarios.atualizar'),
                            'method' => 'post',
                            'class' => 'form-horizontal form-label-left',
                            'data-parsley-validate'
                        ]) !!}

                        @if(Auth::user()->id == $usuario->id)

                            <div class="item form-group {!! $errors->has('nome') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="nome">Nome <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    {{Form::text('nome', old('nome', $usuario->name), [
                                        'required' => 'required',
                                        'placeholder' => 'Informe um nome',
                                        'class' => 'form-control col-md-7 col-xs-12'
                                    ])}}
                                </div>
                            </div>

                            <div class="item form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="email">Email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    {{Form::email('email', old('email', $usuario->email), [
                                        'required' => 'required',
                                        'placeholder' => 'Informe um email',
                                        'class' => 'form-control col-md-7 col-xs-12'
                                    ])}}
                                </div>
                            </div>

                            <div class="item form-group {!! $errors->has('senha') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="senha">Nova Senha <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    Deixe este campo em branco para manter sua senha atual.
                                    {{Form::password('senha', [
                                        'placeholder' => 'Informe uma senha',
                                        'id' => 'senha',
                                        'minlength' => '6',
                                        'class' => 'form-control col-md-7 col-xs-12'
                                    ])}}
                                </div>
                            </div>

                            <div class="item form-group {!! $errors->has('senha2') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="senha2">Repita a senha <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    {{Form::password('senha2', [
                                        'placeholder' => 'Confirme a senha',
                                        'minlength' => '6',
                                        'data-parsley-equalto' => '#senha',
                                        'class' => 'form-control col-md-7 col-xs-12'
                                    ])}}
                                </div>
                            </div>

                            <div class="item form-group {!! $errors->has('foto') ? 'has-error' : '' !!}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="senha2">Foto <span class="required">*</span>
                                </label>
                                <div class="col-md-1 col-sm-1 col-xs-2">
                                    <img src="{{url($usuario->foto_path)}}?w=50&h=50" style="border-radius:4px;">
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-10">
                                    {{Form::file('foto', ['id' => 'upload'])}}
                                </div>
                            </div>

                        @endif

                        <div class="item form-group checkbox {!! $errors->has('perfil') ? 'has-error' : '' !!}">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">Perfil
                                <span class="required">*</span></div>

                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <div class="radio">
                                    <div style="padding-left: 22px">
                                        <div style="display: none">
                                            {!! Form::radio('perfil', '', false, ['required']) !!}
                                        </div>
                                    </div>

                                    @foreach($perfis as $perfil)

                                        <label for="role-{{$perfil->name}}" class="control-label">

                                            {{Form::radio('perfil', $perfil->id, old('perfil', $usuario->roles->get(0)->id) == $perfil->id ? true : false, [
                                                'class' => 'flat'
                                            ])}}
                                            {{$perfil->display_name}}
                                        </label>
                                        <a href="javascript: permissoes('{{$perfil->display_name}}', {{$perfil->permissions}})"><i
                                                    class="fa fa-question-circle"></i></a>

                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                                <a href="{{route('usuarios.listar')}}" class="btn btn-default"
                                   type="button">Cancelar</a>
                                <a href="{{route('perfis_permissoes.novo')}}" class="btn btn-primary" type="button">Novo
                                    Perfil de Usuário</a>

                                {{Form::hidden('id', $usuario->id)}}
                                <button type="submit" class="btn btn-success">Atualizar Usuário</button>
                            </div>
                        </div>

                        {!! BootForm::close() !!}

                    @endif


                </div>
            </div>
        </div>
    </div>

@endsection