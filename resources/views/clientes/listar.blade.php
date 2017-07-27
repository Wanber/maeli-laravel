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

    function ver(cliente, url_editar, url_excluir) {

        var compl = cliente.complemento;
        var compl_tr = compl == '' ? '' : '<tr><td style="font-weight: bold;">Complemento</td><td>' + compl + '</td></tr>';

        var tel2 = cliente.telefones[1];
        var tel2_tr = tel2 == null ? '' : '<tr><td style="font-weight: bold;">Telefone secundário</td><td>' + tel2.numero + '</td></tr>';

        $.alert({
            title: cliente.nome,
            content: '<table class="table table-striped table-bordered">' +
            '<tr><td style="font-weight: bold;">CPF</td><td>' + cliente.cpf + '</td></tr>' +
            '<tr><td style="font-weight: bold;">RG</td><td>' + cliente.rg + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Data de nascimento</td><td>' + cliente.dt_nascimento + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Email</td><td><a href="mailto: ' + cliente.email + '">' + cliente.email + '</a></td></tr>' +
            '<tr><td style="font-weight: bold;">Telefone principal</td><td>' + cliente.telefones[0].numero + '</td></tr>' +
            tel2_tr +
            '<tr><td style="font-weight: bold;">Sexo</td><td>' + cliente.sexo + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Estado civil</td><td>' + cliente.estado_civil + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Cep</td><td>' + cliente.cep + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Cidade</td><td>' + cliente.cidade + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Bairro</td><td>' + cliente.bairro + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Rua</td><td>' + cliente.rua + '</td></tr>' +
            '<tr><td style="font-weight: bold;">Número</td><td>' + cliente.numero + '</td></tr>' +
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
                        excluir(cliente.nome, url_excluir)
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
                <th>Nome</th>
                <th>CPF</th>
                <th>Sexo</th>
                <th>Idade</th>
                <!--<th>Email</th>-->
                <th>Telefones</th>
                <th>Cidade</th>
                <th>Ação</th>
            </tr>
            </thead>

            <tbody>

            @foreach($clientes as $cliente)
                <tr>
                    <td>{{$cliente->nome}}</td>
                    <td>{{$cliente->cpf()}}</td>
                    <td>{{$cliente->sexo()}}</td>
                    <td>{{$cliente->idade()}}</td>
                <!--<td>{{$cliente->email}}</td>-->
                    <td>
                        @foreach($cliente->telefones as $telefone)
                            {{$telefone->numero()}}<br/>
                        @endforeach
                    </td>
                    <td>{{$cliente->cidade}}</td>
                    <td>
                        <?php
                        $cliente2 = $cliente;
                        $cliente2->cpf = $cliente2->cpf();
                        $cliente2->dt_nascimento = $cliente2->dt_nascimento('d/m/Y');
                        $cliente2->telefones->get(0)->numero = $cliente2->telefones->get(0)->numero();
                        if ($cliente2->telefones->get(1) != null)
                            $cliente2->telefones->get(1)->numero = $cliente2->telefones->get(1)->numero();
                        $cliente2->cep = $cliente2->cep();
                        $cliente2->estado_civil = $cliente2->estado_civil();
                        $cliente2->sexo = $cliente2->sexo();
                        ?>
                        <a href="javascript:ver({{json_encode($cliente2)}},'{{route('clientes.editar',['id' => $cliente->id])}}','{{route('clientes.excluir',['id' => $cliente->id])}}')"
                           class="btn btn-default btn-sm"><i class="fa fa-user"></i></a>
                        <a href="{{route('clientes.editar', ['id' => $cliente->id])}}"
                           class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:excluir('{{$cliente->nome}}','{{route('clientes.excluir',['id' => $cliente->id])}}')"
                           class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection