<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model {
    protected $table = 'escuela';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'ruta_imagen'
    ];

    public $timestamps = false;

    public function campus()
    {
        return $this->hasMany('App\Campus', 'id_escuela');
    }
}
