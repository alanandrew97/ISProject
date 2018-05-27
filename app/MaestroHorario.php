<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaestroHorario extends Model {
    protected $table = 'maestro_horario';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_semestre',
        'id_maestro',
        'version'
    ];

    public $timestamps = false;
}
