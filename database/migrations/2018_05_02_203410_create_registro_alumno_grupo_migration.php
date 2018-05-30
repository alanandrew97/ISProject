<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroAlumnoGrupoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('registro_alumno_grupo', function(Blueprint $table) {
            $table->integer('id_alumno_grupo');
            $table->integer('id_tipo_curso');
            $table->integer('faltas_totales');
            $table->double('calificacion_total');
            $table->boolean('desertor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('registro_alumno_grupo');
    }
}
