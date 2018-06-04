<div id="lista-semestres">
    @if( count($semestres) != 0 )
        @foreach($semestres as $semestre)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">school</i><div class="carreraNombre">{{$semestre->id}}: {{$semestre->fecha_inicial_parcial_1}} - {{$semestre->fecha_final_promedio}}</div>&nbsp;&nbsp;
                <a href="#modalEditarEdificio" class="modal-trigger"><i style="position:absolute;right:35px;" data-edificio-id="{{$semestre->id}}" class="material-icons right edit-semestre">edit</i></a>
                <a href="#modalEliminarEdificio" class="modal-trigger"><i style="position:absolute;right:0px;" data-edificio-id="{{$semestre->id}}" class="material-icons right delete-semestre">close</i></a>
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <div style="display:inline-block;">
                  <div class="col s12">Inicio parcial 1:&nbsp;<span class="inicioParcial1"> {{$semestre->fecha_inicial_parcial_1}}</span></div><br>
                  <div class="col s12">Fin parcial 1:&nbsp;<span class="finParcial1">{{$semestre->fecha_final_parcial_1}}</span></div><br>
                  <div class="col s12">Inicio parcial 2:&nbsp;<span class="inicioParcial2"> {{$semestre->fecha_inicial_parcial_2}}</span></div><br>
                  <div class="col s12">Fin parcial 2:&nbsp;<span class="finParcial2">{{$semestre->fecha_final_parcial_2}}</span></div><br>
                  <div class="col s12">Inicio parcial 3:&nbsp;<span class="inicioParcial3"> {{$semestre->fecha_inicial_parcial_3}}</span></div><br>
                  <div class="col s12">Fin parcial 3:&nbsp;<span class="finParcial3">{{$semestre->fecha_final_parcial_3}}</span></div><br>
                  <div class="col s12">Inicio entrega de promedios:&nbsp;<span class="inicioPromedio"> {{$semestre->fecha_inicial_promedio}}</span></div><br>
                  <div class="col s12">Fin entrega de promedios:&nbsp;<span class="finPromedio">{{$semestre->fecha_final_promedio}}</span></div><br>
                </div>
            </ul>
        @endforeach
      @else
        <div class="error">No se encontraron semestres registrados</div>
      @endif
</div>