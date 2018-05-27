<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model {
    protected $table = 'campus';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_escuela',
        'nombre',
        'direccion'
    ];

    public $timestamps = false;

    public function carreras()
    {
        return $this->belongsToMany('App\Carrera', 'campus_carrera', 'id_carrera', 'id_campus');
    }
}
