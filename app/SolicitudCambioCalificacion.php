<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudCambioCalificacion extends Model {
    protected $table = 'solicitud_cambio_calificacion';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_maestro',
        'aceptada'
    ];

    public $timestamps = false;
}
