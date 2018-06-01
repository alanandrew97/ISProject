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
    $grupos = session('usuario')->grupos;
    if (session('rol')==1) {
    } else {
      dd( session('usuario') );
    }

    dd($grupos);
  
    foreach ($grupos as $grupo) {
      $grupo['data'] = [$grupo->registro->aprobados, $grupo->registro->reprobados, $grupo->registro->desertores];
    }
    
    $submenuItems = [
      ['nombre'=>'Grupos','link'=>url('grupos'), 'selected'=>true],
    ];
    
    // dd( $grupos[0]['data'] );
    // dd($submenuItems);
    return view('grupos.index', array(
      'escuela' => $escuela,
      'grupos' => $grupos,
      'submenuItems' => $submenuItems
    ));
  }

  public function getDataGroup($id) {
    $data = [$grupo->registro->aprobados, $grupo->registro->reprobados, $grupo->registro->desertores];
  }

  public function imprimir(Request $request) {
    $escuela = Escuela::all()->first();
    $grupo = Grupo::find($request->input('id'));
    $alumnos = $grupo->alumnos;
    $maestro = $grupo->maestro;
    $materia = $grupo->materia;

    $view = view('pdf.listaAlumnos')->with('alumnos', $alumnos)->with('grupo', $grupo)->with('escuela', $escuela)->render();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view)->save('pdf/algo.pdf');
    $grupo = Grupo::find(1);
    return redirect('grupos');
  }

}