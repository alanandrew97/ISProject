<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReticulaMateria extends Model {
    protected $table = 'reticula_materia';
    
    protected $fillable = [
        'id_reticula',
        'id_materia',
        'semestre'
    ];

    protected $timestamps = false;
}
