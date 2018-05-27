<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Escuela;

class BienvenidaController extends Controller {
    

    public function index(Request $request) {
        $menuItems = array();
        $escuelas = Escuela::all();
        $escuelasItem = array();
        foreach ($escuelas as $escuela) {
            $escuelaItem = array();
            $escuelaItem['id'] = $escuela->id;
            $escuelaItem['nombre'] = $escuela->nombre;
            array_push($escuelasItem, $escuelaItem);
        }

        $menuItems['escuelas'] = $escuelasItem;


        return view('inicio.index', array('menuItems' => $menuItems));
    }

    public function getMenuItems(){
        $menuItems = array();
        $escuelas = Escuela::all();
        $escuelasItem = array();
        foreach ($escuelas as $escuela) {
            $escuelaItem = array();
            $escuelaItem['id'] = $escuela->id;
            $escuelaItem['nombre'] = $escuela->nombre;
            array_push($escuelasItem, $escuelaItem);
        }

        $menuItems['escuelas'] = $escuelasItem;
        return response()->json($menuItems);
    }
}
