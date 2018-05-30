<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => '/'], function () {
    Route::get('', 'IndexController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'escuela'], function() {
    Route::get('/', 'EscuelaController@index');
    Route::post('crearCampus', 'EscuelaController@crearCampus');
    Route::post('editarCampus', 'EscuelaController@editarCampus');
    Route::post('eliminarCampus', 'EscuelaController@eliminarCampus');
    Route::get('carreras', 'EscuelaController@listaCarreras');
    Route::post('crearCarrera', 'EscuelaController@crearCarrera');
    Route::post('editarCarrera', 'EscuelaController@editarCarrera');
    Route::post('eliminarCarrera', 'EscuelaController@eliminarCarrera');
    Route::post('registrar', 'EscuelaController@registrar');
    Route::get('reticulas', 'EscuelaController@listaReticulas');
    Route::get('edificios', 'EscuelaController@listaEdificios');
    Route::post('registrarEdificio', 'EscuelaController@registrarEdificio');
    Route::post('editarEdificio', 'EscuelaController@editarEdificio');
    Route::post('eliminarEdificio', 'EscuelaController@eliminarEdificio');
    Route::get('aulas', 'EscuelaController@listaAulas');
    Route::post('registrarAula', 'EscuelaController@registrarAula');
    Route::post('editarAula', 'EscuelaController@editarAula');
    Route::post('eliminarAula', 'EscuelaController@eliminarAula');
    Route::get('horarios', 'EscuelaController@listaHorarios');
    Route::post('registrarHorario', 'EscuelaController@registrarHorario');
    Route::post('editarHorario', 'EscuelaController@editarHorario');
    Route::post('eliminarHorario', 'EscuelaController@eliminarHorario');
    Route::get('semestres', 'EscuelaController@listaSemestres');
    Route::post('registrarSemestre', 'EscuelaController@registrarSemestre');
    Route::post('editarSemestre', 'EscuelaController@editarSemestre');
    Route::post('eliminarSemestre', 'EscuelaController@eliminarSemestre');
    Route::get('grupos', 'EscuelaController@listaGrupos');



    // Route::get('nuevo', 'EscuelaController@nuevo');
    // Route::post('crear', 'EscuelaController@crear');
    // Route::get('editar/{id}', 'EscuelaController@vistaEditar');
    // Route::post('editar', 'EscuelaController@editar');
    // Route::get('eliminar/{id}', 'EscuelaController@eliminar');
    // Route::get('carrera/{id}', 'EscuelaController@detalleCarrera');
    // Route::get('campus/nuevo', 'EscuelaController@nuevoCampus');
    // Route::get('detalle/{id}', 'EscuelaController@detalleEscuela');
});

Route::group(['prefix' => 'usuarios'], function() {
    Route::get('/', 'UsuarioController@index');
    Route::get('alumnos', 'UsuarioController@listaAlumnos');
    Route::post('registrarPrimerUsuario', 'UsuarioController@registrarPrimerUsuario');
    Route::post('registrar', 'UsuarioController@registrar');
    Route::post('login', 'UsuarioController@login');
    Route::post('editar', 'UsuarioController@editar');
    Route::post('eliminar', 'UsuarioController@eliminar');
});