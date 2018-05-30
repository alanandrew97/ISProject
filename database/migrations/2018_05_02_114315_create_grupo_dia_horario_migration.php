<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoDiaHorarioMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('grupo_dia_horario', function(Blueprint $table) {
            $table->integer('id_grupo');
            $table->integer('id_dia');
            $table->integer('id_horario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('grupo_dia_horario');
    }
}
