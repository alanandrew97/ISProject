<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model {
    protected $table = 'semestre';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha_inicial_parcial_1',
        'fecha_final_parcial_1',
        'fecha_inicial_parcial_2',
        'fecha_final_parcial_2',
        'fecha_inicial_parcial_3',
        'fecha_final_parcial_3',
        'fecha_inicial_promedio',
        'fecha_final_promedio'
    ];

    public $timestamps = false;
}
