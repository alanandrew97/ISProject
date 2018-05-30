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
                <i class="material-icons">insert_chart</i>&nbsp;Grupo: &nbsp;{{$grupo->clave}}&nbsp;{{$grupo->materia->nombre}}&nbsp;{{$grupo->maestro->nombre}}&nbsp;{{$grupo->maestro->apellido_paterno}}
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <a href="#modalGraficaGrupo" data-grahicData="{{$grupo['data']}}" class="modal-trigger modalGraficaGrupo"><i class="material-icons large">insert_chart</i>&nbsp;<h5>Ver gráfica</h5></a>
                <div>
                  @if (count($grupo->alumnos)!=0)
                    @foreach($grupo->alumnos as $alumno)
                      <div>
                        Hola{{--<a class="" href="{{url('escuelas/carrera/'.$reticula->id)}}"><i class="material-icons" style="margin-right:10px;color:white;">school</i>{{$reticula->nombre}}</a>--}}
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

      <div class="fixed-action-btn">
        <a href="#modalNuevaCarrera" class="modal-trigger accent-color modal-close btn-floating btn-large">
          <i class="large material-icons">add</i>
        </a>
      </div>

    </div>
  </div>

@endsection

@section('modals')

  <div class="modal" id="modalGraficaGrupo" style="padding:30px;">
    <center>
      <canvas id="graficaGrupo" width="400" height="400"></canvas>
    </center>
  </div>


@endsection