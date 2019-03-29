<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDifusionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('difusiones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profesor_id');
            $table->integer('duracion');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_aplicacion')->nullable();
            $table->timestamp('fecha_limite')->nullable();
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
        Schema::dropIfExists('difusiones');
    }
}
