<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumnoHorario extends Model {
    protected $table = 'alumno_horario';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_semestre',
        'version'
    ];

    public $timestamps = false;
}
