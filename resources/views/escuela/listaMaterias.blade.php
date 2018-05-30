@extends('layouts.app')

@section('title')
  Materias
@endsection

@section('cabecera')
  Materias
@endsection

@section('head')
  <script src="{{url('/js/edificio/edificio.js')}}"></script>
@endsection

@section('contenedor')
  <div class="row">
    <h1>Materias</h1>
  </div>
  <div class="row">
    <div class="col s12">
      @if( count($materias) != 0 )
        @foreach($materias as $materia)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">school</i><div class="carreraNombre">{{$materia->nombre}}</div>&nbsp;&nbsp;
                <a href="#modalEditarEdificio" class="modal-trigger"><i style="position:absolute;right:35px;" data-edificio-id="{{$materia->id}}" class="material-icons right edit-edificio">edit</i></a>
                <a href="#modalEliminarEdificio" class="modal-trigger"><i style="position:absolute;right:0px;" data-edificio-id="{{$materia->id}}" class="material-icons right delete-edificio">close</i></a>
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <div style="display:inline-block;">
                  <div class="col s12">Nombre:&nbsp;<span class="totalCreditos"> {{$materia->nombre}}</span></div><br>
                  <div class="col s12">Clave:&nbsp;<span class="estructuraGenericaCreditos">{{$materia->clave}}</span></div><br>
                  <div class="col s12">Horas teoria:&nbsp;<span class="totalCreditos"> {{$materia->horas_teoria}}</span></div><br>
                  <div class="col s12">Horas practica:&nbsp;<span class="estructuraGenericaCreditos">{{$materia->horas_practica}}</span></div><br>
                  <div class="col s12">Créditos:&nbsp;<span class="estructuraGenericaCreditos">{{$materia->creditos}}</span></div><br>
                </div>
                </div>
            </li>
        </ul>

        @endforeach
      @else
        <div class="error">Aun no hay materias registradas en esta escuela.</div>
      @endif

      <div class="fixed-action-btn">
        <a href="#modalNuevoEdificio" class="modal-trigger accent-color modal-close btn-floating btn-large">
          <i class="large material-icons">add</i>
        </a>
      </div>

    </div>
  </div>

@endsection

@section('modals')
  <div id="modalNuevoEdificio" class="modal" style="padding:20px;overflow-y:scroll;">
    <form id="form-crear" method="post" action="{{url('/escuela/registrarMateria')}}" class="col s12" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <h2 style="margin-bottom:25px;">Nueva materia</h2>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input  id="nombre" name="nombre" type="text" maxlength="70" required>
            <label for="nombre">Nombre</label>
          </div>
          </div>

        <div class="row">
          <div class="input-field col s6">
          <input  id="clave" name="clave" type="text" maxlength="70" required>
            <label for="clave">Clave</label>
          </div>

          <div class="input-field col s6">
          <input  id="creditos" name="creditos" type="number" maxlength="70" required>
            <label for="creditos">Créditos</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
          <input  id="horas1" name="horas_teoria" type="text" maxlength="70" required>
            <label for="horas1">Horas teoria</label>
          </div>

          <div class="input-field col s6">
          <input  id="horas2" name="horas_practica" type="number" maxlength="70" required>
            <label for="horas2">Horas practica</label>
          </div>
        </div>

        <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Registrar">
        </div>
    </form>
  </div>

  <div id="modalEditarEdificio" class="modal" style="padding:30px;overflow-y:scroll;">
    <form id="formEditar" method="POST" action="{{url('/escuela/editarMateria/')}}" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="row">
          <h2 style="margin-bottom:25px;">Editar materia</h2>
        </div>

        <input type="hidden" id="id-editar" name="id">

        <div class="row">
          <div class="input-field col s12">
            <input  id="nombre" name="nombre" type="text" maxlength="70" required>
            <label for="nombre">Nombre</label>
          </div>
          </div>

        <div class="row">
          <div class="input-field col s6">
          <input  id="clave" name="clave" type="text" maxlength="70" required>
            <label for="clave">Clave</label>
          </div>

          <div class="input-field col s6">
          <input  id="creditos" name="creditos" type="number" maxlength="70" required>
            <label for="creditos">Créditos</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
          <input  id="horas1" name="horas_teoria" type="text" maxlength="70" required>
            <label for="horas1">Horas teoria</label>
          </div>

          <div class="input-field col s6">
          <input  id="horas2" name="horas_practica" type="number" maxlength="70" required>
            <label for="horas2">Horas practica</label>
          </div>
        </div>

      <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Guardar">
      </div>
    </form>
  </div>

  <div class="modal modal-fixed-footer" id="modalEliminarEdificio" style="padding:30px;max-height:200px;">
    <form id="formEliminar" action="{{url('/escuela/eliminarMateria')}}" method="POST">
      {{csrf_field()}}
      <input type="hidden" name="id" id="id-eliminar">
      <h2>¿Desea eliminar esta materia?</h2>
      <div class="modal-footer">
        <button class="waves-effect btn primary-color" type="submit" form="formEliminar" style="width:40%;margin:auto;">Sí</button>
        <a href="" class="modal-action modal-close waves-effect btn accent-color" style="width:35%;margin:auto;">
          Cancelar
        </a>
      </div>
    </form>
  </div>

  
@endsection