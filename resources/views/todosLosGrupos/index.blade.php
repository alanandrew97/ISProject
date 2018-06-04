@extends('layouts.app')

@section('title')
  Todos los grupos
@endsection

@section('cabecera')
  Todos los grupos
@endsection

@section('head')
  <script src="{{url('/js/edificio/edificio.js')}}"></script>
@endsection

@section('contenedor')
<div class="row">
    <div class="input-field col s2">
      <h1>Todos los grupos</h1>
      </div>

    <div class="col s10">
          <div class="input-field col s12 ">
              <i class="material-icons prefix">search</i>
              <input type="text" id="buscar-todos-los-grupos" maxlength="70">
              <label for="buscar-todos-los-grupos">Buscar grupo...</label>
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col s12">
      
      @include('todosLosGrupos.lista')

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
                    <option value="{{ $maestro->id }}">{{$maestro->datosUsuario->nombre}} {{$maestro->datosUsuario->apellido_paterno}} {{$maestro->datosUsuario->apellido_materno}}</option>
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

  <div id="modalEditarGrupo" class="modal" style="padding:30px;overflow-y:scroll;">
    <form id="formEditar" method="POST" action="{{url('/escuela/editarGrupo/')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <h2 style="margin-bottom:25px;">Editar grupo</h2>
        <input type="hidden" name="id" id="id-editar">
      </div>

      
        <div class="input-field col s12">
            <input  id="clave" name="clave" type="number" maxlength="70" required>
            <label for="clave">Clave</label>
        </div>
        
        <div class="input-field col s12">
            <select id="materia" name="id_materia" class="select-wrapper">
                @foreach($materias as $materia)
                    <option value="{{ $materia->id }}">{{$materia->nombre}}</option>
                @endforeach
            </select>
            <label>Materia</label>
        </div>

        <div class="input-field col s12">
            <select id="maestro" name="id_maestro" class="select-wrapper">
                @foreach($maestros as $maestro)
                    <option value="{{ $maestro->id }}">{{$maestro->datosUsuario->nombre}} {{$maestro->datosUsuario->apellido_paterno}} {{$maestro->datosUsuario->apellido_materno}}</option>
                @endforeach
            </select>
            <label>Maestro</label>
        </div>

        <div class="input-field col s12">
            <select id="aula" name="id_aula" class="select-wrapper">
                @foreach($aulas as $aula)
                    <option value="{{ $aula->id }}">{{$aula->numero}}</option>
                @endforeach
            </select>
            <label>Aula</label>
        </div>

        
        <div class="input-field col s12">
            <select id="semestre" name="id_semestre" class="select-wrapper">
                @foreach($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{$semestre->id}}</option>
                @endforeach
            </select>
            <label>Semestre</label>
        </div>

       

      <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Guardar">
      </div>
    </form>
  </div>

  <div id="modalAgregarAlumnos" class="modal" style="padding:30px;overflow-y:scroll;">
    <form id="formEditar" method="POST" action="{{url('/escuela/registrarAlumnosGrupo/')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <h2 style="margin-bottom:25px;">Lista de alumnos</h2>
        <input type="hidden" name="id" id="id-agregaralumnos">
      </div>

        
        <?php $index = 0; ?>
        @foreach($alumnos as $alumno)
          <div class="row col s12">
            <input type="checkbox" value="{{$alumno->id}}" id="checkAlumnos{{$index}}" name="alumnos[]" class="filled-in" />
            <label for="checkAlumnos{{$index}}">{{$alumno->datosUsuario->nombre}} {{$alumno->datosUsuario->apellido_paterno}} {{$alumno->datosUsuario->apellido_materno}} - {{$alumno->matricula}} </label>
            <?php $index++ ?>
          </div>
        @endforeach

      <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Guardar">
      </div>
    </form>
  </div>

  <div class="modal modal-fixed-footer" id="modalEliminarEdificio" style="padding:30px;max-height:200px;">
    <form id="formEliminar" action="{{url('/escuela/eliminarGrupo')}}" method="POST">
      {{csrf_field()}}
      <input type="hidden" name="id" id="id-eliminar">
      <h2>¿Eliminar grupo?</h2>

      <div class="modal-footer">
        <button class="waves-effect btn primary-color" type="submit" form="formEliminar" style="width:40%;margin:auto;">Sí</button>
        <a href="" class="modal-action modal-close waves-effect btn accent-color" style="width:35%;margin:auto;">
          Cancelar
        </a>
      </div>
    </form>
  </div>

  
@endsection