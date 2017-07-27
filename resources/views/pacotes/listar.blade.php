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

    function ver(pacote, url_editar, url_excluir) {

        var tr_servicos = '<tr><td style="font-weight: bold;">Serviços</td><td><ul>';

        pacote.servicos.forEach(function (servico) {
            tr_servicos += '<li>' + servico.nome + '</li>';
        });

        tr_servicos += '</ul></td></tr>';

        $.alert({
            title: pacote.nome,
            content: '<table class="table table-striped table-bordered">' +
            '<tr><td style="font-weight: bold;">Descrição</td><td>' + pacote.descricao + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Valor</td><td>R$ ' + pacote.valor + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Partida</td><td>' + pacote.dt_partida + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Chegada</td><td>' + pacote.dt_chegada + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Local Embarque</td><td>' + pacote.local_embarque + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Destino</td><td>' + pacote.destino + '</td></tr>' +
            tr_servicos +
            '</td></tr>' +
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
                        excluir(pacote.nome, url_excluir)
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
    Todos Pacotes
@endsection

@section('modulo_nome')
    Todos Pacotes
@endsection

@section('modulo_desc')

@endsection

@section('main_container')

    <div class="row">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Saída</th>
                <th>Destino</th>
                <th>Serviços</th>
                <th>Ação</th>
            </tr>
            </thead>

            <tbody>

            @foreach($pacotes as $pacote)
                <tr>
                    <td>{{$pacote->nome}}</td>
                    <td>{{$pacote->descricao}}</td>
                    <td>R$ {{$pacote->valor()}}</td>
                    <td>{{$pacote->dt_partida('d/m/Y H:i')}}</td>
                    <td>{{$pacote->destino}}</td>
                    <td>
                        <ul>
                            @foreach($pacote->servicos as $servico)
                                <li style="white-space: nowrap;">{{$servico->nome}}</li>
                            @endforeach
                        </ul>
                    </td>

                    <td style="white-space: nowrap;">
                        <?php
                        $pacote2 = $pacote;
                        $pacote2->valor = $pacote2->valor();
                        $pacote2->dt_partida = $pacote2->dt_partida('d/m/Y H:i');
                        $pacote2->dt_chegada = $pacote2->dt_chegada('d/m/Y H:i');
                        ?>
                        <a href="javascript:ver({{json_encode($pacote2)}},'{{route('pacotes.editar',['id' => $pacote->id])}}','{{route('pacotes.excluir',['id' => $pacote->id])}}')"
                           class="btn btn-default btn-sm"><i class="fa fa-user"></i></a>
                        <a href="{{route('pacotes.editar', ['id' => $pacote->id])}}"
                           class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:excluir('{{$pacote->nome}}','{{route('pacotes.excluir',['id' => $pacote->id])}}')"
                           class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection