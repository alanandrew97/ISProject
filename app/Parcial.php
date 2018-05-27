<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcial extends Model {
    protected $table = 'parcial';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_alumno_grupo',
        'numero',
        'faltas',
        'calificacion'
    ];

    public $timestamps = false;
}
