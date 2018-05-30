<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnoGrupoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('alumno_grupo', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_alumno');
            $table->integer('id_grupo');
            $table->integer('id_alumno_horario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('alumno_grupo');
    }
}
