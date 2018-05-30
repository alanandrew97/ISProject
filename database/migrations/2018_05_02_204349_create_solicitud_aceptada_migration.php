<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudAceptadaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('solicitud_aceptada', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_solicitud');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->boolean('realizado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('solicitud_aceptada');
    }
}
