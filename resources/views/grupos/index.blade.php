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

        {{strtotime($grupo->semestre->fecha_inicial_parcial_1)}}
          <ul class="collapsible">
            <li>
              <div class="collapsible-header" style="position:relative;">
                <i class="material-icons">insert_chart</i>&nbsp;Grupo: &nbsp;{{$grupo->clave}}&nbsp;{{$grupo->materia->nombre}}&nbsp;{{$grupo->maestro->datosUsuario->nombre}}&nbsp;{{$grupo->maestro->datosUsuario->apellido_paterno}}&nbsp;{{$grupo->maestro->datosUsuario->apellido_materno}}
                @if (session('rol')==1)
                <a href="#modalImprimirReporte" class="modal-trigger"><i style="position:absolute;right:35px;" data-grupo-id="{{$grupo->id}}" class="material-icons right">print</i></a>
                @endif
              </div>
              <div class="collapsible-body" style="padding: 20px;">
                <a href="#modalGraficaGrupo" data-graphic-labels="{{json_encode($grupo['labels'])}}" data-graphic-data="{{ json_encode($grupo['data']) }}" class="modal-trigger modalGraficaGrupo"><i class="material-icons">insert_chart</i>&nbsp;<h5 style="display:inline-block;">Ver gráfica</h5></a><br>
                <a href="#modalRegistrarCalificaciones" data-alumnos="{{$grupo->alumnos}}" class="modal-trigger modalGraficaGrupo"><i class="material-icons">playlist_add_check</i>&nbsp;<h5 style="display:inline-block;">Registrar calificaciones</h5></a>
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

  <div class="modal" id="modalRegistrarCalificaciones" style="padding:20px;max-height:400px; overflow-y: scroll">
      <table class="striped">
        <thead>
          <tr>
              <th>Alumno</th>
              <th>Primer parcial</th>
              <th>Segundo parcial</th>
              <th>Tercer parcial</th>
              <th>Desertor</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Alvin</td>
            <td>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Calificación</label>
              </div>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Faltas</label>
              </div>
            </td>
            <td>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Calificación</label>
              </div>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Faltas</label>
              </div>
            </td>
            <td>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Calificación</label>
              </div>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Faltas</label>
              </div>
            </td>
            <td>
            <center>
            <input type="checkbox" value="" id="checkCampus" name="campuses[]" class="filled-in" />
            <label for="checkCampus"></label>
            </center>
            </td>
          </tr>

          <tr>
            <td>Alan</td>
            <td>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Calificación</label>
              </div>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Faltas</label>
              </div>
            </td>
            <td>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Calificación</label>
              </div>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Faltas</label>
              </div>
            </td>
            <td>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Calificación</label>
              </div>
              <div class="input-field col s12">
                <input id="holi" type="text">
                <label for="holi">Faltas</label>
              </div>
            </td>
            
            <td>
            <center>
            <input type="checkbox" value="" id="checkCampus1" name="campuses[]" class="filled-in" />
            <label for="checkCampus1"></label>
            </center>
            </td>
          </tr>
        </tbody>
      </table>
  </div>


@endsection