<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 255);
            $table->text('descricao');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->timestamps();
        });

        Schema::create('projeto_user', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('projeto_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade');
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
        Schema::dropIfExists('projeto_user');
        Schema::dropIfExists('projetos');
    }
}
