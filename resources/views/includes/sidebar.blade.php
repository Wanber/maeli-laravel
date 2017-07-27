<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/') }}" class="site_title"><i class="fa fa-paw"></i>
                <span>{{config('app.name')}}</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile" style="margin-bottom: 100px">
            <div class="profile_pic">
                <img src="{{ url(Auth::user()->foto_path) }}?w=50&h=50" alt="{{ Auth::user()->name }}"
                     class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bem vindo,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3>ADMINISTRATIVO</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{url('/')}}/"><i class="fa fa-home"></i> Início </a>
                    </li>

                    @permission('manter-clientes')
                    <li><a><i class="fa fa-user-o"></i> Clientes <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('clientes.listar')}}">Ver Clientes</a></li>
                            <li><a href="{{route('clientes.novo')}}">Novo Cliente</a></li>
                        </ul>
                    </li>
                    @endpermission
                    @permission('manter-servicos')
                    <li><a><i class="fa fa-code-fork"></i> Serviços <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('servicos.listar')}}">Ver Serviços</a></li>
                            <li><a href="{{route('servicos.novo')}}">Novo Serviço</a></li>
                        </ul>
                    </li>
                    @endpermission
                    @permission('manter-parceiros')
                    <li><a><i class="fa fa-handshake-o"></i> Parceiros <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('parceiros.listar')}}">Ver Parceiros</a></li>
                            <li><a href="{{route('parceiros.novo')}}">Novo Parceiro</a></li>
                        </ul>
                    </li>
                    @endpermission
                    @permission('manter-pacotes')
                    <li><a><i class="fa fa-bus"></i> Pacotes <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('pacotes.listar')}}">Ver Pacotes</a></li>
                            <li><a href="{{route('pacotes.novo')}}">Novo Pacote</a></li>
                        </ul>
                    </li>
                    @endpermission
                    @permission('mod-marketing')
                    <li><a><i class="fa fa-shopping-bag"></i> Marketing <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="?tab=6">Impulsionar pacote no Facebook</a></li>
                            <li><a href="?tab=7">Impulsionar pacote no Instagram</a></li>
                        </ul>
                    </li>
                    @endpermission
                    @permission('mod-relatorios')
                    <li><a><i class="fa fa-line-chart"></i> Relatórios <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="?tab=16">Tendencias</a></li>
                            <li><a href="?tab=14">Financeiro</a></li>
                            <li><a href="?tab=14">Vendas</a></li>
                        </ul>
                    </li>
                    @endpermission
                    <li>
                        <a href="#"><i class="fa fa-laptop"></i> Landing Page </a>
                    </li>

                </ul>
            </div>

            <div class="menu_section">
                <h3>GATEWAYS DE PAGAMENTO</h3>
                <ul class="nav side-menu">
                    @permission('mod-mercadopago')
                    <li><a><i class="fa fa-credit-card"></i> MercadoPago <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('mercadopago.saldo')}}">Saldo</a></li>
                            <li><a href="{{route('mercadopago.historico')}}">Histórico</a></li>
                            <li><a href="{{route('mercadopago.emitir_pagamento')}}">Emitir pagamento</a></li>
                            <li><a href="{{route('mercadopago.configuracoes_conta')}}">Configurações do SDK</a></li>
                        </ul>
                    </li>
                    @endpermission
                </ul>
            </div>

            <div class="menu_section">
                <h3>SISTEMA</h3>
                <ul class="nav side-menu">
                    @permission('conf-sistema')
                    <li>
                        <a href="{{route('configuracoes')}}"><i class="fa fa-cogs"></i> Configurações </a>
                    </li>
                    @endpermission
                    @permission('mod-perfis-permissoes')
                    <li><a><i class="fa fa-unlock-alt"></i> Perfis e Permissões <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('perfis_permissoes.listar')}}">Ver Perfis e Permissões</a></li>
                            <li><a href="{{route('perfis_permissoes.novo')}}">Novo Perfil</a></li>
                        </ul>
                    </li>
                    @endpermission
                    @permission('manter-usuarios')
                    <li><a><i class="fa fa-users"></i> Usuários <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('usuarios.listar')}}">Ver usuários</a></li>
                            <li><a href="{{route('usuarios.novo')}}">Novo usuário</a></li>
                        </ul>
                    </li>
                    @endpermission
                    @permission('mod-dev')
                    <li><a><i class="fa fa-hashtag"></i> Desenvolvedor <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Manutenção</a></li>
                            <li><a href="#">Logs</a></li>
                        </ul>
                    </li>
                    @endpermission
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Configurações" href="{{route('configuracoes')}}">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" class="fullscreen" data-placement="top" title="FullScreen"
               href="javascript: requestFullScreen()">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Contato" href="javascript: contato()">
                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Sair" href="{{ route('logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>