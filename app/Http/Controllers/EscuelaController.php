<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\FileUtils;
use App\Escuela;
use App\Carrera;
use App\Campus;
use App\Reticula;

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
      ['nombre'=>'Escuela','link'=>url('escuela'), 'selected'=>true],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>false],
      ['nombre'=>'Retículas','link'=>url('escuela/reticulas'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false]
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
      ['nombre'=>'Escuela','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>true],
      ['nombre'=>'Retículas','link'=>url('escuela/reticulas'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false]
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
      ['nombre'=>'Escuela','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>false],
      ['nombre'=>'Retículas','link'=>url('escuela/reticulas'), 'selected'=>true],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false]
    ];
    
    // dd($carrera);
    
    return view('escuela.listaReticulas', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems,
      'carreras' => $carreras,
      // 'reticulas' => $reticulas
    ));
  }
}
    