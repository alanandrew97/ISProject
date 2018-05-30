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
    <h1>Carreras</h1>
  </div>
  <div class="row">
    <div class="col s12">
      @if( count($carreras) != 0 )
        @foreach($carreras as $carrera)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">school</i><div class="carreraNombre">{{$carrera->nombre}}</div>&nbsp;&nbsp;(<div class="carreraAbreviatura">{{$carrera->abreviatura}}</div>)
                <a href="#modalEditarCarrera" class="modal-trigger"><i style="position:absolute;right:35px;" data-carrera-id="{{$carrera->id}}" class="material-icons right edit-carrera">edit</i></a>
                <a href="#modalEliminarCarrera" class="modal-trigger"><i style="position:absolute;right:0px;" data-carrera-id="{{$carrera->id}}" class="material-icons right delete-carrera">close</i></a>
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <img class="left imgCarrera" style="height:120px;margin-right:15px;" src="{{$carrera->ruta_imagen}}" alt="{{$carrera->nombre}}">
                <div style="display:inline-block;">
                  <div class="col s12">Total de créditos:&nbsp;<span class="totalCreditos"> {{$carrera->total_creditos}}</span></div><br>
                  <div class="col s12">Estructura Generica Créditos:&nbsp;<span class="estructuraGenericaCreditos">{{$carrera->estructura_generica_creditos}}</span></div><br>
                  <div class="col s12">Residencia Profesional Créditos:&nbsp;<span class="residencia_profesional_creditos">{{$carrera->residencia_profesional_creditos}}</span></div><br>
                  <div class="col s12">Servicio Social Créditos:&nbsp;<span class="servicio_social_creditos">{{$carrera->servicio_social_creditos}}</span></div><br>
                  <div class="col s12">Actividades Complementarias Créditos:&nbsp;<span class="actividades_complementarias_creditos">{{$carrera->actividades_complementarias_creditos}}</span></div><br><br>
                  @if (count($carrera->reticulas)!=0)
                    @foreach($carrera->reticulas as $reticula)
                      <div>
                        <a class="" href="{{url('escuelas/carrera/'.$reticula->id)}}"><i class="material-icons" style="margin-right:10px;color:white;">school</i>{{$reticula->nombre}}</a>
                      </div>
                    @endforeach
                  @else
                    <div class="error">Aun no hay retículas registradas en esta carrera.</div>
                  @endif
                </div>
              </div>
            </li>
          </ul>
        @endforeach
      @else
        <div class="error">Aun no hay carreras registradas en esta escuela.</div>
      @endif

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