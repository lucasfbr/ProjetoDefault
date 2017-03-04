<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tituloSite');
            $table->text('googlemaps');
            $table->string('nome_rodape');
            $table->string('endereco_rodape');
            $table->string('telefone_rodape');
            $table->string('facebook');
            $table->string('youtube');
            $table->string('skype');
            $table->string('twitter');
            $table->string('linkedin');
            $table->string('google');
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
        Schema::dropIfExists('configuracoes');
    }
}
