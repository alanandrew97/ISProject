<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model {
    protected $table = 'aula';

    protected $primaryKey = 'id';

    protected $fillable = [
        'numero',
        'id_edificio'
    ];

    public $timestamps = false;
}
