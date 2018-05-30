<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumnoGrupo extends Model {
    protected $table = 'alumno_grupo';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_alumno',
        'id_grupo',
        'id_alumno_horario'
    ];

    public $timestamps = false;

    public function registroAlumnoGrupo() {
        return $this->hasOne('App\RegistroAlumnoGrupo', 'id_alumno_grupo');
    }
}
