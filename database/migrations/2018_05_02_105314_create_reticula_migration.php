<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReticulaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reticula', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_carrera');
            $table->integer('numero')->nullable();
            $table->integer('numero_semestres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('reticula');
    }
}
