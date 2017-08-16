<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('roles')->get()->count() == 0){

            DB::table('roles')->insert([

                [
                    'name' => 'adm',
                    'label' => 'administrador do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'consultor',
                    'label' => 'consultor do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'cliente',
                    'label' => 'Cliente do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],

            ]);

        } else { echo "A tabela roles nao esta vazia, logo a seed nao pode ser executada "; }

    }
}
