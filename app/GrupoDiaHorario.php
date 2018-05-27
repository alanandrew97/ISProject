<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoDiaHorario extends Model {
    protected $table = 'grupo_dia_horario';

    protected $fillable = [
        'id_grupo',
        'id_dia',
        'id_horario'
    ];

    public $timestamps = false;
}
