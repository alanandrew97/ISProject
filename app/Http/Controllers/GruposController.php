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
    if (session('rol')==1) {
      $grupos = session('usuario')->grupos;
      foreach ($grupos as $grupo) {
        $grupo['data'] = [$grupo->registro->aprobados, $grupo->registro->reprobados, $grupo->registro->desertores];
        $grupo['labels'] = ["Aprobados", "Reprobados", "Desertores"];
      }
      $submenuItems = [
        ['nombre'=>'Grupos','link'=>url('grupos'), 'selected'=>true],
        ['nombre'=>'Alumnos','link'=>url('grupos'), 'selected'=>true],
      ];
    } else {
      $grupos = session('usuario')->gruposAlumno;
      foreach ($grupos as $grupo) {
        foreach ($grupo->parciales as $parcial) {
          array_push($grupo['data'], $parcial->calificacion);
          array_push($grupo['labels'], 'U'.$parcial->numero);
        }
        array_push($grupo['data'], $grupo->registroAlumnoGrupo->calificacionTotal);
        array_push($grupo['labels'], 'Total');
      }
      $submenuItems = [
        ['nombre'=>'Grupos','link'=>url('grupos'), 'selected'=>true],
      ];
      dd( $grupo['data'] );
    }
    
    
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