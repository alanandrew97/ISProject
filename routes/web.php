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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'escuela'], function() {
    Route::get('/', 'EscuelaController@index');
    // Route::get('nuevo', 'EscuelaController@nuevo');
    // Route::post('crear', 'EscuelaController@crear');
    // Route::get('editar/{id}', 'EscuelaController@vistaEditar');
    // Route::post('editar', 'EscuelaController@editar');
    // Route::get('eliminar/{id}', 'EscuelaController@eliminar');
    // Route::get('carrera/{id}', 'EscuelaController@detalleCarrera');
    Route::post('crearCampus', 'EscuelaController@crearCampus');
    Route::post('editarCampus', 'EscuelaController@editarCampus');
    Route::get('eliminarCampus/{id}', 'EscuelaController@eliminarCampus');
    // Route::get('campus/nuevo', 'EscuelaController@nuevoCampus');
    // Route::get('detalle/{id}', 'EscuelaController@detalleEscuela');
    Route::get('carreras', 'EscuelaController@listaCarreras');
});