@extends('layouts.app')

@section('title')
  Campus
@endsection

@section('cabecera')
  Campus
@endsection

@section('head')
  <script src="{{url('/js/escuela/escuela.js')}}"></script>
@endsection

@section('contenedor')
  <div class="row">
    <div class="input-field col s2">
    <h1>Campus</h1>
    </div>

    <div class="col s10">
        <div class="input-field col s12 ">
            <i class="material-icons prefix">search</i>
            <input type="text" id="buscar-campus" maxlength="70">
            <label for="buscar-campus">Buscar campus...</label>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12">


        @include('campus.lista')

      <div class="fixed-action-btn">
        <a href="#modalNuevoCampus" class="modal-trigger accent-color modal-close btn-floating btn-large red">
          <i class="large material-icons">add</i>
        </a>
      </div>

    </div>
  </div>

@endsection

@section('modals')
  <div id="modalNuevoCampus" class="modal" style="padding:20px;max-height:400px;">
    <form id="form-crear" method="post" action="{{url('/escuela/crearCampus')}}" class="col s12" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <h2 style="margin-bottom:25px;">Nuevo campus</h2>
        </div>

        <div class="row">
          <div class="input-field col s12 ">
            <input  id="nombre" name="nombre" type="text" maxlength="70" required>
            <label for="nombre">Nombre</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input type="text" id="direccion" name="direccion" required>
            <label for="direccion">Dirección</label>
          </div>
        </div>

        <div class="row">
            <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Registrar">
        </div>
    </form>
  </div>

  <div id="modalEditarCampus" class="modal" style="padding:30px;max-height:400px;">
    <form id="formEditar" method="POST" action="{{url('/escuela/editarCampus/')}}">
      {{csrf_field()}}
      <div class="row">
        <h2 style="margin-bottom:25px;">Editar campus</h2>
        <input type="hidden" name="campusId" id="campusId">
      </div>

      <div class="row">
        <div class="input-field col s12 ">
          <input  id="nombre" name="nombre" type="text" maxlength="70" required>
          <label for="nombre">Nombre</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <input type="text" id="direccion" name="direccion" required>
          <label for="direccion">Dirección</label>
        </div>
      </div>

      <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Guardar">
      </div>
    </form>
  </div>

  <div class="modal modal-fixed-footer" id="modalEliminarCampus" style="padding:30px;max-height:200px;">
    <form id="formEliminar" method="POST" action="{{url('/escuela/eliminarCampus')}}">
      {{csrf_field()}}
      <input type="hidden" name="campus_id" id="campus_id">
      <h2>¿Desea eliminar este campus?</h2>
      <div class="modal-footer">
        <button class="waves-effect btn primary-color" type="submit" form="formEliminar" style="width:40%;margin:auto;">Sí</button>
        <a href="" class="modal-action modal-close waves-effect btn accent-color" style="width:35%;margin:auto;">
          Cancelar
        </a>
      </div>
    </form>
  </div>
@endsection