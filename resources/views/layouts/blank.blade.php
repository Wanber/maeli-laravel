<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('titulo')</title>

    <!-- Bootstrap -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/bootstrap-theme.min.css") }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset("css/gentelella.min.css") }}" rel="stylesheet">
    <!-- Nprogress -->
    <link href="{{ url("vendor/nprogress/nprogress.min.css") }}" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{ url("vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css") }}" rel="stylesheet"/>
    <!-- iCheck -->
    <link href="{{ url("vendor/iCheck/skins/square/_all.min.css")}}" rel="stylesheet">
    <!-- jQuery Confirm -->
    <link href="{{ url("vendor/jquery-confirm/dist/jquery-confirm.min.css")}}" rel="stylesheet">

    @stack('stylesheets')

    <link href="{{ asset("css/app.min.css") }}" rel="stylesheet"><!-- App Theme Style -->
</head>

<body class="blank">

@yield('main_container')


<!-- jQuery -->
<script src="{{ asset("js/jquery.min.js") }}"></script>
<!-- Bootstrap -->
<script src="{{ asset("js/bootstrap.min.js") }}"></script>
<!-- Nprogress -->
<script src="{{ url("vendor/nprogress/nprogress.min.js") }}"></script>
<!-- jQuery custom content scroller -->
<script src="{{ url("vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js") }}"></script>
<!-- ParsleyJs -->
<script src="{{url("vendor/parsleyjs/parsley.min.js")}}"></script>
<script src="{{url("vendor/parsleyjs/parsley-validatores.js")}}"></script>
<script src="{{url("vendor/parsleyjs/i18n/pt-br.min.js")}}"></script>
<!-- iCheck -->
<script src="{{url("vendor/iCheck/icheck.min.js")}}"></script>
<!-- jquery.inputmask -->
<script src="{{url("vendor/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js")}}"></script>
<!-- jQuery Confirm -->
<script src="{{url("vendor/jquery-confirm/dist/jquery-confirm.min.js")}}"></script>

@stack('scripts')

<!-- Custom Theme Scripts -->
<script src="{{ asset("js/gentelella.min.js") }}"></script>

</body>
</html>