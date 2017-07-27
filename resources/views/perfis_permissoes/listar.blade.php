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

</script>
@endpush

@section('titulo')
    Todos Perfis
@endsection

@section('modulo_nome')
    Todos Perfis
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
                <th>Permissões</th>
                <th>Ação</th>
            </tr>
            </thead>

            <tbody>

            @foreach($perfis as $perfil)
                <tr>
                    <td>{{$perfil->display_name}}</td>
                    <td>{{$perfil->description}}</td>
                    <td>
                        <ul class="list-unstyled">
                            @foreach($permissoes as $permissao_sistema)
                                <?php $contem = false; ?>
                                @foreach($perfil->permissions as $permissao)
                                    @if($permissao_sistema->name == $permissao->name)
                                        <?php $contem = true; ?>
                                        <li><i class="fa fa-check" style="color: #109c12"></i> {{$permissao_sistema->display_name}}</li>
                                    @endif
                                @endforeach

                                @if(!$contem)
                                        <li><i class="fa fa-times" style="color: #c40000"></i> {{$permissao_sistema->display_name}}</li>
                                @endif

                            @endforeach
                        </ul>
                    </td>
                    <td style="white-space: nowrap;">
                        <a href="{{route('perfis_permissoes.editar', ['id' => $perfil->id])}}"
                           class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:excluir('{{$perfil->nome}}','{{route('perfis_permissoes.excluir',['id' => $perfil->id])}}')"
                           class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection