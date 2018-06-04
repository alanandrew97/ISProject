<div id="lista-materias">
    @if( count($materias) != 0 )
        @foreach($materias as $materia)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">school</i><div>{{$materia->nombre}}</div>&nbsp;&nbsp;
                <a href="#modalEditarEdificio" class="modal-trigger"><i style="position:absolute;right:35px;" data-edificio-id="{{$materia->id}}" class="material-icons right edit-materia">edit</i></a>
                <a href="#modalEliminarEdificio" class="modal-trigger"><i style="position:absolute;right:0px;" data-edificio-id="{{$materia->id}}" class="material-icons right delete-materia">close</i></a>
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <div style="display:inline-block;">
                  <div class="col s12">Nombre:&nbsp;<span class="nombre"> {{$materia->nombre}}</span></div><br>
                  <div class="col s12">Clave:&nbsp;<span class="clave">{{$materia->clave}}</span></div><br>
                  <div class="col s12">Horas teoria:&nbsp;<span class="horasTeoria"> {{$materia->horas_teoria}}</span></div><br>
                  <div class="col s12">Horas practica:&nbsp;<span class="horasPractica">{{$materia->horas_practica}}</span></div><br>
                  <div class="col s12">Créditos:&nbsp;<span class="creditos">{{$materia->creditos}}</span></div><br>
                </div>
                </div>
            </li>
        </ul>

        @endforeach
      @else
        <div class="error">Aun no hay materias registradas en esta escuela.</div>
      @endif
</div>