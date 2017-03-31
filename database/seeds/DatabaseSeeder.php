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
        //gerar 10 usuarios aleatorios
        //factory('App\User', 10)->create();

        //gerar o usuario administrador
        factory('App\User')->create();

        //cria os principais grupos do sistema
        $this->call(RolesTableSeeder::class);
        //cria as pricipais permissões do sistema
        $this->call(PermissionTableSeeder::class);
    }
}
