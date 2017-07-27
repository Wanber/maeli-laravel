@extends('layouts.base')

@push('stylesheets')
@endpush

@push('scripts')
<script language="JavaScript">

    function permissao(permissao, descricao) {

        $.alert({
            title: permissao,
            content: descricao,
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
    Perfis e Permissões
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
                    <h2>Novo perfil
                        <small>(*) campos obrigatórios</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! BootForm::open([
                        'url' => route('perfis_permissoes.novo.salvar'),
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
                                'required' => 'required',
                                'placeholder' => 'Informe um nome',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('descricao') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="descricao">Descricao <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('descricao', old('descricao'), [
                                'required' => 'required',
                                'placeholder' => 'Informe um nome',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group checkbox {!! $errors->has('regras[]') ? 'has-error' : '' !!}">
                        <div class="control-label col-md-3 col-sm-3 col-xs-12">Permissões
                            <span class="required">*</span></div>

                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <div class="checkbox">
                                <div style="padding-left: 22px">
                                    <div style="display: none">
                                        {!! Form::radio('permissoes[]', '', false, ['required']) !!}
                                    </div>
                                </div>

                                <table class="table">

                                    @foreach($permissoes as $permissao)

                                        <tr>
                                            <td>
                                                <label for="permission-{{$permissao->name}}" class="control-label">
                                                    {{Form::checkbox('permissoes[]', $permissao->id, in_array($permissao->id, old('permissoes[]', array())) ? true : false, [
                                                        'class' => 'flat'
                                                    ])}}
                                                    {{$permissao->display_name}}
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript: permissao('{{$permissao->display_name}}', '{{$permissao->description}}')"><i
                                                            class="fa fa-question-circle"></i></a>
                                            </td>
                                        </tr>

                                    @endforeach

                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                            <a href="{{route('usuarios.listar')}}" class="btn btn-default" type="button">Cancelar</a>
                            <button type="submit" class="btn btn-success">Criar Perfil</button>
                        </div>
                    </div>

                    {!! BootForm::close() !!}

                    <div id="oi"></div>
                </div>
            </div>
        </div>
    </div>

@endsection