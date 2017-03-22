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
         //this->call(UsersTableSeeder::class);

        //gerar 10 usuarios aleatorios
        //factory('App\User', 10)->create();

        //gerar o usuario administrador
        factory('App\User')->create();
    }
}
