<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\FileUtils;
use App\Escuela;
use App\Carrera;
use App\Campus;
use App\Reticula;
use App\Materia;
use App\Edificio;
use App\Aula;
use App\Horario;
use App\Semestre;
use App\Grupo;
use App\Maestro;
use App\Alumno;
use App\AlumnoGrupo;
use App\CampusCarrera;
use App\DatosUsuario;
use App\Parcial;
use App\RegistroAlumnoGrupo;
use App\RegistroGrupo;

class EscuelaController extends Controller {

  public function registrar(Request $request) {
    $this->validate($request, [
      'imagen' => 'required',
      'nombre' => 'required'
    ]);

    $ruta_imagen = null;

    $nombre = $request->input('nombre');

    $ruta_imagen = FileUtils::guardar($request->file('imagen'), 'storage/escuela/', 'img_');

    Escuela::create([
      'nombre' => $nombre,
      'ruta_imagen' => $ruta_imagen
    ]);

    return redirect('/');
  }

  public function index() {
    $escuela = Escuela::all()->first();
    $campuses = Campus::all();
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>true],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false]
    ];

    //dd($escuela);
    return view('campus.index', array(
      'escuela' => $escuela,
      'campuses' => $campuses,
      'submenuItems' => $submenuItems
    ));
  }

  public function eliminarCampus(Request $request) {
    $campus = Campus::find($request->campus_id);
    $campus->delete();
    return redirect('escuela');
  }
  
  public function crearCampus(Request $request){
    
    $this->validate($request, [
      'nombre' => 'required',
      'direccion' => 'required'
    ]);

    $escuela = Escuela::all()->first();

    $campus = Campus::create([
      'nombre' => $request->nombre,
      'direccion' => $request->direccion,
      'id_escuela' => $escuela->id
    ]);
        
    return redirect('/escuela');
  }

  public function editarCampus(Request $request){
    $this->validate($request, [
      'nombre' => 'required',
      'direccion' => 'required'
    ]);

    $campus = Campus::find($request->campusId);

    $campus->nombre = $request->nombre;
    $campus->direccion = $request->direccion;

    $campus->save();
    return redirect('/escuela');    
  }

  public function listaCarreras(){
    $carreras = Carrera::all();
    $campuses = Campus::all();
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>true],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false]
    ];
    
    // dd($carrera);
    
    return view('carreras.index', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems,
      'carreras' => $carreras,
      'campuses' => $campuses
    ));
  }

  public function crearCarrera(Request $request){
    $this->validate($request, [
      'nombre' => 'required',
      'abreviatura' => 'required',
      'totalCreditos' => 'required',
      'estructuraGenericaCreditos' => 'required',
      'residenciaProfesionalCreditos' => 'required',
      'servicioSocialCreditos' => 'required',
      'actividadesComplementariasCreditos' => 'required',
      'imagenCarrera' => 'required'
    ]);

    $campuses = $request->input('campuses');
    $rutaImagen = FileUtils::guardar($request->imagenCarrera, 'storage/carreras/', 'car_');

    $carrera = Carrera::create([
      'nombre' => $request->nombre,
      'abreviatura' => $request->abreviatura,
      'total_creditos' => $request->totalCreditos,
      'estructura_generica_creditos' => $request->estructuraGenericaCreditos,
      'residencia_profesional_creditos' => $request->residenciaProfesionalCreditos,
      'servicio_social_creditos' => $request->servicioSocialCreditos,
      'actividades_complementarias_creditos' => $request->actividadesComplementariasCreditos,
      'ruta_imagen' => $rutaImagen
    ]);

    if(!is_null($campuses)) {
      foreach($campuses as $campus) {
        $carrera->campus()->attach($campus);
      }
    }
        
    return redirect('/escuela/carreras');
  }

  public function editarCarrera(Request $request){
    $this->validate($request, [
      'nombre' => 'required',
      'abreviatura' => 'required',
      'totalCreditos' => 'required',
      'estructuraGenericaCreditos' => 'required',
      'residenciaProfesionalCreditos' => 'required',
      'servicioSocialCreditos' => 'required',
      'actividadesComplementariasCreditos' => 'required',
    ]);

    $carrera = Carrera::find($request->carreraId);
    $campuses = $request->input('campuses');
    
    $carrera->nombre = $request->nombre;
    $carrera->abreviatura = $request->abreviatura;
    $carrera->total_creditos = $request->totalCreditos;
    $carrera->estructura_generica_creditos = $request->estructuraGenericaCreditos;
    $carrera->residencia_profesional_creditos = $request->residenciaProfesionalCreditos;
    $carrera->servicio_social_creditos = $request->servicioSocialCreditos;
    $carrera->actividades_complementarias_creditos = $request->actividadesComplementariasCreditos;
    $carrera->campus()->detach();

    if(!is_null($campuses)) {
      foreach($campuses as $campus) {
        $carrera->campus()->attach($campus);
      }
    }
    
    if ( isset($request->ruta_imagen) ) {
      //Borrar imagen anterior
      FileUtils::eliminar($carrera->ruta_imagen);
      $rutaImagen = FileUtils::guardar($request->ruta_imagen, 'storage/carreras/', 'car_');
      $carrera->ruta_imagen = $rutaImagen;
    }

    $carrera->save();
    
    return redirect('/escuela/carreras');
  }

  public function eliminarCarrera(Request $request){
    $carrera = Carrera::find($request->carrera_id);
    // dd($carrera->ruta_imagen);
    FileUtils::eliminar($carrera->ruta_imagen);
    $carrera->delete();
    return redirect('/escuela/carreras');

  }
  
  public function listaReticulas(){
    $escuela = Escuela::all()->first();
    $carreras = Carrera::all();
    $materias = Materia::all();
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false]
    ];
    
    // dd($carrera);
    
    return view('escuela.listaReticulas', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems,
      'carreras' => $carreras,
      'materias' => $materias,
      // 'reticulas' => $reticulas
    ));
  }

  public function listaTurnos() {
    $turnos = Turno::all();
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Escuela','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>true],
      ['nombre'=>'Retículas','link'=>url('escuela/reticulas'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false]
    ];
    
    return view('escuela.turnos', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems,
      'turnos' => $turnos
    ));
  }

  public function listaEdificios(Request $request) {
    $edificios = Edificio::all();
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>true],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false]
    ];

    return view('escuela.listaEdificios', array(
      'edificios' => $edificios,
      'escuela' => $escuela,
      'submenuItems' => $submenuItems
    ));
  }

  public function registrarEdificio(Request $request) {
    $this->validate($request, [
      'nombre' => 'required',
      'clave' => 'required'
    ]);

    Edificio::create([
      'nombre' => $request->input('nombre'),
      'clave' => $request->input('clave')
    ]);

    return redirect('escuela/edificios');
  }

  public function editarEdificio(Request $request) {
    $this->validate($request, [
      'nombre' => 'required',
      'clave' => 'required'
    ]);

    $edificio = Edificio::find($request->input('id'));

    $edificio->nombre = $request->input('nombre');
    $edificio->clave = $request->input('clave');
    $edificio->save();

    return redirect('escuela/edificios');
  }

  public function eliminarEdificio(Request $request) {
    $edificio = Edificio::find($request->input('id'));
    $edificio->delete();

    return redirect('escuela/edificios');
  }

  public function listaAulas(Request $request) {
    $edificios = Edificio::all();
    $aulas = Aula::all();
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>true],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false]
    ];

    return view('escuela.listaAulas', array(
      'edificios' => $edificios,
      'aulas' => $aulas,
      'escuela' => $escuela,
      'submenuItems' => $submenuItems
    ));
  }

  public function registrarAula(Request $request) {
    $this->validate($request, [
      'numero' => 'required',
      'id_edificio' => 'required'
    ]);

    Aula::create([
      'numero' => $request->input('numero'),
      'id_edificio' => $request->input('id_edificio')
    ]);

    return redirect('escuela/aulas');
  }

  public function editarAula(Request $request) {
    $this->validate($request, [
      'numero' => 'required',
      'id_edificio' => 'required'
    ]);

    $aula = Aula::find($request->input('id'));

    $aula->numero = $request->input('numero');
    $aula->id_edificio = $request->input('id_edificio');
    $aula->save();

    return redirect('escuela/aulas');
  }

  public function eliminarAula(Request $request) {
    $aula = Aula::find($request->input('id'));
    $aula->delete();

    return redirect('escuela/aulas');
  }

  public function listaHorarios(Request $request) {
    $horarios = Horario::all();
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>true],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false]
    ];

    return view('escuela.listaHorarios', array(
      'horarios' => $horarios,
      'escuela' => $escuela,
      'submenuItems' => $submenuItems
    )); 
  }

  public function registrarHorario(Request $request) {
    $this->validate($request, [
      'hora_inicio' => 'required',
      'hora_fin' => 'required'
    ]);

    Horario::create([
      'hora_inicio' => $request->input('hora_inicio'),
      'hora_fin' => $request->input('hora_fin')
    ]);

    return redirect('escuela/horarios');
  }
  
  public function editarHorario(Request $request) {
    $this->validate($request, [
      'hora_inicio' => 'required',
      'hora_fin' => 'required'
    ]);

    $horario = Horario::find($request->input('id'));

    $horario->hora_inicio = $request->input('hora_inicio');
    $horario->hora_fin = $request->input('hora_fin');
    $horario->save();

    return redirect('escuela/horarios');
  }

  
  public function eliminarHorario(Request $request) {
    $horario = Horario::find($request->input('id'));
    $horario->delete();

    return redirect('escuela/horarios');
  }

  public function listaSemestres(Request $request) {
    $semestres = Semestre::all();
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>true],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false]
    ];

    return view('semestres.index', array(
      'semestres' => $semestres,
      'escuela' => $escuela,
      'submenuItems' => $submenuItems
    )); 
  }

  public function registrarSemestre(Request $request) {
    $this->validate($request, [
      'fecha_inicial_parcial_1' => 'required',
      'fecha_final_parcial_1' => 'required',
      'fecha_inicial_parcial_2' => 'required',
      'fecha_final_parcial_2' => 'required',
      'fecha_inicial_parcial_3' => 'required',
      'fecha_final_parcial_3' => 'required',
      'fecha_inicial_promedio' => 'required',
      'fecha_final_promedio' => 'required'
    ]);

    Semestre::create([
      'fecha_inicial_parcial_1' => $request->input('fecha_inicial_parcial_1'),
      'fecha_final_parcial_1' => $request->input('fecha_final_parcial_1'),
      'fecha_inicial_parcial_2' => $request->input('fecha_inicial_parcial_2'),
      'fecha_final_parcial_2' => $request->input('fecha_final_parcial_2'),
      'fecha_inicial_parcial_3' => $request->input('fecha_inicial_parcial_3'),
      'fecha_final_parcial_3' => $request->input('fecha_final_parcial_3'),
      'fecha_inicial_promedio' => $request->input('fecha_inicial_promedio'),
      'fecha_final_promedio' => $request->input('fecha_final_promedio')
    ]);

    return redirect('escuela/semestres');
  }

  public function editarSemestre(Request $request) {
    $this->validate($request, [
      'fecha_inicial_parcial_1' => 'required',
      'fecha_final_parcial_1' => 'required',
      'fecha_inicial_parcial_2' => 'required',
      'fecha_final_parcial_2' => 'required',
      'fecha_inicial_parcial_3' => 'required',
      'fecha_final_parcial_3' => 'required',
      'fecha_inicial_promedio' => 'required',
      'fecha_final_promedio' => 'required'
    ]);

    $semestre = Semestre::find($request->input('id'));

    $semestre->fecha_inicial_parcial_1 = $request->input('fecha_inicial_parcial_1');
    $semestre->fecha_final_parcial_1 = $request->input('fecha_final_parcial_1');
    $semestre->fecha_inicial_parcial_2 = $request->input('fecha_inicial_parcial_2');
    $semestre->fecha_final_parcial_2 = $request->input('fecha_final_parcial_2');
    $semestre->fecha_inicial_parcial_3 = $request->input('fecha_inicial_parcial_3');
    $semestre->fecha_final_parcial_3 = $request->input('fecha_final_parcial_3');
    $semestre->fecha_inicial_promedio = $request->input('fecha_inicial_promedio');
    $semestre->fecha_final_promedio = $request->input('fecha_final_promedio');
    $semestre->save();
    
    return redirect('escuela/semestres');
  }

  public function eliminarSemestre(Request $request) {
    $semestre = Semestre::find($request->input('id'));
    $semestre->delete();

    return redirect('escuela/semestres');
  }

  public function listaMaterias(Request $request) {
    $materias = Materia::all();
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>true],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false]
    ];
      
    return view('materias.index', array(
        'materias' => $materias,
        'escuela' => $escuela,
        'submenuItems' => $submenuItems,
    ));
  }
    public function listaGrupos(Request $request) {
      // $horarios = Horario::all();
      $grupos = Grupo::all();
      $materias = Materia::all();
      $maestros = Maestro::all();
      $aulas = Aula::all();
      $semestres = Semestre::all();
      $escuela = Escuela::all()->first();
      $alumnos = Alumno::all();
      $submenuItems = [
        ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>false],
        ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>false],
        ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
        ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
        ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>true],
        ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
        ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false]
      ];

      foreach ($grupos as $grupo) {
        if (isset($grupo->registro)){
          $grupo['data'] = [$grupo->registro->aprobados, $grupo->registro->reprobados, $grupo->registro->desertores];
          $grupo['labels'] = ["Aprobados", "Reprobados", "Desertores"];
        }
      }

    return view('todosLosGrupos.index', array(
      'grupos' => $grupos,
      'materias' => $materias,
      'maestros' => $maestros,
      'aulas' => $aulas,
      'semestres' => $semestres,
      'escuela' => $escuela,
      'alumnos' => $alumnos,
      'submenuItems' => $submenuItems
    )); 
  }

  public function registrarGrupo(Request $request) {
    /*$this->validate($request, [
      'clave' => 'required',
      'id_ materia' => 'required',
      'id_maestro' => 'required',
      'id_aula' => 'required',
      'id_semestre' => 'required'
    ]);*/

    Grupo::create([
      'clave' => $request->input('clave'),
      'id_materia' => $request->input('id_materia'),
      'id_maestro' => $request->input('id_maestro'),
      'id_aula' => $request->input('id_aula'),
      'id_semestre' => $request->input('id_semestre')
    ]);

    return redirect('escuela/grupos');
  }

  public function eliminarGrupo(Request $request) {
    $grupo = Grupo::find($request->input('id'));
    $grupo->delete();

    return redirect('escuela/grupos');
  }

  public function editarGrupo(Request $request) {
    $grupo = Grupo::find($request->input('id'));

    $grupo->clave = $request->input('clave');
    $grupo->id_materia = $request->input('id_materia');
    $grupo->id_maestro = $request->input('id_maestro');
    $grupo->id_aula = $request->input('id_aula');
    $grupo->id_semestre = $request->input('id_semestre');
    $grupo->save();

    return redirect('escuela/grupos');
  }

  public function registrarMateria(Request $request) {
    $this->validate($request, [
      'nombre' => 'required',
      'clave' => 'required',
      'creditos' => 'required',
      'horas_teoria' => 'required',
      'horas_practica' => 'required'
    ]);

    Materia::create([
      'nombre' => $request->input('nombre'),
      'clave' => $request->input('clave'),
      'creditos' => $request->input('creditos'),
      'horas_teoria' => $request->input('horas_teoria'),
      'horas_practica' => $request->input('horas_practica')
    ]);

    return redirect('escuela/materias');
  }

  public function editarMateria(Request $request) {
    $this->validate($request, [
      'nombre' => 'required',
      'clave' => 'required',
      'creditos' => 'required',
      'horas_teoria' => 'required',
      'horas_practica' => 'required'
    ]);
    
    $materia = Materia::find($request->input('id'));

    $materia->nombre = $request->input('nombre');
    $materia->clave = $request->input('clave');
    $materia->creditos = $request->input('creditos');
    $materia->horas_teoria = $request->input('horas_teoria');
    $materia->horas_practica = $request->input('horas_practica');
    $materia->save();

    return redirect('escuela/materias');
  }

  public function eliminarMateria(Request $request) {
    $materia = Materia::find($request->input('id'));
    $materia->delete();

    return redirect('escuela/materias');
  }

  public function registrarAlumnosGrupo(Request $request) {
    $grupo = Grupo::find($request->input('id'));

    $grupo->alumnos()->detach();

    if(!is_null($request->input('alumnos'))) {
      foreach($request->input('alumnos') as $id_alumno) {
        $grupo->alumnos()->attach($id_alumno);
      }
    }

    return redirect('escuela/grupos');
  }


  public function buscarCampus(Request $request) {
    $query = $request->input('query');
    $campuses = Campus::where('nombre', 'like', "%$query%")->get();
    return view('campus.lista')->with('campuses', $campuses);
  }

  public function buscarCarrera(Request $request) {
    $query = $request->input('query');
    $carreras = Carrera::where('nombre', 'like', "%$query%")->get();
    return view('carreras.lista')->with('carreras', $carreras);
  }

  public function buscarMateria(Request $request) {
    $query = $request->input('query');
    $materias = Materia::where('nombre', 'like', "%$query%")->get();
    return view('materias.lista')->with('materias', $materias);
  }

  public function buscarSemestre(Request $request) {
    $query = $request->input('query');
    $semestres = Semestre::where('id', 'like', "%$query%")->get();
    return view('semestres.lista')->with('semestres', $semestres);
  }

  public function buscarTodosLosGrupos(Request $request) {
    $query = $request->input('query');
    $grupos = Grupo::where('clave', 'like', "%$query%")->get();
    return view('todosLosGrupos.lista')->with('grupos', $grupos);
  }

  public function buscarMaestros(Request $request) {
    $query = $request->input('query');
    $datos = DatosUsuario::where('nombre', 'like', "%$query%")
    ->orWhere('apellido_paterno', 'like', "%$query%")
    ->orWhere('apellido_materno', 'like', "%$query%")->get();
    $aux = Maestro::all();
    $maestros = array();


    foreach($datos as $dato) {
      foreach($aux as $maestro) {
        if($dato->id == $maestro->id_datos_usuario) {
          array_push($maestros, $maestro);
        }
      }
    }

    return view('maestro.lista')->with('maestros', $maestros);
  }

  public function buscarAlumnos(Request $request) {
    $query = $request->input('query');
    $datos = DatosUsuario::where('nombre', 'like', "%$query%")
    ->orWhere('apellido_paterno', 'like', "%$query%")
    ->orWhere('apellido_materno', 'like', "%$query%")->get();
    $aux = Alumno::all();
    $alumnos = array();


    foreach($datos as $dato) {
      foreach($aux as $alumno) {
        if($dato->id == $alumno->id_datos_usuario) {
          array_push($alumnos, $alumno);
        }
      }
    }

    return view('alumno.lista')->with('alumnos', $alumnos);
  }

  public function registrarCalificaciones(Request $request) {
    $grupo = Grupo::find($request->input('id_grupo'));
    $total_alumnos = count($request->input('id'));
    $aprobados = 0;
    $reprobados = 0;
    $desertores = 0;

    for($i = 0; $i < count($request->input('id')); $i++) {
      $alumno = Alumno::find($request->input('id')[$i]);
      $alumno_grupo = AlumnoGrupo::where('id_alumno', '=', $alumno->id)->where('id_grupo', '=', $grupo->id)->first();
      $faltas_totales = 0;
      $suma_calificaciones = 0;
      $calificacion_final = 0;
      $desertor = 0;

      if(!is_null($request->input('calificacion1')[$i])) {
          $suma_calificaciones = $suma_calificaciones + $request->input('calificacion1')[$i];

          $faltas_totales = $faltas_totales + $request->input('faltas1')[$i];

          $parcial = Parcial::where('id_alumno_grupo', '=', $alumno_grupo->id)->where('numero', '=', 1)->first();
            $faltas_totales = $faltas_totales + $request->input('faltas1')[$i];
            if(!is_null($parcial)) {
              $parcial->calificacion = $request->input('calificacion1')[$i];
              $parcial->faltas = $request->input('faltas1')[$i];
              $parcial->save();
            } else {
              Parcial::create([
                'id_alumno_grupo' => $alumno_grupo->id,
                'numero' => 1,
                'faltas' => $request->input('faltas1')[$i],
                'calificacion' => $request->input('calificacion1')[$i]
              ]);
            }
      }

      if(!is_null($request->input('calificacion2')[$i])) {
        $suma_calificaciones = $suma_calificaciones + $request->input('calificacion2')[$i];

        $faltas_totales = $faltas_totales + $request->input('faltas2')[$i];

        $parcial = Parcial::where('id_alumno_grupo', '=', $alumno_grupo->id)->where('numero', '=', 2)->first();
          $faltas_totales = $faltas_totales + $request->input('faltas2')[$i];
          if(!is_null($parcial)) {
            $parcial->calificacion = $request->input('calificacion2')[$i];
            $parcial->faltas = $request->input('faltas2')[$i];
            $parcial->save();
          } else {
            Parcial::create([
              'id_alumno_grupo' => $alumno_grupo->id,
              'numero' => 2,
              'faltas' => $request->input('faltas2')[$i],
              'calificacion' => $request->input('calificacion2')[$i]
            ]);
          }
      }

      if(!is_null($request->input('calificacion3')[$i])) {
        $suma_calificaciones = $suma_calificaciones + $request->input('calificacion3')[$i];

        $faltas_totales = $faltas_totales + $request->input('faltas3')[$i];

        $parcial = Parcial::where('id_alumno_grupo', '=', $alumno_grupo->id)->where('numero', '=', 3)->first();
          $faltas_totales = $faltas_totales + $request->input('faltas3')[$i];
          if(!is_null($parcial)) {
            $parcial->calificacion = $request->input('calificacion3')[$i];
            $parcial->faltas = $request->input('faltas3')[$i];
            $parcial->save();
          } else {
            Parcial::create([
              'id_alumno_grupo' => $alumno_grupo->id,
              'numero' => 1,
              'faltas' => $request->input('faltas3')[$i],
              'calificacion' => $request->input('calificacion3')[$i]
            ]);
          }
      }

      if(!is_null($request->input('desertor'))[$i]) {
        $desertor = 1;
        $desertores++;
      }

      $calificacion_final = $suma_calificaciones / 3;

      if($calificacion_final < 70) {
        $reprobados++;
      } else {
        $aprobados++;
      }

      $registro_alumno_grupo = RegistroAlumnoGrupo::where('id_alumno_grupo', '=', $alumno_grupo->id)->first();

      if(!is_null($registro_alumno_grupo)) {
        $registro_alumno_grupo->id_tipo_curso = 0;
        $registro_alumno_grupo->faltas_totales = $faltas_totales;
        $registro_alumno_grupo->calificacion_total = $calificacion_final;
        $registro_alumno_grupo->desertor = $desertor;
        $registro_alumno_grupo->save();
      } else {
        RegistroAlumnoGrupo::create([
          'id_alumno_grupo' => $alumno_grupo->id,
          'id_tipo_curso' => 0,
          'faltas_totales' => $faltas_totales,
          'calificacion_total' => $calificacion_final,
          'desertor' => $desertor
        ]);
      }
    }

    $registro_grupo = RegistroGrupo::where('id_grupo', '=', $grupo->id)->first();

    if(!is_null($registro_grupo)) {
      $registro_grupo->total_alumnos = $total_alumnos;
      $registro_grupo->aprobados = $aprobados;
      $registro_grupo->reprobados = $reprobados;
      $registro_grupo->desertores = $desertores;
      $registro_grupo->save();
    } else {
      RegistroGrupo::create([
        'id_grupo' => $grupo->id,
        'total_alumnos' => $total_alumnos,
        'aprobados' => $aprobados,
        'reprobados' => $reprobados,
        'desertores' => $desertores
      ]);
    }

    return redirect('grupos');
  }
  

}
    