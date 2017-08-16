<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->string('titulo');
            $table->text('conteudo');
            $table->string('imagem')->nullable();
            $table->timestamps();
            $table->dateTime('published_at');
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
