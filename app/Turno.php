<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model {
    protected $table = 'turno';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;
}
