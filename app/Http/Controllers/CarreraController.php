<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\FileUtils;
use App\Carrera;

class CarreraController extends Controller {
    
    public function index(Request $request) {
        $carreras = Carrera::all();
        return view('carrera.index', array('carreras' => $carreras));
    }

    public function nuevo(Request $request) {
        return view('carrera.nuevo');
    }

    public function crear(Request $request) {
        $this->validate($request, [
            'nombre' => 'required',
            'abreviatura' => 'required',
            'estructura_generica_creditos' => 'required',
            'residencia_profesional_creditos' => 'required',
            'servicio_social_creditos' => 'required',
            'actividades_complementarias_creditos' => 'required',
        ]);

        $nombre = $request->input('nombre');
        $ruta_imagen = null;
        $abreviatura = $request->input('abreviatura');
        $estructura_generica_creditos = $request->input('estructura_generica_creditos');
        $residencia_profesional_creditos = $request->input('residencia_profesional_creditos');
        $servicio_social_creditos = $request->input('servicio_social_creditos');
        $actividades_complementarias_creditos = $request->input('actividades_complementarias_creditos');
        $total_creditos = $estructura_generica_creditos + $residencia_profesional_creditos + $servicio_social_creditos + $actividades_complementarias_creditos;
        $imagen = $request->file('imagen');
        if($imagen != null) $ruta_imagen = FileUtils::guardar($imagen, 'storage/convocatorias/', 'escuela_');

        Carrera::create([
            'nombre' => $nombre,
            'ruta_imagen' => $ruta_imagen,
            'abreviatura' => $abreviatura,
            'estructura_generica_creditos' => $estructura_generica_creditos,
            'residencia_profesional_creditos' => $residencia_profesional_creditos,
            'servicio_social_creditos' => $servicio_social_creditos,
            'actividades_complementarias_creditos' => $actividades_complementarias_creditos,
            'total_creditos' => $total_creditos
        ]);

        return redirect('carreras');
    }

    public function vistaEditar($id) {
        $carrera = Carrera::find($id);
        return view('carrera.editar', array('carrera' => $carrera));
    }

    public function editar(Request $request) {
        $this->validate($request, [
            'nombre' => 'required',
            'abreviatura' => 'required',
            'estructura_generica_creditos' => 'required',
            'residencia_profesional_creditos' => 'required',
            'servicio_social_creditos' => 'required',
            'actividades_complementarias_creditos' => 'required',
        ]);

        $nombre = $request->input('nombre');
        $ruta_imagen = null;
        $abreviatura = $request->input('abreviatura');
        $estructura_generica_creditos = $request->input('estructura_generica_creditos');
        $residencia_profesional_creditos = $request->input('residencia_profesional_creditos');
        $servicio_social_creditos = $request->input('servicio_social_creditos');
        $actividades_complementarias_creditos = $request->input('actividades_complementarias_creditos');
        $total_creditos = $estructura_generica_creditos + $residencia_profesional_creditos + $servicio_social_creditos + $actividades_complementarias_creditos;
        $imagen = $request->file('imagen');
        if($imagen != null) $ruta_imagen = FileUtils::guardar($imagen, 'storage/convocatorias/', 'escuela_');

    }

    public function eliminar($id) {
        $carrera = Carrera::find($id);
        $carrera->delete();
        return redirect('carreras');
    }
}
