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
                    'name' => 'editor',
                    'label' => 'editor',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'controle de acesso',
                    'label' => 'Gestor das permissões de acesso ',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'configuracoes basicas',
                    'label' => 'Permite acesso ao paínel de configuraçõe siniciais do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'usuarios',
                    'label' => 'Permite acesso a todas informações dos consultores e clientes',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'configuracoes portal',
                    'label' => 'Permite acesso as páginas responsaveis por alimentar o portal com conteúdo como serviços, portifólio, quem somos  ',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],

            ]);

        } else { echo "A tabela roles nao esta vazia, logo a seed nao pode ser executada "; }

    }
}
