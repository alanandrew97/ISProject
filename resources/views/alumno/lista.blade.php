<div id="lista-alumnos">
    @if(count($alumnos) != 0)
        @foreach($alumnos as $alumno)
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header" style="position:relative;">
                        <i class="material-icons">school</i><div class="nombre">{{$alumno->datosUsuario->nombre}} {{$alumno->datosUsuario->apellido_paterno}} {{$alumno->datosUsuario->apellido_materno}} &nbsp;&nbsp;</div><div class="carreraAbreviatura">{{$alumno->matricula}}</div>
                        <a href="#modalEditarMaestro" class="modal-trigger"><i style="position:absolute;right:35px;" data-id-datos-usuario="{{$alumno->datosUsuario->id}}" data-nombre="{{$alumno->datosUsuario->nombre}}" data-apellido-paterno="{{$alumno->datosUsuario->apellido_paterno}}" data-apellido-materno="{{$alumno->datosUsuario->apellido_materno}}" data-correo="{{$alumno->datosUsuario->correo}}" data-matricula="{{$alumno->matricula}}" data-semestre="{{$alumno->semestre}}" data-id-carrera="{{$alumno->id_carrera}}" data-id-turno="{{$alumno->id_turno}}" class="material-icons right edit-alumno">edit</i></a>
                        <a href="#modalEliminarMaestro" class="modal-trigger"><i style="position:absolute;right:0px;" data-id-datos-usuario="{{$alumno->datosUsuario->id}}" class="material-icons right delete-alumno">close</i></a>
                    </div>
                    <div class="collapsible-body" style="padding: 20px;">
                        <div style="display:inline-block;">                  
                            <input type="hidden" class="apellido_paterno" value="{{$alumno->datosUsuario->apellido_paterno}}">
                            <input type="hidden" class="apellido_materno" value="{{$alumno->datosUsuario->apellido_materno}}">

                            <div class="col s12">Nombre:&nbsp;<span class="nombrecompleto"> {{$alumno->datosUsuario->nombre}} {{$alumno->datosUsuario->apellido_paterno}}  {{$alumno->datosUsuario->apellido_materno}}</span></div><br>
                            <div class="col s12">Correo:&nbsp;<span class="correo">{{$alumno->datosUsuario->correo}}</span></div><br>
                            <div class="col s12">Matricula:&nbsp;<span class="correo">{{$alumno->matricula}}</span></div><br>
                            <div class="col s12">Carrera:&nbsp;<span class="correo">{{$alumno->carrera->nombre}}</span></div><br>
                            <div class="col s12">Semestre:&nbsp;<span class="correo">{{$alumno->semestre}}</span></div><br>
                            
                        </div>
                    </div>
                </li>
            </ul>
        @endforeach
    @else
        <div class="error">Aún no hay alumnos registrados</div>
    @endif
</div>