<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeyToComentario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comentarios', function(Blueprint $table) {
            $table->integer('reactivo_id')->unsigned()->after('id');
            $table->foreign('reactivo_id')->references('id')->on('reactivos');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comentarios', function(Blueprint $table) {
            $table->dropForeign(['reactivo_id']);
        });
    }
}
