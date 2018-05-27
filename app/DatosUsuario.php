<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosUsuario extends Model {
    protected $table = 'datos_usuario';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'correo',
        'password',
        'nombre',
        'apellido_paterno',
        'apellido_materno'
    ];

    public $timestamps = false;
}
