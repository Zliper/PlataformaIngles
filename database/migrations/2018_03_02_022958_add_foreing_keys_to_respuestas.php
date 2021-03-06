<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeysToRespuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('respuestas', function(Blueprint $table) {

            $table->integer('evaluacion_id')->unsigned()->after('id');
            $table->foreign('evaluacion_id')->references('id')->on('evaluaciones')->onDelete('cascade');

            $table->integer('reactivo_id')->unsigned()->after('evaluacion_id');
            $table->foreign('reactivo_id')->references('id')->on('reactivos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respuestas', function(Blueprint $table) {
            $table->dropForeign(['evaluacion_id']);
        });

        Schema::table('respuestas', function(Blueprint $table) {
            $table->dropForeign(['reactivo_id']);
        });
    }
}
