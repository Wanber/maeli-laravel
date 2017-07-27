@if(session('msgs'))

    @foreach(session('msgs') as $msg)
        <div class="alert alert-{{$msg['tipo']}} alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                <span aria-hidden="true">×</span>
            </button>
            {{$msg['text']}}
        </div>
    @endforeach

@endif

@if($errors->any())

    @foreach($errors->all() as $erro)
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                <span aria-hidden="true">×</span>
            </button>
            {{$erro}}
        </div>
    @endforeach
@endif