<div id="lista-campus">
    @if( count($campuses) != 0 )
        @foreach($campuses as $campus)
            <ul class="collapsible">
            <li>
                <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">location_city</i><div class="campusNombre">{{$campus->nombre}}</div>
                <a href="#modalEditarCampus" class="modal-trigger"><i style="position:absolute;right:35px;" data-campus-id="{{$campus->id}}" class="material-icons right edit-campus">edit</i></a>
                <a href="#modalEliminarCampus" class="modal-trigger"><i style="position:absolute;right:0px;" data-campus-id="{{$campus->id}}" class="material-icons right delete-campus">close</i></a>
                </div>
                <div class="collapsible-body" style="padding: 20px;">
                <span class="campusDireccion" style="margin-bottom: 10px;" class="col s12">{{$campus->direccion}}</span>
            </li>
            </ul>
        @endforeach
    @else
    <div class="error">Aun no hay campus registrados en esta escuela.</div>
    @endif
</div>