<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('grupo', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_materia');
            $table->integer('id_maestro');
            $table->integer('clave');
            $table->integer('id_aula');
            $table->integer('id_semestre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('grupo');
    }
}
