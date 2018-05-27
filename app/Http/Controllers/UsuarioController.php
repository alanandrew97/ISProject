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

    public function crear(Request $request) {
        $correo = $request->input('correo');
        $nombre = $request->input('nombre');
        $apellido_paterno = $request->input('apellido_paterno');
        $apellido_materno = $request->input('apellido_materno');
        $tipo = $request->input('tipo');
        $password = $request->input('password');

        Usuario::create([
            'id_tecnologico' => 1,
            'correo' => $correo,
            'password' => $password,
            'nombre' => $nombre,
            'apellido_paterno' => $apellido_paterno,
            'apellido_materno' => $apellido_materno,
            'tipo' => $tipo
        ]);

        return redirect('usuario');
    }

    public function nuevo(Request $request) {
        return view('usuarios.nuevo');
    }
}
