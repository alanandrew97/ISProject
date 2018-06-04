<div id="lista-campus">
    @if( count($campuses) != 0 )
        @foreach($campuses as $campus)
            <ul class="collapsible"  data-collapsible="accordion">
            <li>
                <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">location_city</i><div class="campusNombre">{{$campus->nombre}}</div>
                <a href="#modalEditarCampus" class="modal-trigger"><i style="position:absolute;right:35px;" data-campus-id="{{$campus->id}}" class="material-icons right edit-campus">edit</i></a>
                <a href="#modalEliminarCampus" class="modal-trigger"><i style="position:absolute;right:0px;" data-campus-id="{{$campus->id}}" class="material-icons right delete-campus">close</i></a>
                </div>
                <div class="collapsible-body" style="padding: 20px;">
                <div class="col s12">Dirección: 
                <span class="campusDireccion" style="margin-bottom: 10px;" class="col s12">{{$campus->direccion}}</span></div><br>

                <div class="col s12">Carreras:</div><br>
                  @if(count($campus->carreras) != 0)
                  @foreach($campus->carreras as $carrera)
                  <div class="col s12"><span>{{$carrera->nombre}}</span></div><br>
                  @endforeach
                  @else
                  <div class="error">Aun no hay carreras registrados en este campus.</div>
                  @endif
            </li>
            </ul>
        @endforeach
    @else
    <div class="error">Aun no hay campus registrados en esta escuela.</div>
    @endif
</div>