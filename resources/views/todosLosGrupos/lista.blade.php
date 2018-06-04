<div id="lista-todos-los-grupos">
@if( count($grupos) != 0 )
        @foreach($grupos as $grupo)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">school</i><div class="carreraNombre">{{$grupo->clave}}</div>&nbsp;&nbsp;
                <a href="#modalAgregarAlumnos" class="modal-trigger"><i style="position:absolute;right:105px;" data-edificio-id="{{$grupo->id}}" data-alumnos="{{$grupo->alumnos}}" class="material-icons right alumnos-grupo">add</i></a>
                <a href="#modalGrafica" class="modal-trigger"><i style="position:absolute;right:70px;" data-edificio-id="{{$grupo->id}}" class="material-icons right grafica-grupo">insert_chart</i></a>
                <a href="#modalEditarGrupo" class="modal-trigger"><i style="position:absolute;right:35px;" data-edificio-id="{{$grupo->id}}" class="material-icons right edit-grupo">edit</i></a>
                <a href="#modalEliminarEdificio" class="modal-trigger"><i style="position:absolute;right:0px;" data-edificio-id="{{$grupo->id}}" class="material-icons right delete-grupo">close</i></a>

              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <div style="display:inline-block;">
                  <div class="col s12">Clave:&nbsp;<span class="clave"> {{$grupo->clave}}</span></div><br>
                  
                  @if(!is_null($grupo->materia))
                  <input type="hidden" class="idMateria" value="{{$grupo->materia->id}}">
                  <div class="col s12">Materia:&nbsp;<span class="estructuraGenericaCreditos">{{$grupo->materia->nombre}}</span></div><br>
                  @endif
                  
                  @if(!is_null($grupo->maestro))
                  <input type="hidden" class="idMaestro" value="{{$grupo->maestro->id}}">
                  <div class="col s12">Maestro:&nbsp;<span class="estructuraGenericaCreditos">{{$grupo->maestro->datosUsuario->nombre}} {{$grupo->maestro->datosUsuario->apellido_paterno}} {{$grupo->maestro->datosUsuario->apellido_materno}}</span></div><br>
                  @endif

                  @if(!is_null($grupo->aula))
                  <input type="hidden" class="idAula" value="{{$grupo->aula->id}}">
                  <div class="col s12">Edificio:&nbsp;<span class="estructuraGenericaCreditos">{{$grupo->aula->edificio->nombre}}</span></div><br>
                  <div class="col s12">Aula:&nbsp;<span class="estructuraGenericaCreditos">{{$grupo->aula->numero}}</span></div><br>
                  @endif

                  @if(!is_null($grupo->semestre))
                  <input type="hidden" class="idSemestre" value="{{$grupo->semestre->id}}">
                  <div class="col s12">Semestre:&nbsp;<span class="estructuraGenericaCreditos">{{$grupo->semestre->fecha_inicial_parcial_1}} - {{$grupo->semestre->fecha_final_promedio}}</span></div><br>
                  @endif

                  @if(count($grupo->alumnosGrupo) != 0)
                  <div class="col s12">Alumnos:&nbsp;</div><br>
                  <ul>
                    @foreach($grupo->alumnosGrupo as $registro)
                    @if(!is_null($registro))
                      @if(!is_null($registro->alumno))
                        <li>
                        <div class="col s12">Nombre:&nbsp;<span class="totalCreditos">{{$registro->alumno->datosUsuario->nombre}} {{$registro->alumno->datosUsuario->apellido_paterno}} {{$registro->alumno->datosUsuario->apellido_materno}} Matricula: {{$registro->alumno->matricula}}</span></div><br>
                        </li>
                      @endif
                    @endif
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
</div>