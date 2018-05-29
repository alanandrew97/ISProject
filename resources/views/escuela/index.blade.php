@extends('layouts.app')

@section('title')
  Escuelas
@endsection

@section('cabecera')
  Escuelas
@endsection

@section('head')
  <script src="{{url('/js/escuela/escuela.js')}}"></script>
@endsection

@section('contenedor')
  <div class="row">
    <div class="col s12">
      @if( count($escuela->campus) != 0 )
        @foreach($escuela->campus as $campus)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">location_city</i><div class="campusNombre">{{$campus->nombre}}</div>
                <a href="#modalEditarCampus" class="modal-trigger"><i style="position:absolute;right:35px;" data-campus-id="{{$campus->id}}" class="material-icons right edit-campus">edit</i></a>
                <a href="#modalEliminarCampus" class="modal-trigger"><i style="position:absolute;right:0px;" data-campus-id="{{$campus->id}}" class="material-icons right delete-campus">close</i></a>
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <span class="campusDireccion" style="margin-bottom: 10px;" class="col s12">{{$campus->direccion}}</span>
                @foreach($campus->carreras as $carrera)
                  <div>
                    <a class="" href="{{url('escuela/carreras/')}}"><i class="material-icons" style="margin-right:10px;">school</i>{{$carrera->nombre}}</a>
                  </div>
                @endforeach
              </div>
            </li>
          </ul>
        @endforeach
      @else
        <div class="error">Aun no hay campus registrados en esta escuela.</div>
      @endif

      <div class="fixed-action-btn">
        <a href="#modalNuevoCampus" class="modal-trigger accent-color modal-close btn-floating btn-large red">
          <i class="large material-icons">add</i>
        </a>
      </div>

    </div>
  </div>

@endsection

@section('modals')
  <div id="modalNuevoCampus" class="modal" style="padding:20px;">
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

  <div id="modalEditarCampus" class="modal" style="padding:30px;">
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

  <div class="modal modal-fixed-footer" id="modalEliminarCampus" style="padding:30px;">
    <form id="formEliminar" action="{{url('/escuela/eliminarCampus')}}">
      {{csrf_field()}}
      <input type="hidden" name="campus_id" id="campus_id">
      <h2>¿Desea eliminar este campus?</h2>
      <div class="modal-footer">
        <a href="" class="modal-action modal-close waves-effect btn accent-color" style="width:35%;margin:auto;">
          Cancelar
        </a>
        <input class="waves-effect btn primary-color" type="submit" value="Sí" style="width:40%;margin:auto;">
      </div>
    </form>
  </div>
@endsection