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
            
            $table->integer('profesor_id')->unsigned()->after('id');
            $table->foreign('profesor_id')->references('id')->on('profesores')->onDelete('cascade');

            $table->integer('materia_id')->unsigned()->after('profesor_id');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');

            $table->integer('catalogo_id')->unsigned()->after('materia_id');
            $table->foreign('catalogo_id')->references('id')->on('catalogo_cuestionarios')->onDelete('cascade');

            $table->integer('alumno_id')->unsigned()->after('catalogo_id');
            $table->foreign('alumno_id')->references('matricula')->on('alumnos')->onDelete('cascade');

            $table->integer('punto_gramatical')->unsigned()->after('alumno_id');
            $table->foreign('punto_gramatical')->references('id')->on('puntos_gramaticales')->onDelete('cascade');
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
            $table->dropForeign(['profesor_id']);
        });
        
        Schema::table('evaluaciones', function(Blueprint $table) {
            $table->dropForeign(['materia_id']);
        });

        Schema::table('evaluaciones', function(Blueprint $table) {
            $table->dropForeign(['catalogo_id']);
        });

        Schema::table('evaluaciones', function(Blueprint $table) {
            $table->dropForeign(['alumno_id']);
        });

        Schema::table('evaluaciones', function(Blueprint $table) {
            $table->dropForeign(['punto_gramatical']);
        });
        
    }
}
