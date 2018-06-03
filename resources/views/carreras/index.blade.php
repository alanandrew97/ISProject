@extends('layouts.app')

@section('title')
  Carreras
@endsection

@section('cabecera')
  Carreras
@endsection

@section('head')
  <script src="{{url('/js/escuela/escuela.js')}}"></script>
@endsection

@section('contenedor')
  <div class="row">
      <div class="input-field col s2">
      <h1>Carreras</h1>
      </div>

      <div class="col s10">
          <div class="input-field col s12 ">
              <i class="material-icons prefix">search</i>
              <input type="text" id="buscar-carrera" maxlength="70">
              <label for="buscar-carrera">Buscar carrera...</label>
          </div>
      </div>
    </div>
  <div class="row">
    <div class="col s12">

    @include('carreras.lista')


      <div class="fixed-action-btn">
        <a href="#modalNuevaCarrera" class="modal-trigger accent-color modal-close btn-floating btn-large">
          <i class="large material-icons">add</i>
        </a>
      </div>

    </div>
  </div>

@endsection

@section('modals')
  <div id="modalNuevaCarrera" class="modal" style="padding:20px;overflow-y:scroll;">
    <form id="form-crear" method="post" action="{{url('/escuela/crearCarrera')}}" class="col s12" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <h2 style="margin-bottom:25px;">Nueva carrera</h2>
        </div>

        <div class="row" id="imgNuevaCarreraContainer">

          <!-- <img src="" alt="Nueva Carrera" id="imgNuevaCarrera"> -->
        </div>

        <div class="row">
          <div class="file-field input-field col s12">
            <div class="btn">
              <span>Imagen</span>
              <input name="imagenCarrera" type="file" id="imagenCarrera">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s8 ">
            <input  id="nombre" name="nombre" type="text" maxlength="70" required>
            <label for="nombre">Nombre</label>
          </div>
          <div class="input-field col s4">
            <input  id="abreviatura" name="abreviatura" type="text" maxlength="20" required>
            <label for="abreviatura">Abreviatura</label>
          </div>
        </div>

        <div class="row">
          <div class="col s12 m6">
            <div class="input-field">
              <input type="number" id="totalCreditos" name="totalCreditos" required>
              <label for="totalCreditos">Total Créditos</label>
            </div>
          </div>
          <div class="col s12 m6">
            <div class="input-field">
              <input type="number" id="estructuraGenericaCreditos" name="estructuraGenericaCreditos" required>
              <label for="estructuraGenericaCreditos">Estructura Genérica Créditos</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m6">
            <input type="number" id="residenciaProfesionalCreditos" name="residenciaProfesionalCreditos" required>
            <label for="residenciaProfesionalCreditos">Residencia Profecional Créditos</label>
          </div>
          <div class="input-field col s12 m6">
            <input type="number" id="servicioSocialCreditos" name="servicioSocialCreditos" required>
            <label for="servicioSocialCreditos">Servicio Social Créditos</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m6">
            <input type="number" id="actividadesComplementariasCreditos" name="actividadesComplementariasCreditos" required>
            <label for="actividadesComplementariasCreditos">Actividades Complementarias Créditos</label>
          </div>
        </div>

        <h3 style="margin-bottom:25px;">Selecciona los campus en los que estará la carrera</h3>

        @foreach($campuses as $campus)
        <div class="row col s12">
          <input type="checkbox" id="myCheckbox{{$campus->id}}" class="filled-in" />
          <label for="myCheckbox{{$campus->id}}">{{$campus->nombre}}</label>
        </div>
        @endforeach

      <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Registrar">
        </div>
    </form>
  </div>

  <div id="modalEditarCarrera" class="modal" style="padding:30px;overflow-y:scroll;">
    <form id="formEditar" method="POST" action="{{url('/escuela/editarCarrera/')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <h2 style="margin-bottom:25px;">Editar carrera</h2>
        <input type="hidden" name="carreraId" id="carreraId">
      </div>

      <div class="row" id="imgEditarCarreraContainer">
        <img src="" alt="Editar imagen Carrera" id="imgEditarCarrera" style="height:100px;margin:auto;">
      </div>

      <div class="row">
        <div class="file-field input-field col s12">
          <div class="btn">
            <span>Imagen</span>
            <input name="ruta_imagen" type="file" id="ruta_imagen">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s8 ">
          <input  id="nombre" name="nombre" type="text" maxlength="70" required>
          <label for="nombre">Nombre</label>
        </div>
        <div class="input-field col s4">
          <input  id="abreviatura" name="abreviatura" type="text" maxlength="20" required>
          <label for="abreviatura">Abreviatura</label>
        </div>
      </div>

      <div class="row">
        <div class="col s12 m6">
          <div class="input-field">
            <input type="number" id="totalCreditos" name="totalCreditos" required>
            <label for="totalCreditos">Total Créditos</label>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="input-field">
            <input type="number" id="estructuraGenericaCreditos" name="estructuraGenericaCreditos" required>
            <label for="estructuraGenericaCreditos">Estructura Genérica Créditos</label>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6">
          <input type="number" id="residenciaProfesionalCreditos" name="residenciaProfesionalCreditos" required>
          <label for="residenciaProfesionalCreditos">Residencia Profecional Créditos</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="number" id="servicioSocialCreditos" name="servicioSocialCreditos" required>
          <label for="servicioSocialCreditos">Servicio Social Créditos</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6">
          <input type="number" id="actividadesComplementariasCreditos" name="actividadesComplementariasCreditos" required>
          <label for="actividadesComplementariasCreditos">Actividades Complementarias Créditos</label>
        </div>
      </div>

      <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Guardar">
      </div>
    </form>
  </div>

  <div class="modal modal-fixed-footer" id="modalEliminarCarrera" style="padding:30px;max-height:200px;">
    <form id="formEliminar" action="{{url('/escuela/eliminarCarrera')}}" method="POST">
      {{csrf_field()}}
      <input type="hidden" name="carrera_id" id="carrera_id">
      <h2>¿Desea eliminar esta carrera?</h2>
      <div class="modal-footer">
        <button class="waves-effect btn primary-color" type="submit" form="formEliminar" style="width:40%;margin:auto;">Sí</button>
        <a href="" class="modal-action modal-close waves-effect btn accent-color" style="width:35%;margin:auto;">
          Cancelar
        </a>
      </div>
    </form>
  </div>
@endsection