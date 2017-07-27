@extends('layouts.base')

@push('stylesheets')
<!-- Datatables -->
<link href="{{ url("vendor/datatables.net-bs/css/dataTables.bootstrap.min.css") }}" rel="stylesheet">
<link href="{{ url("vendor/datatables.net-buttons-bs/css/buttons.bootstrap.min.css") }}" rel="stylesheet">
<link href="{{ url("vendor/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css") }}" rel="stylesheet">
<link href="{{ url("vendor/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") }}" rel="stylesheet">
<link href="{{ url("vendor/datatables.net-scroller-bs/css/scroller.bootstrap.min.css") }}" rel="stylesheet">
@endpush

@push('scripts')
<!-- Datatables -->
<script src="{{ url("vendor/datatables.net/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ url("vendor/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
<script src="{{ url("vendor/datatables.net-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ url("vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js") }}"></script>
<script src="{{ url("vendor/datatables.net-buttons/js/buttons.flash.min.js") }}"></script>
<script src="{{ url("vendor/datatables.net-buttons/js/buttons.html5.min.js") }}"></script>
<script src="{{ url("vendor/datatables.net-buttons/js/buttons.print.min.js") }}"></script>
<script src="{{ url("vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js") }}"></script>
<script src="{{ url("vendor/datatables.net-keytable/js/dataTables.keyTable.min.js") }}"></script>
<script src="{{ url("vendor/datatables.net-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ url("vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js") }}"></script>
<script src="{{ url("vendor/datatables.net-scroller/js/dataTables.scroller.min.js") }}"></script>
<script src="{{ url("vendor/jszip/dist/jszip.min.js") }}"></script>
<script src="{{ url("vendor/pdfmake/build/pdfmake.min.js") }}"></script>
<script src="{{ url("vendor/pdfmake/build/vfs_fonts.js") }}"></script>

<script language="JavaScript">

    function excluir(nome, url) {
        $.confirm({
            title: 'Confirmação necessária',
            content: 'Deseja realmente excluir ' + nome + '?',
            type: 'orange',
            theme: 'modern',
            buttons: {
                excluir: {
                    text: 'EXCLUIR',
                    btnClass: 'btn-danger',
                    action: function () {
                        window.location = url
                    }
                },
                cancelar: {
                    text: 'CANCELAR',
                    btnClass: 'btn-default',
                    keys: ['enter'],
                    action: function () {
                        //
                    }
                }
            }
        });
    }

    function ver(parceiro, url_editar, url_excluir) {

        var cpf_tr = parceiro.cpf == '' ? '' : '<tr><td style="font-weight: bold;">CPF</td><td>' + parceiro.cpf + '</td></tr>';
        var cnpj_tr = parceiro.cnpj == '' ? '' : '<tr><td style="font-weight: bold;">CNPJ</td><td>' + parceiro.cnpj + '</td></tr>';

        var compl = parceiro.complemento;
        var compl_tr = compl == '' ? '' : '<tr><td style="font-weight: bold;">Complemento</td><td>' + compl + '</td></tr>';

        var tel2 = parceiro.telefone2;
        var tel2_tr = tel2 == '' ? '' : '<tr><td style="font-weight: bold;">Telefone secundário</td><td>' + tel2 + '</td></tr>';

        $.alert({
            title: parceiro.nome,
            content: '<table class="table table-striped table-bordered">' +
            '<tr><td style="font-weight: bold;">Tipo</td><td>' + parceiro.tipo + '</td></tr>' +
            cpf_tr +
            cnpj_tr +
            '<tr><td style="font-weight: bold;">Email</td><td><a href="mailto: ' + parceiro.email + '">' + parceiro.email + '</a></td></tr>' +
            '<tr><td style="font-weight: bold;">Telefone principal</td><td>' + parceiro.telefone + '</td></tr>' +
            tel2_tr +
            '<tr><td style="font-weight: bold;">Cep</td><td>' + parceiro.cep + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Cidade</td><td>' + parceiro.cidade + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Bairro</td><td>' + parceiro.bairro + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Rua</td><td>' + parceiro.rua + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Número</td><td>' + parceiro.numero + '</td></tr>' +
            compl_tr +
            '</table>',
            type: 'green',
            theme: 'material',
            buttons: {
                editar: {
                    text: 'EDITAR',
                    btnClass: 'btn-primary',
                    action: function () {
                        window.location = url_editar
                    }
                },
                excluir: {
                    text: 'EXCLUIR',
                    btnClass: 'btn-danger',
                    action: function () {
                        excluir(parceiro.nome, url_excluir)
                    }
                },
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
    Todos Clientes
@endsection

@section('modulo_nome')
    Todos Clientes
@endsection

@section('modulo_desc')

@endsection

@section('main_container')

    <div class="row">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Tipo</th>
                <th>Nome</th>
                <th>CPF / CNPJ</th>
                <th>Email</th>
                <th>Telefones</th>
                <th>Cidade</th>
                <th>Ação</th>
            </tr>
            </thead>

            <tbody>

            @foreach($parceiros as $parceiro)
                <tr>
                    <td>{!! $parceiro->tipoColorido() !!}</td>
                    <td>{{$parceiro->nome}}</td>
                    <td>@if($parceiro->cpf != '') {{$parceiro->cpf()}} @if($parceiro->cnpj != '')
                            <br/>{{$parceiro->cnpj()}} @endif @else {{$parceiro->cnpj()}} @endif</td>
                    <td><a href="mailto: {{$parceiro->email}}">{{$parceiro->email}}</a></td>
                    <td>{{$parceiro->telefone()}}<br/>{{$parceiro->telefone2()}}</td>
                    <td>{{$parceiro->cidade}}</td>
                    <td style="white-space: nowrap;">
                        <?php
                        $parceiro2 = $parceiro;
                        $parceiro2->cpf = $parceiro2->cpf();
                        $parceiro2->cnpj = $parceiro2->cnpj();
                        $parceiro2->tipo = $parceiro2->tipoColorido();
                        $parceiro2->telefone = $parceiro2->telefone();
                        $parceiro2->telefone2 = $parceiro2->telefone2();
                        $parceiro2->cep = $parceiro2->cep();
                        ?>
                        <a href="javascript:ver({{json_encode($parceiro2)}},'{{route('parceiros.editar',['id' => $parceiro->id])}}','{{route('parceiros.excluir',['id' => $parceiro->id])}}')"
                           class="btn btn-default btn-sm"><i class="fa fa-user"></i></a>
                        <a href="{{route('parceiros.editar', ['id' => $parceiro->id])}}"
                           class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:excluir('{{$parceiro->nome}}','{{route('parceiros.excluir',['id' => $parceiro->id])}}')"
                           class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection