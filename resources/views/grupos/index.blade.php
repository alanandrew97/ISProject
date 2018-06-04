@extends('layouts.app')

@section('title')
  Grupos
@endsection

@section('cabecera')
  Grupos
@endsection

@section('head')
  <script src="{{url('/js/grupos/grupos.js')}}"></script>
@endsection

@section('contenedor')
  <div class="row">
    <h1>Grupos</h1>
  </div>
  <div class="row">
    <div class="col s12">
      @if( count($grupos) != 0 )
        @foreach($grupos as $grupo)
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">insert_chart</i>&nbsp;Grupo: &nbsp;{{$grupo->clave}}&nbsp;{{$grupo->materia->nombre}}&nbsp;{{$grupo->maestro->datosUsuario->nombre}}&nbsp;{{$grupo->maestro->datosUsuario->apellido_paterno}}&nbsp;{{$grupo->maestro->datosUsuario->apellido_materno}}
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <a href="#modalGraficaGrupo" data-graphic-labels="{{json_encode($grupo['labels'])}}" data-graphic-data="{{ json_encode($grupo['data']) }}" class="modal-trigger modalGraficaGrupo"><i class="material-icons">insert_chart</i>&nbsp;<h5 style="display:inline-block;">Ver gráfica</h5></a>
                <div>
                  @if (count($grupo->alumnos)!=0)
                    @foreach($grupo->alumnos as $alumno)
                      <div>
                        Alumno: <i class="material-icons" style="margin-right:10px;color:white;">school</i>{{$alumno->datosUsuario->nombre}} {{$alumno->datosUsuario->apellido_paterno}} {{$alumno->datosUsuario->apellido_materno}}
                      </div>
                    @endforeach
                  @else
                    <div class="error">Aun no hay alumnos asignados a este grupo.</div>
                  @endif
                </div>
              </div>
            </li>
          </ul>
        @endforeach
      @else
        <div class="error">Aun no hay grupos registrados.</div>
      @endif

      

    </div>
  </div>

@endsection

@section('modals')

  <div class="modal" id="modalGraficaGrupo" style="padding:30px;">
    <div class="modal-content" >
      <center>
        <canvas id="graficaGrupo" style="max-height:525px;" width="200" height="200"></canvas>
      </center>
    </div>
  </div>


@endsection