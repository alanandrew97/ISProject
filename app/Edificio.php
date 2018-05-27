<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edificio extends Model {
    protected $table = 'edificio';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'clave'
    ];

    public $timestamps = false;
}
