<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\DatosUsuario;
use App\Maestro;
use App\Alumno;

class UsuarioController extends Controller {

    public function login(Request $request) {
        $correo = $request->input('correo');
        $password = $request->input('password');

        $datos_usuario = DatosUsuario::where('correo', '=', $correo)->first();
        
        if($datos_usuario != null) {
            if(password_verify($password, $datos_usuario->password)) {
            $maestro = Maestro::where('id_datos_usuario', '=', $datos_usuario->id)->first();
            if($maestro != null) {
                return redirect('/escuela');
            } else {
                $alumno = Alumno::where('id_datos_usuario', '=', $datos_usuario->id)->first();
                if($alumno != null) {
                    return redirect('/escuela');
                } else {
                    return redirect('/')->withErrors(['Usuario ha dejado de existir']);
                }
            }
        } else {
            return redirect('/')->withErrors(['Correo o contraseña incorrectos']);
        }
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
            'password' => 'required',
            'rol' => 'required'
        ]);

        $nombre = $request->input('nombre');
        $apellido_paterno = $request->input('apellido_paterno');
        $apellido_materno = $request->input('apellido_materno');
        $correo = $request->input('correo');
        $password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $administrador = $request->input('administrador');
        $rol = $request->input('rol');

        $datos_usuario = DatosUsuario::create([
            'nombre' => $nombre,
            'apellido_paterno' => $apellido_materno,
            'apellido_materno' => $apellido_materno,
            'correo' => $correo,
            'password' => $password
        ]);
    }

    public function registrarPrimerUsuario(Request $request) {
        $this->validate($request, [
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'correo' => 'required',
            'password' => 'required',
            'rol' => 'required'
        ]);

        $nombre = $request->input('nombre');
        $apellido_paterno = $request->input('apellido_paterno');
        $apellido_materno = $request->input('apellido_materno');
        $correo = $request->input('correo');
        $password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $administrador = $request->input('administrador');
        $rol = $request->input('rol');

        $datos_usuario = DatosUsuario::create([
            'nombre' => $nombre,
            'apellido_paterno' => $apellido_materno,
            'apellido_materno' => $apellido_materno,
            'correo' => $correo,
            'password' => $password
        ]);

        if($rol == 1) {
            Maestro::create([
                'id_datos_usuario' => $datos_usuario->id,
                'administrador' => $administrador
            ]);
        } 

        return redirect('/');
    }
}
