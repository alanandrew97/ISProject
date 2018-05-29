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
    <div class="col s12">
      @if( count($carreras) != 0 )
        @foreach($carreras as $carrera)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">school</i><div class="campusNombre">{{$carrera->nombre}} ({{$carrera->abreviatura}})</div>
                <a href="#modalEditarCarrera" class="modal-trigger"><i style="position:absolute;right:35px;" data-carrera-id="{{$carrera->id}}" class="material-icons right edit-carrera">edit</i></a>
                <a href="#modalEliminarCarrera" class="modal-trigger"><i style="position:absolute;right:0px;" data-carrera-id="{{$carrera->id}}" class="material-icons right delete-carrera">close</i></a>
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <img class="left" style="height:120px;margin-right:15px;" src="{{$carrera->ruta_imagen}}" alt="{{$carrera->nombre}}">
                <span class="totalCreditos" class="col s12">Total de créditos: {{$carrera->total_creditos}}</span><br>
                <span class="estructuraGenericaCreditos" class="col s12">Estructura Generica Créditos: {{$carrera->estructura_generica_creditos}}</span><br>
                <span class="residencia_profesional_creditos" class="col s12">Residencia Profesional Créditos: {{$carrera->residencia_profesional_creditos}}</span><br>
                <span class="servicio_social_creditos" class="col s12">Servicio Social Créditos: {{$carrera->servicio_social_creditos}}</span><br>
                <span class="actividades_complementarias_creditos" class="col s12">Actividades Complementarias Créditos: {{$carrera->actividades_complementarias_creditos}}</span><br><br>
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
  <div id="modalNuevaCarrera" class="modal" style="padding:20px;">
    <form id="form-crear" method="post" action="{{url('/escuela/crearCarrera')}}" class="col s12" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <h2 style="margin-bottom:25px;">Nueva carrera</h2>
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