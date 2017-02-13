<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * up users
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fone')->nullable();
            $table->string('celular')->nullable();
            $table->string('estado', 255)->nullable();
            $table->string('cidade', 255)->nullable();
            $table->string('profissao', 255)->nullable();
            $table->string('empresa', 255)->nullable();
            $table->string('sexo', 255)->nullable();
            $table->string('foto', 255)->nullable();
            $table->text('formacao')->nullable();
            $table->text('habilidades')->nullable();
            $table->text('notas')->nullable();
            $table->enum('tipo', [0,1,2]);//0 - root; 1 - consultor; 2 - cliente
            $table->enum('status', [0,1])->default(0);//0 - inativo; 1 - ativo
            $table->enum('termos', [0,1])->default(0);//0 - nao aceito; 1 - aceito
            $table->enum('perfil', [0,1])->default(0);//0 - incompleto; 1 - completo

            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
