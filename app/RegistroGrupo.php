<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroGrupo extends Model {
    protected $table = 'registro_grupo';

    protected $fillable = [
        'id_grupo',
        'reprobados',
        'desertores',
        'total_alumnos',
        'aprobados'
    ];

    public $timestamps = false;
}
