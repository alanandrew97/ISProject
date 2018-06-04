@extends('layouts.app')

@section('title')
  Alumnos
@endsection

@section('cabecera')
  Alumnos
@endsection

@section('head')
  <script src="{{url('/js/grupos/grupos.js')}}"></script>
@endsection

@section('contenedor')
  <div class="row">
    <h1>Estadísticas por alumno</h1>
  </div>
  <div class="row">
    <div class="col s12">
      @if( count($grupos) != 0 )
        @foreach ( $grupos as $grupo )
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">insert_chart</i>&nbsp;Grupo: &nbsp;{{$grupo->clave}}&nbsp;{{$grupo->materia->nombre}}&nbsp;{{$grupo->maestro->nombre}}&nbsp;{{$grupo->maestroApellido}}
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <div>
                  {{isset($grupo->alumnosGrupo)}}
                  @if (count($grupo->alumnosGrupo)!=0)
                    @foreach($grupo->alumnosGrupo as $alumnoGrupo)
                      <div>
                        @if (isset($alumnoGrupo->alumno))
                          Alumno: <a class="modal-trigger modalGraficaAlumno" href="#modalGraficaAlumno" data-graphic-labels="{{json_encode($alumnoGrupo['labels'])}}" data-graphic-data="{{ json_encode($alumnoGrupo['data']) }}">
                          {{$alumnoGrupo->alumno->datosUsuario->nombre.' '.$alumnoGrupo->alumno->datosUsuario->apellido_paterno.' '.$alumnoGrupo->alumno->datosUsuario->apellido_materno}}
                          <i class="material-icons">insert_chart</i></a>
                        @endif
                      </div>
                    @endforeach
                  @else
                    <div class="error">Aun no hay alumnos asignados a este grupo.</div>
                  @endif
                </div>
              </div>
            </li>
          </ul>
            {{--dd($grupos)--}}
        @endforeach
      @else
        <div class="error">Aun no hay grupos registrados.</div>
      @endif

      

    </div>
  </div>

@endsection

@section('modals')

  <div class="modal" id="modalGraficaAlumno" style="padding:30px;">
    <div class="modal-content" >
      <center>
        <canvas id="graficaAlumno" style="max-height:525px;" width="200" height="200"></canvas>
      </center>
    </div>
  </div>


@endsection