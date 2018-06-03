<div id="lista-carreras">
@if( count($carreras) != 0 )
        @foreach($carreras as $carrera)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">school</i><div class="carreraNombre">{{$carrera->nombre}}</div>&nbsp;&nbsp;(<div class="carreraAbreviatura">{{$carrera->abreviatura}}</div>)
                <a href="#modalEditarCarrera" class="modal-trigger"><i style="position:absolute;right:35px;" data-carrera-id="{{$carrera->id}}"  data-campus="{{$carrera->campus}}" class="material-icons right edit-carrera">edit</i></a>
                <a href="#modalEliminarCarrera" class="modal-trigger"><i style="position:absolute;right:0px;" data-carrera-id="{{$carrera->id}}" class="material-icons right delete-carrera">close</i></a>
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <img class="left imgCarrera" style="height:120px;margin-right:15px;" src="{{$carrera->ruta_imagen}}" alt="{{$carrera->nombre}}">
                <div style="display:inline-block;">
                  <div class="col s12">Total de créditos:&nbsp;<span class="totalCreditos"> {{$carrera->total_creditos}}</span></div><br>
                  <div class="col s12">Estructura Generica Créditos:&nbsp;<span class="estructuraGenericaCreditos">{{$carrera->estructura_generica_creditos}}</span></div><br>
                  <div class="col s12">Residencia Profesional Créditos:&nbsp;<span class="residencia_profesional_creditos">{{$carrera->residencia_profesional_creditos}}</span></div><br>
                  <div class="col s12">Servicio Social Créditos:&nbsp;<span class="servicio_social_creditos">{{$carrera->servicio_social_creditos}}</span></div><br>
                  <div class="col s12">Actividades Complementarias Créditos:&nbsp;<span class="actividades_complementarias_creditos">{{$carrera->actividades_complementarias_creditos}}</span></div><br>

                  <div class="col s12">Campus en los que se encuentra:</div><br>
                  @if(count($carrera->campus) != 0)
                  @foreach($carrera->campus as $campus)
                  <div class="col s12"><span>{{$campus->nombre}}</span></div><br>
                  @endforeach
                  @else
                  <div class="error">Aun no hay campus registrados en esta carrera.</div>
                  @endif

                  <div class="col s12">Reticulas:</div><br>
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
</div>