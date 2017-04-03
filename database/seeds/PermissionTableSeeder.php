<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('permissions')->get()->count() == 0){

            DB::table('permissions')->insert([

                [
                    'name' => 'view_artigo',
                    'label' => 'permite visualizar um artigo',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'edit_artigo',
                    'label' => 'permite editar um artigo',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'new_artigo',
                    'label' => 'permite criar um artigo',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'delete_artigo',
                    'label' => 'permite deletar um artigo',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'view_controle_acesso',
                    'label' => 'permite gerenciar o controle de acesso dos usuarios',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],

            ]);

        } else { echo "A tabela permission nao esta vazia, logo a seed nao pode ser executada "; }
    }
}
