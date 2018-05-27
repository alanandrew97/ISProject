<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model {
    protected $table = 'dia';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;
}
