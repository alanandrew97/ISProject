<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DatosUsuario;
use App\Maestro;
use App\Alumno;
use App\Escuela;
use App\Carrera;
use App\Turno;

class UsuarioController extends Controller {

    public function login(Request $request) {
        $correo = $request->input('correo');
        $password = $request->input('password');

        $datos_usuario = DatosUsuario::where('correo', '=', $correo)->first();
        
        if($datos_usuario != null) {
            if(password_verify($password, $datos_usuario->password)) {
            $maestro = Maestro::where('id_datos_usuario', '=', $datos_usuario->id)->first();
            if($maestro != null) {

                session(['usuario' => $maestro, 'rol' => '1']);

                //dump(session('usuario'));

                return redirect('/grupos');
            } else {
                $alumno = Alumno::where('id_datos_usuario', '=', $datos_usuario->id)->first();
                if($alumno != null) {
                    session(['usuario' => $alumno, 'rol' => '2']);
                    return redirect('/grupos');
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
        $escuela = Escuela::all()->first();
        $maestros = Maestro::all();
        $submenuItems = [
            ['nombre'=>'Maestros', 'link'=>url('usuarios/'), 'selected'=>true],
            ['nombre'=>'Alumnos', 'link'=>url('usuarios/alumnos'), 'selected'=>false]
        ];

        return view('usuario.listaMaestros', array(
            'maestros' => $maestros,
            'escuela' => $escuela,
            'submenuItems' => $submenuItems
        ));
    }

    public function listaAlumnos(Request $request) {
        $escuela = Escuela::all()->first();
        $carreras = Carrera::all();
        $turnos = Turno::all();
        $alumnos = Alumno::all();
        $submenuItems = [
            ['nombre'=>'Maestros', 'link'=>url('usuarios/'), 'selected'=>true],
            ['nombre'=>'Alumnos', 'link'=>url('usuarios/alumnos'), 'selected'=>false]
        ];

        return view('usuario.listaAlumnos', array(
            'alumnos' => $alumnos,
            'escuela' => $escuela,
            'carreras' => $carreras,
            'turnos' => $turnos,
            'submenuItems' => $submenuItems
        ));
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
        $administrador = 0;
        $rol = $request->input('rol');

        if(!is_null($request->input('administrador'))) {
            $administrador = 1;
        }

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
        } else {
            Alumno::create([
                'id_datos_usuario' => $datos_usuario->id,
                'matricula' => $request->input('matricula'),
                'id_carrera' => $request->input('id_carrera'),
                'semestre' => $request->input('semestre'),
                'id_turno' => $request->input('id_turno')
            ]);
        }

        return redirect('usuarios');
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
            'apellido_paterno' => $apellido_paterno,
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

    public function editar(Request $request) {
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
        $administrador = 0;
        $rol = $request->input('rol');

        if(!is_null($request->input('administrador'))) {
            $administrador = 1;
        }

        $datos_usuario = DatosUsuario::find($request->input('id_datos_usuario'));

        $maestro = Maestro::where('id_datos_usuario', '=', $datos_usuario->id)->first();

        if(!is_null($maestro)) {
            $datos_usuario->nombre = $nombre;
            $datos_usuario->apellido_paterno = $apellido_paterno;
            $datos_usuario->apellido_materno = $apellido_materno;
            $datos_usuario->correo = $correo;
            $datos_usuario->password = $password;
            $maestro->administrador = $administrador;

            $datos_usuario->save();
            $maestro->save();
        } else {
            $alumno = Alumno::where('id_datos_usuario', '=', $datos_usuario->id)->first();
            $datos_usuario->nombre = $nombre;
            $datos_usuario->apellido_paterno = $apellido_paterno;
            $datos_usuario->apellido_materno = $apellido_materno;
            $datos_usuario->correo = $correo;
            $datos_usuario->password = $password;
            $alumno->matricula = $request->input('matricula');
            $alumno->id_carrera = $request->input('id_carrera');
            $alumno->semestre = $request->input('semestre');
            $alumno->id_turno = $request->input('id_turno');
            
            $datos_usuario->save();
            $alumno->save();
        }

        return redirect('usuarios');
    }

    public function eliminar(Request $request) {
        $datos_usuario = DatosUsuario::find($request->input('id_datos_usuario'));
        $maestro = Maestro::where('id_datos_usuario', '=', $datos_usuario->id)->first();

        if(!is_null($maestro)) {
            $maestro->delete();
            $datos_usuario->delete();
        } else {
            $alumno = Alumno::where('id_datos_usuario', '=', $datos_usuario->id)->first();
            $alumno->delete();
            $datos_usuario->delete();
        }

        return redirect('usuarios');
    }
}
