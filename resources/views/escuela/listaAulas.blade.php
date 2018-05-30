@extends('layouts.app')

@section('title')
  Edificios
@endsection

@section('cabecera')
  Edificios
@endsection

@section('head')
  <script src="{{url('/js/edificio/edificio.js')}}"></script>
@endsection

@section('contenedor')
  <div class="row">
    <h1>Aulas</h1>
  </div>
  <div class="row">
    <div class="col s12">
      @if( count($aulas) != 0 )
        @foreach($aulas as $aula)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">school</i><div class="carreraNombre">{{$aula->numero}}</div>&nbsp;&nbsp;
                <a href="#modalEditarEdificio" class="modal-trigger"><i style="position:absolute;right:35px;" data-edificio-id="{{$aula->id}}" class="material-icons right edit-edificio">edit</i></a>
                <a href="#modalEliminarEdificio" class="modal-trigger"><i style="position:absolute;right:0px;" data-edificio-id="{{$aula->id}}" class="material-icons right delete-edificio">close</i></a>
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <div style="display:inline-block;">
                  <div class="col s12">Número:&nbsp;<span class="totalCreditos"> {{$aula->numero}}</span></div><br>
                  <div class="col s12">Edificio:&nbsp;<span class="estructuraGenericaCreditos">{{$aula->edificio->nombre}}</span></div><br>
                  <div class="col s12">Clave:&nbsp;<span class="estructuraGenericaCreditos">{{$aula->edificio->clave}}</span></div><br>
        @endforeach
      @else
        <div class="error">Aun no hay aulas registrados en esta escuela.</div>
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
    <form id="form-crear" method="post" action="{{url('/escuela/registrarAula')}}" class="col s12" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <h2 style="margin-bottom:25px;">Nueva aula</h2>
        </div>

        <div class="row">
          <div class="input-field col s8 ">
            <input  id="numero" name="numero" type="number" maxlength="70" required>
            <label for="numero">Numero</label>
          </div>

            <div class="input-field col s12">
                <select id="edificio" name="id_edificio" class="select-wrapper">
                    @foreach($edificios as $edificio)
                        <option value="{{ $edificio->id }}">{{$edificio->nombre}}</option>
                    @endforeach
                </select>
                <label>Edificio</label>
            </div>
        </div>

        <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Registrar">
        </div>
    </form>
  </div>

  <div id="modalEditarEdificio" class="modal" style="padding:30px;overflow-y:scroll;">
    <form id="formEditar" method="POST" action="{{url('/escuela/editarAula/')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <h2 style="margin-bottom:25px;">Editar aula</h2>
        <input type="hidden" name="id" id="id-editar">
      </div>

      <div class="row">
          <div class="input-field col s8 ">
            <input  id="numero" name="numero" type="number" maxlength="70" required>
            <label for="numero">Numero</label>
          </div>

            <div class="input-field col s12">
                <select id="edificio" name="id_edificio" class="select-wrapper">
                    @foreach($edificios as $edificio)
                        <option value="{{ $edificio->id }}">{{$edificio->nombre}}</option>
                    @endforeach
                </select>
                <label>Edificio</label>
            </div>
        </div>

      <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Guardar">
      </div>
    </form>
  </div>

  <div class="modal modal-fixed-footer" id="modalEliminarEdificio" style="padding:30px;max-height:200px;">
    <form id="formEliminar" action="{{url('/escuela/eliminarAula')}}" method="POST">
      {{csrf_field()}}
      <input type="hidden" name="id" id="id-eliminar">
      <h2>¿Desea eliminar esta aula?</h2>
      <div class="modal-footer">
        <button class="waves-effect btn primary-color" type="submit" form="formEliminar" style="width:40%;margin:auto;">Sí</button>
        <a href="" class="modal-action modal-close waves-effect btn accent-color" style="width:35%;margin:auto;">
          Cancelar
        </a>
      </div>
    </form>
  </div>
@endsection