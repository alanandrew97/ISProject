<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model {
    protected $table = 'maestro';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_datos_usuario',
        'administrador'
    ];

    public $timestamps = false;
}
