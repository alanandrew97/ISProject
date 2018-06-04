@extends('layouts.app')

@section('title')
  Semestres
@endsection

@section('cabecera')
  Semestres
@endsection

@section('head')
  <script src="{{url('/js/edificio/edificio.js')}}"></script>
@endsection

@section('contenedor')
<div class="row">
    <div class="input-field col s2">
      <h1>Semestres</h1>
      </div>

    <div class="col s10">
          <div class="input-field col s12 ">
              <i class="material-icons prefix">search</i>
              <input type="text" id="buscar-semestre" maxlength="70">
              <label for="buscar-semestre">Buscar semestre...</label>
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col s12">
      
    @include('semestres.lista')

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
    <form id="form-crear" method="post" action="{{url('/escuela/registrarSemestre')}}" class="col s12" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <h2 style="margin-bottom:25px;">Nuevo semestre</h2>
        </div>

        <div class="row">
          <div class="input-field col s8 ">
          <input id="fecha1inicio" name="fecha_inicial_parcial_1"type="text" class="datepicker">
          <label for="fecha1inicio">Fecha inicio parcial 1</label>
          </div>

          <div class="input-field col s8 ">
          <input id="fecha1fin" name="fecha_final_parcial_1"type="text" class="datepicker">
          <label for="fecha1fin">Fecha fin parcial 1</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s8 ">
          <input id="fecha2inicio" name="fecha_inicial_parcial_2"type="text" class="datepicker">
          <label for="fecha2inicio">Fecha inicio parcial 2</label>
          </div>

          <div class="input-field col s8 ">
          <input id="fecha2fin" name="fecha_final_parcial_2"type="text" class="datepicker">
          <label for="fecha2fin">Fecha fin parcial 2</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s8 ">
          <input id="fecha3inicio" name="fecha_inicial_parcial_3"type="text" class="datepicker">
          <label for="fecha3inicio">Fecha inicio parcial 3</label>
          </div>

          <div class="input-field col s8 ">
          <input id="fecha3fin" name="fecha_final_parcial_3"type="text" class="datepicker">
          <label for="fecha3fin">Fecha fin parcial 3</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s8 ">
          <input id="fechainiciopromedio" name="fecha_inicial_promedio"type="text" class="datepicker">
          <label for="fechainiciopromedio">Fecha inicio entrega de promedios</label>
          </div>

          <div class="input-field col s8 ">
          <input id="fechafinpromedio" name="fecha_final_promedio"type="text" class="datepicker">
          <label for="fechafinpromedio">Fecha fin entrega de promedios</label>
          </div>
        </div>

        <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Registrar">
        </div>
    </form>
  </div>

  <div id="modalEditarEdificio" class="modal" style="padding:30px;overflow-y:scroll;">
    <form id="formEditar" method="POST" action="{{url('/escuela/editarSemestre/')}}" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="row">
          <h2 style="margin-bottom:25px;">Editar semestre</h2>
        </div>

        <input type="hidden" id="id-editar" name="id">

        <div class="row">
          <div class="input-field col s8 ">
          <input id="inicioParcial1" name="fecha_inicial_parcial_1"type="text" class="datepicker">
          <label for="inicioParcial1">Fecha inicio parcial 1</label>
          </div>

          <div class="input-field col s8 ">
          <input id="finParcial1" name="fecha_final_parcial_1"type="text" class="datepicker">
          <label for="finParcial1">Fecha fin parcial 1</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s8 ">
          <input id="inicioParcial2" name="fecha_inicial_parcial_2"type="text" class="datepicker">
          <label for="inicioParcial2">Fecha inicio parcial 2</label>
          </div>

          <div class="input-field col s8 ">
          <input id="finParcial2" name="fecha_final_parcial_2"type="text" class="datepicker">
          <label for="finParcial2">Fecha fin parcial 2</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s8 ">
          <input id="inicioParcial3" name="fecha_inicial_parcial_3"type="text" class="datepicker">
          <label for="inicioParcial3">Fecha inicio parcial 3</label>
          </div>

          <div class="input-field col s8 ">
          <input id="finParcial3" name="fecha_final_parcial_3"type="text" class="datepicker">
          <label for="finParcial3">Fecha fin parcial 3</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s8 ">
          <input id="inicioPromedio" name="fecha_inicial_promedio"type="text" class="datepicker">
          <label for="inicioPromedio">Fecha inicio entrega de promedios</label>
          </div>

          <div class="input-field col s8 ">
          <input id="finPromedio" name="fecha_final_promedio"type="text" class="datepicker">
          <label for="finPromedio">Fecha fin entrega de promedios</label>
          </div>
        </div>

      <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Guardar">
      </div>
    </form>
  </div>

  <div class="modal modal-fixed-footer" id="modalEliminarEdificio" style="padding:30px;max-height:200px;">
    <form id="formEliminar" action="{{url('/escuela/eliminarSemestre')}}" method="POST">
      {{csrf_field()}}
      <input type="hidden" name="id" id="id-eliminar">
      <h2>¿Desea eliminar este semestre?</h2>
      <div class="modal-footer">
        <button class="waves-effect btn primary-color" type="submit" form="formEliminar" style="width:40%;margin:auto;">Sí</button>
        <a href="" class="modal-action modal-close waves-effect btn accent-color" style="width:35%;margin:auto;">
          Cancelar
        </a>
      </div>
    </form>
  </div>
@endsection