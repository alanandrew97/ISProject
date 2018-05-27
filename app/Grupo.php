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
}
