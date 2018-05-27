<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCurso extends Model {
    protected $table = 'tipo_curso';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'abreviatura'
    ];

    public $timestamps = false;
}
