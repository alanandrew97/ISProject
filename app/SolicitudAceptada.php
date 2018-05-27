<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudAceptada extends Model {
    protected $table = 'solicitud_aceptada';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_solicitud',
        'fecha_inicial',
        'fecha_final',
        'realizado'
    ];

    public $timestamps = false;
}
