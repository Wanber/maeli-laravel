<?php

use Illuminate\Database\Seeder;
use Maeli\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev_role = new Role();
        $dev_role->name = 'dev';
        $dev_role->display_name = 'Desenvolvedor';
        $dev_role->description = 'Desenvolvedor do sistema';
        $dev_role->save();

        $admin_role = new Role();
        $admin_role->name = 'admin';
        $admin_role->display_name = 'Administrador';
        $admin_role->description = 'Administrador do sistema';
        $admin_role->save();
    }
}
