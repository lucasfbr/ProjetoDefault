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
            $table->enum('sexo', ['m', 'f']);
            $table->string('foto', 255)->nullable();
            $table->text('formacao')->nullable();
            $table->text('habiliadades')->nullable();
            $table->text('notas')->nullable();
            $table->enum('tipo', [0,1,2])->default(2);//0 - root; 1 - consultor; 2 - cliente
            $table->enum('status', [0,1])->default(0);//0 - inativo; 1 - ativo

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
