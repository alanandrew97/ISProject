<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Escuela;

class GrupoController extends Controller {
    public function index() {
        $escuela = Escuela::all()->first();
        $submenuItems = [
          ];
    
        // dd($submenuItems);
        return view('escuela.index', array(
          'escuela' => $escuela,
          'submenuItems' => $submenuItems
        ));
      }
}
