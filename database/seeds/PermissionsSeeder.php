<?php

use Illuminate\Database\Seeder;
use Maeli\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissao_mod_dev = new Permission();
        $permissao_mod_dev->name = 'mod-dev';
        $permissao_mod_dev->display_name = 'Módulo Desenvolvedor';
        $permissao_mod_dev->description = 'Permite acesso a logs e configurações internas do sistema';
        $permissao_mod_dev->save();

        $permissao_manter_usuarios = new Permission();
        $permissao_manter_usuarios->name = 'manter-usuarios';
        $permissao_manter_usuarios->display_name = 'Manter usuários';
        $permissao_manter_usuarios->description = 'Permite criar, editar e excluir usuários do sistema e atribuir suas permissões.';
        $permissao_manter_usuarios->save();

        $permissao_mod_perfis_permissoes = new Permission();
        $permissao_mod_perfis_permissoes->name = 'mod-perfis-permissoes';
        $permissao_mod_perfis_permissoes->display_name = 'Módulo Perfis e Permissões';
        $permissao_mod_perfis_permissoes->description = 'Permite criar, editar e excluir perfis e permissões do sistema.';
        $permissao_mod_perfis_permissoes->save();

        $permissao_manter_clientes = new Permission();
        $permissao_manter_clientes->name = 'manter-clientes';
        $permissao_manter_clientes->display_name = 'Manter clientes';
        $permissao_manter_clientes->description = 'Permite criar, editar e excluir clientes';
        $permissao_manter_clientes->save();

        $permissao_manter_servicos = new Permission();
        $permissao_manter_servicos->name = 'manter-servicos';
        $permissao_manter_servicos->display_name = 'Manter serviços';
        $permissao_manter_servicos->description = 'Permite criar, editar e excluir serviços';
        $permissao_manter_servicos->save();

        $permissao_manter_parceiros = new Permission();
        $permissao_manter_parceiros->name = 'manter-parceiros';
        $permissao_manter_parceiros->display_name = 'Manter parceiros';
        $permissao_manter_parceiros->description = 'Permite criar, editar e excluir parceiros';
        $permissao_manter_parceiros->save();

        $permissao_manter_pacotes = new Permission();
        $permissao_manter_pacotes->name = 'manter-pacotes';
        $permissao_manter_pacotes->display_name = 'Manter pacotes';
        $permissao_manter_pacotes->description = 'Permite criar, editar e excluir pacotes';
        $permissao_manter_pacotes->save();

        $permissao_mod_marketing = new Permission();
        $permissao_mod_marketing->name = 'mod-marketing';
        $permissao_mod_marketing->display_name = 'Módulo de Marketing';
        $permissao_mod_marketing->description = 'Permite acesso ao módulo Marketing (Impulsionar pacotes nas redes sociais)';
        $permissao_mod_marketing->save();

        $permissao_mod_relatorios = new Permission();
        $permissao_mod_relatorios->name = 'mod-relatorios';
        $permissao_mod_relatorios->display_name = 'Módulo de Relatórios';
        $permissao_mod_relatorios->description = 'Permite acesso ao módulo Relatórios';
        $permissao_mod_relatorios->save();

        $permissao_mod_mercadopago = new Permission();
        $permissao_mod_mercadopago->name = 'mod-mercadopago';
        $permissao_mod_mercadopago->display_name = 'Módulo do MercadoPago';
        $permissao_mod_mercadopago->description = 'Permite acesso ao módulo MercadoPago (Ver saldo, emitir pagamento, histórico)';
        $permissao_mod_mercadopago->save();

        $permissao_conf_sistema = new Permission();
        $permissao_conf_sistema->name = 'conf-sistema';
        $permissao_conf_sistema->display_name = 'Configurações do sistema';
        $permissao_conf_sistema->description = 'Permite alterar as configurações do sistema';
        $permissao_conf_sistema->save();

        $role = new \Maeli\Role();
        $admin_role = $role->where(['name' => 'admin'])->first();
        $dev_role = $role->where(['name' => 'dev'])->first();

        $dev_role->attachPermissions(array(
            $permissao_mod_dev,
            $permissao_manter_usuarios,
            $permissao_mod_perfis_permissoes,
            $permissao_manter_clientes,
            $permissao_manter_servicos,
            $permissao_manter_parceiros,
            $permissao_manter_pacotes,
            $permissao_mod_marketing,
            $permissao_mod_relatorios,
            $permissao_mod_mercadopago,
            $permissao_conf_sistema
        ));

        $admin_role->attachPermissions(array(
            $permissao_manter_usuarios,
            $permissao_mod_perfis_permissoes,
            $permissao_manter_clientes,
            $permissao_manter_servicos,
            $permissao_manter_parceiros,
            $permissao_manter_pacotes,
            $permissao_mod_marketing,
            $permissao_mod_relatorios,
            $permissao_mod_mercadopago,
            $permissao_conf_sistema
        ));
    }
}
