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
        return $this->hasOne('App\Carrera', 'id', 'id_carrera');
    }

    public function turno() {
        return $this->hasOne('App\Turno', 'id', 'id_turno');
    }

    public function grupos(){
        return $this->belongsToMany('App\Grupo', 'alumno_grupo', 'id_alumno', 'id_grupo');
    }

    public function alumnosGrupo() {
        return $this->hasMany('App\AlumnoGrupo', 'id_grupo');
    }
}
