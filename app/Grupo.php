<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model {
    protected $table = 'grupo';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_materia',
        'id_maestro',
        'clave',
        'id_aula',
        'id_semestre'
    ];

    public $timestamps = false;

    public function materia(){
        return $this->hasOne('App\Materia', 'id', 'id_materia');
    }

    public function maestro() {
        return $this->hasOne('App\Maestro', 'id', 'id_maestro');
    }

    public function aula() {
        return $this->hasOne('App\Aula', 'id', 'id_aula');
    }

    public function semestre() {
        return $this->hasOne('App\Semestre', 'id', 'id_semestre');
    }

    public function alumnos(){
        return $this->belongsToMany('App\Alumno', 'alumno_grupo', 'id_grupo', 'id_alumno');
    }

    public function registro(){
        return $this->hasOne('App\RegistroGrupo', 'id_grupo', 'id');
    }

    public function alumnosGrupo() {
        return $this->hasMany('App\AlumnoGrupo', 'id_grupo');
    }
}
