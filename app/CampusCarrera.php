<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampusCarrera extends Model {
    protected $table = 'campus_carrera';

    protected $fillable = [
        'id_campus',
        'id_carrera'
    ];

    public $timestamps = false;
}
