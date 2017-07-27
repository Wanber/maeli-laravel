<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2></h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                        <h1>Olá, {{Auth::user()->name}}!</h1>
                        <p>
                            Este módulo necessita ser devidamente configurado, parece que você ainda não
                            realizou a configuração ou a configuração atual é inválida, clique no botão abaixo
                            para ir as configurações.
                        </p>
                        <div class="text-right">
                            <a class="btn btn-primary"
                               href="@stack('link_configuracoes')">
                                Configurações do módulo
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>