<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('configuracoes')->get()->count() == 0){

            DB::table('configuracoes')->insert([

                'titulo'     => 'Titulo do site',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ]);

        }else{
            echo "A tabela configuracoes nao esta vazia, logo a seed nao pode ser executada ";
        }
    }
}
