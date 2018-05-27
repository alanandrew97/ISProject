<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\FileUtils;
use App\Materia;
// use App\Carrera;

class MateriaController extends Controller {
    

  public function index() {
    $materias = Materia::all();

    return view('materia.index', array(
      'materias' => $materias
    ));
  }
}
