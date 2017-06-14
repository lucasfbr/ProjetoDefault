<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('users')->get()->count() == 0){

            $user = DB::table('users')->insertGetId([
                    'name' => 'Lucas Rosa',
                    'email' => 'lucas-fbr@hotmail.com',
                    'password' => bcrypt('123456'),
                    'tipo' => '0',
                    'usuarioPrincipal' => '1',
                    'remember_token' => str_random(10),
                    ]);

            DB::table('role_user')->insert(['role_id'=>'1', 'user_id'=>$user]);

        }else{
            echo "A tabela Users nao esta vazia, logo a seed nao pode ser executada ";
        }
    }
}
