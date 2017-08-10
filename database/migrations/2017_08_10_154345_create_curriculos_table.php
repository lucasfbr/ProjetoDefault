<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empresa', 255);
            $table->string('cargo', 255);
            $table->date('data_entrada');
            $table->date('data_saida');
            $table->timestamps();
        });

        Schema::create('curriculo_user', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('curriculo_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('curriculo_id')->references('id')->on('curriculos')->onDelete('cascade');
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
        Schema::dropIfExists('curriculo_user');
        Schema::dropIfExists('curriculos');
    }
}
