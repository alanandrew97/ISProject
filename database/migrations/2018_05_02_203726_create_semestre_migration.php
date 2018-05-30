<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestreMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('semestre', function(Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_inicial_parcial_1');
            $table->date('fecha_final_parcial_1');
            $table->date('fecha_inicial_parcial_2');
            $table->date('fecha_final_parcial_2');
            $table->date('fecha_inicial_parcial_3');
            $table->date('fecha_final_parcial_3');
            $table->date('fecha_inicial_promedio');
            $table->date('fecha_final_promedio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('semestre');
    }
}
