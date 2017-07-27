<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MercadoPagoConfigSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(ParceirosSeeder::class);
        $this->call(ServicosSeeder::class);
        $this->call(PrestacaoServicoSeeder::class);
        $this->call(PacoteSeeder::class);
        $this->call(VendasSeeder::class);
        $this->call(PacoteSeeder::class);
        $this->call(PagamentoSeeder::class);
    }
}
