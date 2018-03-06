<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToEvaluacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluaciones', function(Blueprint $table) {

            $table->integer('materia_id')->unsigned()->after('id');
            $table->foreign('materia_id')->references('id')->on('materias');

            $table->integer('catalogo_id')->unsigned()->after('materia_id');
            $table->foreign('catalogo_id')->references('id')->on('catalogo_cuestionarios');

            $table->integer('alumno_id')->unsigned()->after('catalogo_id');
            $table->foreign('alumno_id')->references('matricula')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluaciones', function(Blueprint $table) {
            $table->dropForeign(['materia_id']);
        });

        Schema::table('evaluaciones', function(Blueprint $table) {
            $table->dropForeign(['catalogo_id']);
        });

        Schema::table('evaluaciones', function(Blueprint $table) {
            $table->dropForeign(['alumno_id']);
        });
        
    }
}
