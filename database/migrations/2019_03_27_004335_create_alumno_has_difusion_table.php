<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnoHasDifusionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_has_difusion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('matricula')->unsigned();

            $table->integer('difusion_id')->unsigned();
            $table->foreign('difusion_id')->references('id')->on('difusiones')->onDelete('cascade');

            $table->integer('readingGuardadas')->default('0');
            $table->integer('listeningGuardadas')->default('0');
            $table->integer('writingingGuardadas')->default('0');

            $table->integer('readingCorrectas')->default('0');
            $table->integer('listeningCorrectas')->default('0');
            $table->integer('writingingCorrectas')->default('0');

            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_has_difusion');
    }
}