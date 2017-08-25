<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienciasProfissionaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experienciasprofissionais', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('perfil_id')->unsigned()->nullable();
            $table->string('empresa', 255);
            $table->string('cargo', 255);
            $table->date('data_entrada');
            $table->date('data_saida');
            $table->timestamps();

            $table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experienciasprofissionais');
    }
}
