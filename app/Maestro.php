<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model {
    protected $table = 'maestro';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_datos_usuario',
        'administrador'
    ];

    public $timestamps = false;

    public function datosUsuario() {
        return $this->hasOne('App\DatosUsuario', 'id', 'id_datos_usuario');
    }

    public function grupos() {
        return $this->hasMany('App\Grupo', 'id_maestro');
    }
}
