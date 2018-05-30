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

    public function edificio() {
        return $this->hasOne('App\Edificio', 'id', 'id_edificio');
    }
}
