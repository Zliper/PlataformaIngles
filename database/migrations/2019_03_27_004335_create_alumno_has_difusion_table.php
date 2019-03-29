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
            $table->integer('matricula')->unsigned();

            $table->integer('difusion_id')->unsigned();
            $table->foreign('difusion_id')->references('id')->on('difusiones')->onDelete('cascade');

            $table->string('guardadas')->default('0');
            $table->string('estatus');
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