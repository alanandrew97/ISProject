<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model {
    protected $table = 'carrera';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'ruta_imagen',
        'abreviatura',
        'total_creditos',
        'estructura_generica_creditos',
        'residencia_profesional_creditos',
        'servicio_social_creditos',
        'actividades_complementarias_creditos'
    ];

    public $timestamps = false;

    public function reticulas()
    {
        return $this->hasMany('App\Reticula', 'id_carrera');
    }
}
