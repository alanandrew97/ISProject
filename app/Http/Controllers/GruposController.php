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
    // $escuela = Escuela::all()->first();
    if (session('rol')==1) {
      // $maestro = session('usuario');
      $grupos = session('usuario')->grupos;
    }

    // dd( $grupos[0]->alumnos );

    $submenuItems = [
      ['nombre'=>'Grupos','link'=>url('grupos'), 'selected'=>true],
      
    ];

    // dd($submenuItems);
    return view('escuela.index', array(
      'grupos' => $grupos,
      'submenuItems' => $submenuItems
    ));
  }

}