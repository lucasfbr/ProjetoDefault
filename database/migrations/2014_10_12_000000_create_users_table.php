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
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('profissao')->default('');
            $table->string('empresa')->default('');
            $table->string('password');
            $table->string('fone')->default('');
            $table->string('celular')->default('');
            $table->string('estado')->default('');
            $table->string('cidade')->default('');
            $table->string('educacao', 255)->default('');
            $table->string('habilidades', 255)->default('');
            $table->string('notas', 255)->default('');
            $table->integer('tipo')->default(2);//2 - cliente; 1 - editor; 0 - root
            $table->string('foto')->default('/images/homem.jpg');
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
