<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToReactivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reactivos', function(Blueprint $table) {

            $table->integer('competencia_id')->unsigned()->after('id');
            $table->foreign('competencia_id')->references('id')->on('competencias')->onDelete('cascade');

            $table->integer('tipo_id')->unsigned()->after('competencia_id');
            $table->foreign('tipo_id')->references('id')->on('tipo_reactivos')->onDelete('cascade');

            $table->integer('estatus_id')->unsigned()->after('tipo_id');
            $table->foreign('estatus_id')->references('id')->on('estatus')->onDelete('cascade');

            $table->integer('profesor_id')->unsigned()->after('estatus_id');
            $table->foreign('profesor_id')->references('id')->on('profesores')->onDelete('cascade');

            $table->integer('text_id')->nullable()->unsigned()->after('profesor_id');
            $table->foreign('text_id')->references('id')->on('text')->onDelete('cascade');

            $table->integer('punto_id')->unsigned()->after('text_id');
            $table->foreign('punto_id')->references('id')->on('puntos_gramaticales')->onDelete('cascade');

            $table->integer('catalogo_id')->unsigned()->after('punto_id');
            $table->foreign('catalogo_id')->references('id')->on('catalogo_cuestionarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reactivos', function(Blueprint $table) {
            $table->dropForeign(['competencia_id']);
        });

        Schema::table('reactivos', function(Blueprint $table) {
            $table->dropForeign(['tipo_id']);
        });

        Schema::table('reactivos', function(Blueprint $table) {
            $table->dropForeign(['estatus_id']);
        });

        Schema::table('reactivos', function(Blueprint $table) {
            $table->dropForeign(['profesor_id']);
        });

        Schema::table('reactivos', function(Blueprint $table) {
            $table->dropForeign(['text_id']);
        });

        Schema::table('reactivos', function(Blueprint $table) {
            $table->dropForeign(['punto_id']);
        });
    }
}
