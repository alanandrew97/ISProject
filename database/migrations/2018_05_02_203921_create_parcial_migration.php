<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcialMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('parcial', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_alumno_grupo');
            $table->integer('numero');
            $table->integer('faltas');
            $table->double('calificacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('parcial');
    }
}
