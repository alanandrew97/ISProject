<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudCambioCalificacionMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('solicitud_cambio_calificacion', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_maestro');
            $table->boolean('aceptada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('solicitud_cambio_calificacion');
    }
}
