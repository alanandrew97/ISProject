<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroGrupoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('registro_grupo', function(Blueprint $table) {
            $table->integer('id_grupo');
            $table->integer('total_alumnos');
            $table->integer('aprobados');
            $table->integer('reprobados');
            $table->integer('desertores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('registro_grupo');
    }
}
