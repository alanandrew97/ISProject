<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarreraMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('carrera', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('ruta_imagen')->nullable();
            $table->string('abreviatura');
            $table->integer('total_creditos');
            $table->integer('estructura_generica_creditos');
            $table->integer('residencia_profesional_creditos');
            $table->integer('servicio_social_creditos');
            $table->integer('actividades_complementarias_creditos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('carrera');
    }
}
