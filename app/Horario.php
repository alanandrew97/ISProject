<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model {
    protected $table = 'horario';

    protected $primaryKey = 'id';

    protected $fillable = [
        'hora_inicio',
        'hora_fin'
    ];

    public $timestamps = false;
}
