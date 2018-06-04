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
    $data = [];
    $labels = [];
    $escuela = Escuela::all()->first();
    if (session('rol')==1) {
      $grupos = session('usuario')->grupos;
      foreach ($grupos as $grupo) {
        if (isset($grupo->registro)){
          $grupo['data'] = [$grupo->registro->aprobados, $grupo->registro->reprobados, $grupo->registro->desertores];
          $grupo['labels'] = ["Aprobados", "Reprobados", "Desertores"];
          $grupo['materiaNombre'] = $grupo->materia->nombre;
          $grupo['maestroNombre'] = $grupo->maestro->nombre;
          $grupo['maestroApellido'] = $grupo->maestro->apellido_paterno;
        }
      }
      $submenuItems = [
        ['nombre'=>'Grupos','link'=>url('grupos'), 'selected'=>true],
        ['nombre'=>'Alumnos','link'=>url('grupos/alumnos'), 'selected'=>false],
      ];
    } else {
      $grupos = session('usuario')->gruposAlumno;
      foreach ($grupos as $i => $grupo) {
        foreach ($grupo->parciales as $parcial) {
          $data[$i][] = $parcial->calificacion;
          $labels[$i][] = 'U'.$parcial->numero;
        }
        $data[$i][] = $grupo->registroAlumnoGrupo->calificacion_total;
        $labels[$i][] = 'Total';
        $grupo['data'] = $data[$i];
        $grupo['labels'] = $labels[$i];
        $grupo['materiaNombre'] = $grupo->grupo->materia->nombre;
        $grupo['materiaNombre'] = $grupo->grupo->materia->nombre;
        $grupo['maestroApellido'] = $grupo->grupo->maestro->apellido_paterno;
      }
      $submenuItems = [
        ['nombre'=>'Grupos','link'=>url('grupos'), 'selected'=>true],
      ];
    }
    
    // dd($grupos[0]);
    return view('grupos.index', array(
      'escuela' => $escuela,
      'grupos' => $grupos,
      'submenuItems' => $submenuItems
    ));
  }

  public function getDataGroup($id) {
    $data = [$grupo->registro->aprobados, $grupo->registro->reprobados, $grupo->registro->desertores];
  }

  public function imprimir($id) {
    $escuela = Escuela::all()->first();
    $grupo = Grupo::find($id);
    $alumnos = $grupo->alumnos;
    $maestro = $grupo->maestro;
    $materia = $grupo->materia;

    $view = view('pdf.listaAlumnos')->with('alumnos', $alumnos)->with('grupo', $grupo)->with('escuela', $escuela)->render();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view)->save('pdf/reporte.pdf');
    dd($pdf);
    $grupo = Grupo::find(1);
    return response()->download($pathToFile)->deleteFileAfterSend(true);
  }

  public function vistaReporte() {
    $escuela = Escuela::all()->first();
    $grupo = Grupo::find(1);
    $alumnos = $grupo->alumnos;
    $maestro = $grupo->maestro;
    $materia = $grupo->materia;

    return view('pdf.listaAlumnos', array(
      'alumnos' => $alumnos,
      'grupo' => $grupo,
      'escuela' => $escuela,
    ));
  }

  public function alumnos(Request $request) {
    $data = [];
    $labels = [];
    $escuela = Escuela::all()->first();
    if (session('rol')==1) {
      if (session('usuario')->administrador == 1) {
        $grupos = Grupo::all();
      } else {
        $grupos = session('usuario')->grupos;
      }
    }

    $submenuItems = [
      ['nombre'=>'Grupos','link'=>url('grupos'), 'selected'=>false],
      ['nombre'=>'Alumnos','link'=>url('grupos/alumnos'), 'selected'=>true],
    ];

    // $grupos = session('usuario')->gruposAlumno;
    foreach ($grupos as $grupo) {
      foreach ($grupo->alumnosGrupo as $i => $alumnoGrupo) {
        foreach ($alumnoGrupo->parciales as $parcial) {
          $data[$i][] = $parcial->calificacion;
          $labels[$i][] = 'U'.$parcial->numero;
        }
        if ( isset($alumnoGrupo->registroAlumnoGrupo) ) {
          $data[$i][] = $alumnoGrupo->registroAlumnoGrupo->calificacion_total;
          $labels[$i][] = 'Total';
          $alumnoGrupo['data'] = $data[$i];
          $alumnoGrupo['labels'] = $labels[$i];
          $alumnoGrupo['materiaNombre'] = $alumnoGrupo->grupo->materia->nombre;
          $alumnoGrupo['maestroNombre'] = $alumnoGrupo->grupo->maestro->nombre;
          $alumnoGrupo['maestroApellido'] = $alumnoGrupo->grupo->maestro->apellido_paterno;
        }
        
      }
      // dd($alumnoGrupo[]);
    }

    // dd($grupos[0]);
    return view('grupos.alumnos', array(
      'escuela' => $escuela,
      'grupos' => $grupos,
      'submenuItems' => $submenuItems
    ));
  }

  function check_in_range($fecha_inicio, $fecha_fin, $fecha){
    $fecha_inicio = strtotime($fecha_inicio);
    $fecha_fin = strtotime($fecha_fin);
    $fecha = strtotime($fecha);

    if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
      return true;
    } else {
      return false;
    }
  }

}