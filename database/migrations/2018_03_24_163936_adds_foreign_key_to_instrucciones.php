<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddsForeignKeyToInstrucciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instrucciones', function(Blueprint $table) {
            $table->integer('tipo_reactivo_id')->unsigned()->after('id');
            $table->foreign('tipo_reactivo_id')->references('id')->on('tipo_reactivos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instrucciones', function(Blueprint $table) {
            $table->dropForeign(['tipo_reactivo_id']);
        });
    }
}
