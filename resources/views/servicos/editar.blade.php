@extends('layouts.base')

@push('stylesheets')
@endpush

@push('scripts')
@endpush

@section('titulo')
    Editar Serviço
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
                    <h2>Editar Serviço - {{$servico->nome}}
                        <small>(*) campos obrigatórios</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox"></ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! BootForm::open([
                        'url' => route('servicos.atualizar'),
                        'method' => 'post',
                        'class' => 'form-horizontal form-label-left',
                        'data-parsley-validate'
                    ]) !!}

                    <div class="item form-group {!! $errors->has('nome') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="nome">Nome <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            {{Form::text('nome', old('nome', $servico->nome), [
                                'id' => 'nome',
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
                            {{Form::textarea('descricao', old('descricao', $servico->descricao), [
                                'id' => 'descricao',
                                'required' => 'required',
                                'placeholder' => 'Informe uma descrição',
                                'rows' => '4',
                                'class' => 'form-control col-md-7 col-xs-12'
                            ])}}
                        </div>
                    </div>

                    <div class="item form-group {!! $errors->has('custo') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="custo">Custo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('custo', old('custo', $servico->custo()), [
                                'id' => 'custo',
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

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-right">
                            <a href="{{route('servicos.listar')}}" class="btn btn-default" type="button">Cancelar</a>
                            {{Form::hidden('id', $servico->id, ['id' => 'id'])}}
                            <button type="submit" class="btn btn-success">Atualizar Serviço</button>
                        </div>
                    </div>


                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection