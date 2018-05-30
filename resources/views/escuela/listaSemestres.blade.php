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
    <h1>Semestres</h1>
  </div>
  <div class="row">
    <div class="col s12">
      @if( count($semestres) != 0 )
        @foreach($semestres as $semestre)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">school</i><div class="carreraNombre">{{$semestre->id}}: {{$semestre->fecha_inicial_parcial_1}} - {{$semestre->fecha_final_promedio}}</div>&nbsp;&nbsp;
                <a href="#modalEditarEdificio" class="modal-trigger"><i style="position:absolute;right:35px;" data-edificio-id="{{$semestre->id}}" class="material-icons right edit-edificio">edit</i></a>
                <a href="#modalEliminarEdificio" class="modal-trigger"><i style="position:absolute;right:0px;" data-edificio-id="{{$semestre->id}}" class="material-icons right delete-edificio">close</i></a>
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <div style="display:inline-block;">
                  <div class="col s12">Inicio parcial 1:&nbsp;<span class="totalCreditos"> {{$semestre->fecha_inicial_parcial_1}}</span></div><br>
                  <div class="col s12">Fin parcial 1:&nbsp;<span class="estructuraGenericaCreditos">{{$semestre->fecha_final_parcial_1}}</span></div><br>
                  <div class="col s12">Inicio parcial 2:&nbsp;<span class="totalCreditos"> {{$semestre->fecha_inicial_parcial_2}}</span></div><br>
                  <div class="col s12">Fin parcial 2:&nbsp;<span class="estructuraGenericaCreditos">{{$semestre->fecha_final_parcial_2}}</span></div><br>
                  <div class="col s12">Inicio parcial 3:&nbsp;<span class="totalCreditos"> {{$semestre->fecha_inicial_parcial_3}}</span></div><br>
                  <div class="col s12">Fin parcial 3:&nbsp;<span class="estructuraGenericaCreditos">{{$semestre->fecha_final_parcial_3}}</span></div><br>
                  <div class="col s12">Inicio entrega de promedios:&nbsp;<span class="totalCreditos"> {{$semestre->fecha_inicial_promedio}}</span></div><br>
                  <div class="col s12">Fin entrega de promedios:&nbsp;<span class="estructuraGenericaCreditos">{{$semestre->fecha_final_promedio}}</span></div><br>
                </div>
            </ul>
        @endforeach
      @else
        <div class="error">Aun no hay semestres registrados en esta escuela.</div>
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
          <h2 style="margin-bottom:25px;">Nuevo semestre</h2>
        </div>

        <input type="hidden" id="id-editar" name="id">

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