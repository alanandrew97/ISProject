<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\FileUtils;
use App\Escuela;
use App\Carrera;

class EscuelaController extends Controller {
    

  public function index() {
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Escuela','link'=>url(''), 'selected'=>true],
      ['nombre'=>'Carreras','link'=>url(''), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url(''), 'selected'=>false]
    ];

    // dd($submenuItems);
    return view('escuela.index', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems
    ));
  }

  public function nuevo(Request $request) {
    return view('escuela.nuevo');
  }

  public function vistaEditar($id) {
    $escuela = Escuela::find($id);
    return view('escuela.editar', array('escuela' => $escuela));
  }

  public function crear(Request $request) {
    $this->validate($request, [
      'nombre' => 'required'
    ]);

    $nombre = $request->input('nombre');
    $imagen = $request->file('imagen');
    $ruta_imagen = FileUtils::guardar($imagen, 'storage/convocatorias/', 'escuela_');

    Escuela::create([
      'nombre' => $nombre,
      'ruta_imagen' => $ruta_imagen 
    ]);

    return redirect('escuelas');
  }

  public function editar(Request $request) {
    $this->validate($request, [
      'id' => 'required',
      'nombre' => 'required'
    ]);

    $id = $request->input('id');
    $nombre = $request->input('nombre');
    $imagen = $request->file('imagen');
    $ruta_imagen = null;
    if($imagen != null) $ruta_imagen = FileUtils::guardar($imagen, 'storage/convocatorias/', 'escuela_');

    $escuela = Escuela::find($id);
    $escuela->nombre = $nombre;
    if ($ruta_imagen != null) $escuela->ruta_imagen = $ruta_imagen;
    $escuela->save();

    return redirect('escuelas');
  }

  public function eliminar($id) {
    $escuela = Escuela::find($id);
    $escuela->delete();
    return redirect('escuelas');
  }

  public function detalleCarrera($id){
    $carrera = Carrera::find($id);
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Escuela','link'=>url(''), 'selected'=>true],
      ['nombre'=>'Carreras','link'=>url(''), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url(''), 'selected'=>false]
    ];

    dd($carrera);
  }

  public function listaCarreras(){
    $carreras = Carrera::all();
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Escuela','link'=>url(''), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url(''), 'selected'=>true],
      ['nombre'=>'Materias','link'=>url(''), 'selected'=>false]
    ];

    // dd($carrera);

    return view('escuela.listaCarreras', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems,
      'carreras' => $carreras
    ));
  }

  public function nuevoCampus(){
    return view('escuela.nuevoCampus');
  }

  public function crearCampus(Request $request){
    // dd($request->all());

    $this->validate($request, [
      'nombre' => 'required',
      'direccion' => 'required'
    ]);

    $campus = Campus::create([
      'nombre' => $request->nombre,
      'direccion' => $request->direccion
    ]);
  }
}
