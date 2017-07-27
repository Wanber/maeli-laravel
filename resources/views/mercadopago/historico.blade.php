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
    $(document).ready(function () {
        $('#datatable-historico').DataTable({
            "paging": false,
            "info": false,
            "ordering": false,
            "order": [[0, "desc"]],
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    });

    function status_info() {
        $.alert({
            title: 'Definições de status',
            content: '<table class="table table-striped table-bordered">' +
            '<tr><td><span class="text-success">Aprovado</span></td><td>O pagamento foi aprovado.</td></tr>' +
            '<tr><td><span class="text-info">Em análise</span></td><td>O pagamento está sendo revisado.</td></tr>' +
            '<tr><td><span class="text-warning">Pendente</span></td><td>O usuário não completou o processo de pagamento.</td></tr>' +
            '<tr><td><span class="text-warning">Em mediação</span></td><td>Iniciou-se uma disputa para o pagamento.</td></tr>' +
            '<tr><td><span class="text-danger">Recusado</span></td><td>O pagamento foi recusado, mas o usuário pode tentar novamente.</td></tr>' +
            '<tr><td><span class="text-danger">Cancelado</span></td><td>O pagamento foi cancelado por superar o tempo necessário para a realização do pagamento, ou por uma das partes.</td></tr>' +
            '<tr><td><span class="text-danger">Reembolsado</span></td><td>O pagamento foi devolvido ao usuário.</td></tr>' +
            '<tr><td><span class="text-danger">Charge back</span></td><td>Realizou-se um chargeback no cartão de crédito.</td></tr>' +
            '</table>',
            type: 'green',
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
    Histórico da conta - MercadoPago
@endsection

@section('modulo_nome')
    Histórico da conta MercadoPago
@endsection

@section('modulo_desc')
    Exibe o histórico de transações
@endsection

@section('main_container')

    @if(!$mp_sdk)
        @push('link_configuracoes')
        {{route('mercadopago.configuracoes_conta')}}
        @endpush
        @include('includes.configuracoes_invalidas')
    @else

        <div class="row">
            <table id="datatable-historico" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Cliente email</th>
                </tr>
                </thead>

                <tbody>

                @foreach($transacoes as $transacao)
                    <tr>
                        <th>{!! $transacao->getStatusCorolido() !!}
                            <a href="javascript: status_info()">&nbsp;&nbsp;<i class="fa fa-info-circle"></i></a>
                        </th>
                        <th>{{$transacao->getData('d/m/Y')}}</th>
                        <th>{{$transacao->valor_moeda}} {{$transacao->valor}}</th>
                        <th>{{$transacao->cliente_email}}</th>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="text-right">
                <ul class="pagination">
                    <li class="paginate_button previous @if($paginacao['pagina'] <= 1) disabled @endif"
                        id="datatable_previous">
                        <a href="@if($paginacao['pagina'] > 1) {{route('mercadopago.historico').'?p='.($paginacao['pagina']-1)}} @else # @endif"
                           aria-controls="datatable"
                           data-dt-idx="0"
                           tabindex="0">Anterior</a>
                    </li>

                    @for($x = 1; $x <= $paginacao['paginas']; $x++)
                        <li class="paginate_button @if($x == $paginacao['pagina']) active @endif">
                            <a href="@if($x == $paginacao['pagina']) # @else {{route('mercadopago.historico').'?p='.$x}} @endif"
                               aria-controls="datatable" data-dt-idx="1"
                               tabindex="0">{{$x}}</a></li>
                    @endfor

                    <li class="paginate_button next @if($paginacao['pagina'] >= $paginacao['paginas']) disabled @endif"
                        id="datatable_next">
                        <a href="@if($paginacao['pagina'] < $paginacao['paginas']) {{route('mercadopago.historico').'?p='.($paginacao['pagina']+1)}} @else # @endif"
                           aria-controls="datatable"
                           data-dt-idx="7" tabindex="0">Próxima</a></li>
                </ul>
            </div>


        </div>

    @endif

@endsection