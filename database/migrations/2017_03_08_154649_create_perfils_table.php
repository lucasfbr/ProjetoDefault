<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->increments('id');
            $table->text('resumo'); //breve descrição do usuário
            $table->longText('descricao'); //descrição completa do usuário
            $table->string('foto_perfil')->nullable(); //foto de corpo inteiro, será utlizada na página quem somos

            $table->string('fone')->nullable();
            $table->string('celular')->nullable();
            $table->string('cep')->nullable();
            $table->string('estado', 255)->nullable();
            $table->string('cidade', 255)->nullable();
            $table->string('bairro', 255)->nullable();
            $table->string('logradouro', 255)->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('profissao', 255)->nullable();
            $table->string('empresa', 255)->nullable();
            $table->string('sexo', 255)->nullable();


            $table->text('habilidades')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfils');
    }
}
