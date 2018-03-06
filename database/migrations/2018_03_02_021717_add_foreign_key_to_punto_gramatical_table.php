<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToPuntoGramaticalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puntos_gramaticales', function(Blueprint $table) {
            $table->integer('materia_id')->unsigned();
            $table->foreign('materia_id')->references('id')->on('materias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puntos_gramaticales', function(Blueprint $table) {
            $table->dropForeign(['materia_id']);
        });
    }
}
