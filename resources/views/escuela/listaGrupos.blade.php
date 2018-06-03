@extends('layouts.app')

@section('title')
  Grupos
@endsection

@section('cabecera')
  Grupos
@endsection

@section('head')
  <script src="{{url('/js/edificio/edificio.js')}}"></script>
@endsection

@section('contenedor')
  <div class="row">
    <h1>Grupos</h1>
  </div>
  <div class="row">
    <div class="col s12">
      @if( count($grupos) != 0 )
        @foreach($grupos as $grupo)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">school</i><div class="carreraNombre">{{$grupo->clave}}</div>&nbsp;&nbsp;
                <a href="#modalEditarEdificio" class="modal-trigger"><i style="position:absolute;right:35px;" data-edificio-id="{{$grupo->id}}" class="material-icons right edit-edificio">add</i></a>
                <a href="#modalEliminarEdificio" class="modal-trigger"><i style="position:absolute;right:0px;" data-edificio-id="{{$grupo->id}}" class="material-icons right delete-edificio">print</i></a>
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <div style="display:inline-block;">
                  <div class="col s12">Clave:&nbsp;<span class="totalCreditos"> {{$grupo->clave}}</span></div><br>
                  
                  @if(!is_null($grupo->materia))
                  <div class="col s12">Materia:&nbsp;<span class="estructuraGenericaCreditos">{{$grupo->materia->nombre}}</span></div><br>
                  @endif
                  
                  @if(!is_null($grupo->maestro))
                  <div class="col s12">Maestro:&nbsp;<span class="estructuraGenericaCreditos">{{$grupo->maestro->nombre}} {{$grupo->maestro->apellido_paterno}} {{$grupo->maestro->apellido_materno}}</span></div><br>
                  @endif

                  @if(!is_null($grupo->aula))
                  <div class="col s12">Edificio:&nbsp;<span class="estructuraGenericaCreditos">{{$grupo->aula->edificio->nombre}}</span></div><br>
                  <div class="col s12">Aula:&nbsp;<span class="estructuraGenericaCreditos">{{$grupo->aula->numero}}</span></div><br>
                  @endif

                  @if(!is_null($grupo->semestre))
                  <div class="col s12">Semestre:&nbsp;<span class="estructuraGenericaCreditos">{{$grupo->semestre->fecha_inicial_parcial_1}} - {{$grupo->semestre->fecha_final_promedio}}</span></div><br>
                  @endif

                  @if(count($grupo->alumnosGrupo) != 0)
                  <div class="col s12">Alumnos:&nbsp;</div><br>
                  <ul>
                    @foreach($grupo->alumnosGrupo as $registro)
                    <li>
                    <div class="col s12">Nombre:&nbsp;<span class="totalCreditos">{{$registro->alumno->datosUsuario->nombre}} {{$registro->alumno->datosUsuario->apellido_paterno}} {{$registro->alumno->datosUsuario->apellido_materno}} Matricula: {{$registro->alumno->matricula}}</span></div><br>
                    </li>
                    @endforeach
                  </ul>
                  @else
                  <div class="error">Aun no hay alumnos registrados en este grupo.</div>
                  @endif

                </div>
                </div>
            </li>
        </ul>

        @endforeach
      @else
        <div class="error">Aun no hay grupos registrados en esta escuela.</div>
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
    <form id="form-crear" method="post" action="{{url('/escuela/registrarGrupo')}}" class="col s12" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <h2 style="margin-bottom:25px;">Nuevo grupo</h2>
        </div>


 <div class="input-field col s12">
                    <input  id="matricula" name="clave" type="number" maxlength="70" required>
                    <label for="matricula">Clave</label>
                </div>
        
        <div class="input-field col s12">
            <select id="carrera" name="id_materia" class="select-wrapper">
                @foreach($materias as $materia)
                    <option value="{{ $materia->id }}">{{$materia->nombre}}</option>
                @endforeach
            </select>
            <label>Materia</label>
        </div>

        <div class="input-field col s12">
            <select id="carrera" name="id_maestro" class="select-wrapper">
                @foreach($maestros as $maestro)
                    <option value="{{ $maestro->id }}">{{$maestro->datosUsuario->nombre}}</option>
                @endforeach
            </select>
            <label>Maestro</label>
        </div>

        <div class="input-field col s12">
            <select id="carrera" name="id_aula" class="select-wrapper">
                @foreach($aulas as $aula)
                    <option value="{{ $aula->id }}">{{$aula->numero}}</option>
                @endforeach
            </select>
            <label>Aula</label>
        </div>

        
        <div class="input-field col s12">
            <select id="carrera" name="id_semestre" class="select-wrapper">
                @foreach($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{$semestre->id}}</option>
                @endforeach
            </select>
            <label>Semestre</label>
        </div>

        <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Registrar">
        </div>
    </form>
  </div>

  <div id="modalEditarEdificio" class="modal" style="padding:30px;overflow-y:scroll;">
    <form id="formEditar" method="POST" action="{{url('/escuela/registrarAlumnosGrupo/')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <h2 style="margin-bottom:25px;">Agregar alumnos</h2>
        <input type="hidden" name="id" id="id-editar">
      </div>

        
      <div class="input-field col s12">
        <select multiple name="id_usuarios[]">
            @foreach($alumnos as $alumno)
            <option value="{{$alumno->id}}">{{$alumno->matricula}}, {{$alumno->datosUsuario->nombre}} {{$alumno->datosUsuario->apellido_paterno}} {{$alumno->datosUsuario->apellido_materno}}</option>
            @endforeach
        </select>
        <label>Alumnos</label>
    </div>

      <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Guardar">
      </div>
    </form>
  </div>

  <div class="modal modal-fixed-footer" id="modalEliminarEdificio" style="padding:30px;max-height:200px;">
    <form id="formEliminar" action="{{url('/imprimir')}}" method="GET">
      {{csrf_field()}}
      <input type="hidden" name="id" id="id-eliminar">
      <h2>¿Imprimir reporte?</h2>

      <div class="modal-footer">
        <button class="waves-effect btn primary-color" type="submit" form="formEliminar" style="width:40%;margin:auto;">Sí</button>
        <a href="" class="modal-action modal-close waves-effect btn accent-color" style="width:35%;margin:auto;">
          Cancelar
        </a>
      </div>
    </form>
  </div>

  
@endsection