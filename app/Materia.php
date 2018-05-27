<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model {
    protected $table = 'materia';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'clave',
        'horas_teoria',
        'horas_practica',
        'creditos'
    ];

    public $timestamps = false;
}
