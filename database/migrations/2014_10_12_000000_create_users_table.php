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
            $table->string('password');
            $table->integer('tipo')->default(2);//2 - cliente; 1 - editor; 0 - root
            $table->string('celular', 255)->nullable();
            $table->string('telefone', 255)->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('profissao', 255)->nullable();
            $table->string('estado', 255)->nullable();
            $table->string('cidade', 255)->nullable();
            $table->string('formacao', 255)->nullable();
            $table->string('habilidades', 255)->nullable();
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
