<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\FileUtils;
use App\Escuela;
use App\Carrera;
use App\Campus;

class EscuelaController extends Controller {
    

  public function index() {
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Escuela','link'=>url('escuela'), 'selected'=>true],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false]
    ];

    // dd($submenuItems);
    return view('escuela.index', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems
    ));
  }
  
  public function detalleCarrera($id){
    $carrera = Carrera::find($id);
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Escuela','link'=>url('escuela'), 'selected'=>true],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>false],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false]
    ];
    
    dd($carrera);
  }
  
  public function listaCarreras(){
    $carreras = Carrera::all();
    $escuela = Escuela::all()->first();
    $submenuItems = [
      ['nombre'=>'Escuela','link'=>url('escuela'), 'selected'=>false],
      ['nombre'=>'Carreras','link'=>url('escuela/carreras'), 'selected'=>true],
      ['nombre'=>'Materias','link'=>url('escuela/materias'), 'selected'=>false]
    ];
    
    // dd($carrera);
    
    return view('escuela.listaCarreras', array(
      'escuela' => $escuela,
      'submenuItems' => $submenuItems,
      'carreras' => $carreras
    ));
  }

  public function eliminarCampus($id) {
    $campus = Campus::find($id);
    $campus->delete();
    return redirect('escuela');
  }
  
  public function crearCampus(Request $request){
    // dd($request->all());
    
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
}
    