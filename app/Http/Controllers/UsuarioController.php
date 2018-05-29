<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller {

    public function login(Request $request) {
        $correo = $request->input('email');
        $password = $request->input('password');

        $usuario = Usuario::where('correo', '=', $correo)->where('password', '=', $password)->first();
        
        if($usuario != null) {
            return redirect('bienvenida');
        } else {
            return redirect('/')->withErrors(['Correo o contraseña incorrectos']);
        }
    }

    public function index(Request $request) {
        $usuarios = Usuario::all();

        return view('usuarios.index')->with('usuarios' , $usuarios);
    }

    public function nuevo(Request $request) {
        return view('usuarios.nuevo');
    }

    public function registrar(Request $request) {
        $this->validate($request, [
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'correo' => 'required',
            'password' => 'required'
        ]);

        
    }
}
