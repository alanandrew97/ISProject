<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\FileUtils;
use App\Escuela;
use App\Carrera;
use App\Campus;
use App\Reticula;
use App\Edificio;
use App\Aula;
use App\Horario;

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
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>true],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>false],
      ['nombre'=>'Retículas','link'=>url('escuela/reticulas'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false],
      ['nombre'=>'Horarios','link'=>url('escuela/horarios'), 'selected'=>false],
    ];

    // dd($submenuItems);
    return view('escuela.index', array(
      'escuela' => $escuela,
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
      
    $campus = Campus::create([
      'nombre' => $request->nombre,
      'direccion' => $request->direccion,
      'id_escuela' => 1
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
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>true],
      ['nombre'=>'Retículas','link'=>url('escuela/reticulas'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false],
      ['nombre'=>'Horarios','link'=>url('escuela/horarios'), 'selected'=>false],
    ];
    
    // dd($carrera);
    
    return view('escuela.listaCarreras', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems,
      'carreras' => $carreras
    ));
  }

  public function crearCarrera(Request $request){
    // dd($request->all());

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
    
    $carrera->nombre = $request->nombre;
    $carrera->abreviatura = $request->abreviatura;
    $carrera->total_creditos = $request->totalCreditos;
    $carrera->estructura_generica_creditos = $request->estructuraGenericaCreditos;
    $carrera->residencia_profesional_creditos = $request->residenciaProfesionalCreditos;
    $carrera->servicio_social_creditos = $request->servicioSocialCreditos;
    $carrera->actividades_complementarias_creditos = $request->actividadesComplementariasCreditos;
    
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
    // $reticulas = Reticula::all();
    $submenuItems = [
      ['nombre'=>'Campus','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>false],
      ['nombre'=>'Retículas','link'=>url('escuela/reticulas'), 'selected'=>true],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false],
      ['nombre'=>'Horarios','link'=>url('escuela/horarios'), 'selected'=>false],
    ];
    
    // dd($carrera);
    
    return view('escuela.listaReticulas', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems,
      'carreras' => $carreras,
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
      ['nombre'=>'Retículas','link'=>url('escuela/reticulas'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false],
      ['nombre'=>'Horarios','link'=>url('escuela/horarios'), 'selected'=>false],
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
      ['nombre'=>'Retículas','link'=>url('escuela/reticulas'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false],
      ['nombre'=>'Horarios','link'=>url('escuela/horarios'), 'selected'=>false],
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
      ['nombre'=>'Retículas','link'=>url('escuela/reticulas'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false],
      ['nombre'=>'Semestres','link'=>url('escuela/semestres'), 'selected'=>false],
      ['nombre'=>'Todos los grupos','link'=>url('escuela/grupos'), 'selected'=>false],
      ['nombre'=>'Edificios','link'=>url('escuela/edificios'), 'selected'=>false],
      ['nombre'=>'Aulas','link'=>url('escuela/aulas'), 'selected'=>false],
      ['nombre'=>'Horarios','link'=>url('escuela/horarios'), 'selected'=>false],
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

}
    