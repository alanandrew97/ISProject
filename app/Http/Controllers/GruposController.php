<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DatosUsuario;
use App\Maestro;
use App\Alumno;
use App\Escuela;
use App\Carrera;
use App\Grupo;

class GruposController extends Controller {

  public function index() {
    $escuela = Escuela::all()->first();
    dd( session('usuario') );
    $submenuItems = [
      ['nombre'=>'Grupos','link'=>url('grupos'), 'selected'=>true],
      
    ];

    // dd($submenuItems);
    return view('escuela.index', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems
    ));
  }

}