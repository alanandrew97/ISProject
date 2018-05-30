@extends('layouts.app')

@section('title')
  Maestros
@endsection

@section('cabecera')
  Maestros
@endsection

@section('head')
  <script src="{{url('/js/usuario/usuario.js')}}"></script>
@endsection

@section('contenedor')
    <div class="row">
        <h1>Maestros</h1>
    </div>

    <div class="row">
        <div class="col s12">
            @if(count($maestros) != 0)
                @foreach($maestros as $maestro)
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header" style="position:relative;">
                                <i class="material-icons">school</i><div class="nombre">{{$maestro->datosUsuario->nombre}}&nbsp;&nbsp;</div><div class="carreraAbreviatura">{{$maestro->datosUsuario->apellido_paterno}}</div>
                                <a href="#modalEditarMaestro" class="modal-trigger"><i style="position:absolute;right:35px;" data-maestro-id="{{$maestro->id}}" class="material-icons right edit-maestro">edit</i></a>
                                <a href="#modalEliminarMaestro" class="modal-trigger"><i style="position:absolute;right:0px;" data-id-datos-usuario="{{$maestro->datosUsuario->id}}" class="material-icons right delete-maestro">close</i></a>
                            </div>
                            <div class="collapsible-body" style="padding: 20px;">
                                <div style="display:inline-block;">                  
                                    <input type="hidden" class="apellido_paterno" value="{{$maestro->datosUsuario->apellido_paterno}}">
                                    
                                    <input type="hidden" class="apellido_materno" value="{{$maestro->datosUsuario->apellido_materno}}">
                                    <div class="col s12">Nombre:&nbsp;<span class="nombrecompleto"> {{$maestro->datosUsuario->nombre}} {{$maestro->datosUsuario->apellido_paterno}}  {{$maestro->datosUsuario->apellido_materno}}</span></div><br>
                                    <div class="col s12">Correo:&nbsp;<span class="correo">{{$maestro->datosUsuario->correo}}</span></div><br>
                                    @if($maestro->administrador == 1)
                                    <div class="col s12">Administrador:&nbsp;<span class="estructuraGenericaCreditos">Sí</span></div><br>
                                    @else
                                    <div class="col s12">Administrador:&nbsp;<span class="estructuraGenericaCreditos">No</span></div><br>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </ul>
                @endforeach
            @else
                <div class="error">Aún no hay maestros registrados</div>
            @endif

            <div class="fixed-action-btn">
                <a href="#modalNuevoMaestro" class="modal-trigger accent-color modal-close btn-floating btn-large">
                <i class="large material-icons">add</i>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div id="modalNuevoMaestro" class="modal" style="padding:20px;overflow-y:scroll;">
        <form id="form-crear" method="post" action="{{url('/usuarios/registrar')}}" class="col s12" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
            <h2 style="margin-bottom:25px;">Nuevo maestro</h2>
            </div>
            
            <input type="hidden" name="rol" value="1">

            <div class="row">
                <div class="input-field col s12">
                    <input  id="nombre" name="nombre" type="text" maxlength="70" required>
                    <label for="nombre">Nombre</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input  id="apellido_paterno" name="apellido_paterno" type="text" maxlength="70" required>
                    <label for="apellido_paterno">Apellido paterno</label>
                </div>

                <div class="input-field col s6">
                    <input  id="apellido_materno" name="apellido_materno" type="text" maxlength="70" required>
                    <label for="apellido_materno">Apellido materno</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input  id="correo" name="correo" type="text" maxlength="70" required>
                    <label for="correo">Correo</label>
                </div>

                <div class="input-field col s6">
                    <input  id="password" name="password" type="password" maxlength="70" required>
                    <label for="password">Password</label>
                </div>
            </div>

            <div class="center" style="margin-bottom:30px;">
            <input type="checkbox" id="administrador" name="administrador" class="filled-in" />
            <label for="administrador">Administrador</label>
            </div>

            <div class="row">
            <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Registrar">
            </div>
        </form>
    </div>

<div id="modalEditarMaestro" class="modal" style="padding:30px;overflow-y:scroll;">
    <form id="formEditar" method="POST" action="{{url('/usuarios/editar/')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
        <h2 style="margin-bottom:25px;">Editar maestro</h2>
        <input type="hidden" name="id" id="id">
      </div>

      <input type="hidden" name="rol" value="1">

<div class="row">
    <div class="input-field col s12">
        <input  id="nombre" name="nombre" type="text" maxlength="70" required>
        <label for="nombre">Nombre</label>
    </div>
</div>

<div class="row">
    <div class="input-field col s6">
        <input  id="apellido_paterno" name="apellido_paterno" type="text" maxlength="70" required>
        <label for="apellido_paterno">Apellido paterno</label>
    </div>

    <div class="input-field col s6">
        <input  id="apellido_materno" name="apellido_materno" type="text" maxlength="70" required>
        <label for="apellido_materno">Apellido materno</label>
    </div>
</div>

<div class="row">
    <div class="input-field col s6">
        <input  id="correo" name="correo" type="text" maxlength="70" required>
        <label for="correo">Correo</label>
    </div>

    <div class="input-field col s6">
        <input  id="password" name="password" type="password" maxlength="70" required>
        <label for="password">Password</label>
    </div>
</div>

      <div class="row">
          <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Guardar">
      </div>
    </form>
  </div>

  <div class="modal modal-fixed-footer" id="modalEliminarMaestro" style="padding:30px;max-height:200px;">
    <form method="post"id="formEliminar" action="{{url('/usuarios/eliminar')}}">
      {{csrf_field()}}
      <input type="hidden" name="id_datos_usuario" id="iddatosusuario">
      <h2>¿Desea eliminar a este maestro?</h2>
      <div class="modal-footer">
        <a href="" class="modal-action modal-close waves-effect btn accent-color" style="width:35%;margin:auto;">
          Cancelar
        </a>
        <input class="waves-effect btn primary-color" type="submit" value="Sí" style="width:40%;margin:auto;">
      </div>
    </form>
  </div>
@endsection

