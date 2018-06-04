<div id="lista-maestros">
    @if(count($maestros) != 0)
        @foreach($maestros as $maestro)
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header" style="position:relative;">
                        <i class="material-icons">school</i><div class="nombre">{{$maestro->datosUsuario->nombre}}&nbsp;&nbsp;</div><div class="carreraAbreviatura">{{$maestro->datosUsuario->apellido_paterno}}</div>
                        <a href="#modalEditarMaestro" class="modal-trigger"><i style="position:absolute;right:35px;" data-id-datos-usuario="{{$maestro->datosUsuario->id}}" data-apellido-paterno="{{$maestro->datosUsuario->apellido_paterno}}" data-apellido-materno="{{$maestro->datosUsuario->apellido_materno}}" class="material-icons right edit-maestro">edit</i></a>
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

</div>