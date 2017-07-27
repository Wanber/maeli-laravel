<html>
<head>
    <style>
        a.btn {
            background: #2A3F54;
            padding: 10px;
            color: #FFFFFF;
            text-decoration: none;
        }

        a, a:visited, a:focus, a:active, a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>

<h1>{{$titulo}}</h1>
<p>{!! $conteudo !!}</p>
@if(@$acao)
    <a class="btn" href="{{$acao['link']}}">&nbsp;{{$acao['nome']}}&nbsp;</a>
@endif

<br/><br/>
<p><a href="{{config('app.url')}}">{{config('app.name')}}</a> - Descubra o barato de viajar.</p>

</body>
</html>