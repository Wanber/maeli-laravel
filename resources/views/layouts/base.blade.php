<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('titulo') | {{ config('app.name') }}</title>

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
    <!-- bootstrap fileupload -->
    <link href="{{url('vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet"/>

    @stack('stylesheets')

    <link href="{{ asset("css/app.min.css") }}" rel="stylesheet"><!-- App Theme Style -->

</head>

<body class="nav-md" id="body">
<div class="container body">
    <div class="main_container">

        @include('includes.sidebar')

        @include('includes.topbar')

        <div class="right_col" role="main">

            <div class="page-title">
                <div class="title_left">
                    <h3>@yield('modulo_nome')</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-7 col-sm-7 col-xs-12 form-group pull-right top_search text-right">
                        @yield('modulo_desc')
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            @include('includes.mensagens')

            @yield('main_container')
        </div>

        @include('includes.footer')

    </div>
</div>

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
<!-- bootstrap fileupload -->
<script src="{{url('vendor/kartik-v/bootstrap-fileinput/js/plugins/piexif.min.js')}}" type="text/javascript"></script>
<script src="{{url('vendor/kartik-v/bootstrap-fileinput/js/plugins/sortable.min.js')}}" type="text/javascript"></script>
<script src="{{url('vendor/kartik-v/bootstrap-fileinput/js/plugins/purify.min.js')}}" type="text/javascript"></script>
<script src="{{url('vendor/kartik-v/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{url('vendor/kartik-v/bootstrap-fileinput/js/locales/pt-BR.js')}}" type="text/javascript"></script>

@stack('scripts')

<!-- Custom Theme Scripts -->
<script src="{{ asset("js/gentelella.min.js") }}"></script>

</body>
</html>