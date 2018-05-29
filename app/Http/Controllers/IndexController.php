<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Escuela;
use App\Maestro;

class IndexController extends Controller {
    
    public function index(Request $request) {
        $escuela = Escuela::all()->first();
        $maestro = Maestro::all()->first();

        if(is_null($escuela)) {
            return view('escuela.primeraEscuela');
        } else if(is_null($maestro)) {
            return view('maestro.primerMaestro');
        } else {
            return view('login')->with('escuela', $escuela);
        }
    }

}
