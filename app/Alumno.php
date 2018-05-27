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
}
