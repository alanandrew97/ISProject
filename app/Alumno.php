<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model {
    protected $table = 'alumno';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_datos_usuario',
        'matricula',
        'id_carrera',
        'semestre',
        'id_turno'
    ];

    public $timestamps = false;

    public function datosUsuario() {
        return $this->hasOne('App\DatosUsuario', 'id', 'id_datos_usuario');
    }

    public function carrera() {
        return $this->hasOne('App\Carrea', 'id', 'id_carrera');
    }
}
