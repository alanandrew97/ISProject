<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroAlumnoGrupo extends Model {
    protected $table = 'registro_alumno_grupo';

    protected $fillable = [
        'id_alumno_grupo',
        'id_tipo_curso',
        'faltas_totales',
        'calificacion_total',
        'desertor'
    ];

    public $timestamps = false;
}
