<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosUsuarioMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('datos_usuario', function(Blueprint $table) {
            $table->increments('id');
            $table->string('correo');
            $table->string('password');
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('datos_usuario');
    }
}
