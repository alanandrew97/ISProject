<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('alumno', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_datos_usuario');
            $table->integer('matricula');
            $table->integer('id_carrera');
            $table->integer('semestre');
            $table->integer('id_turno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('alumno');
    }
}
