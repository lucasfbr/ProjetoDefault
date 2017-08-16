<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuemSomosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quemsomos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo_sobre');
            $table->text('texto_sobre');
            $table->string('imagem_sobre')->nullable();
            $table->string('titulo_missao');
            $table->text('texto_missao');
            $table->string('imagem_missao')->nullable();
            $table->enum('status', [0,1])->default(0);
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
        Schema::dropIfExists('quemsomos');
    }
}
