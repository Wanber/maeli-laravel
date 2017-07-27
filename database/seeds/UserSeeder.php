<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wanber = factory('Maeli\User')->create([
            'name' => 'Wanber',
            'email' => 'wanber@outlook.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10)
        ]);

        $jhonatas = factory('Maeli\User')->create([
            'name' => 'Jhonatas',
            'email' => 'jhonatas02@gmail.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10)
        ]);

        $admin = factory('Maeli\User')->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin1'),
            'remember_token' => str_random(10)
        ]);

        $role = new \Maeli\Role();
        $admin_role = $role->where(['name' => 'admin'])->first();
        $dev_role = $role->where(['name' => 'dev'])->first();

        $wanber->attachRole($dev_role);
        $jhonatas->attachRole($dev_role);
        $admin->attachRole($admin_role);
    }
}
