<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .letter {
            font-size: 13px;
        }
    </style>
    <title>Alumnos</title>
</head>

<body>
<center>
<table width="100%" style="margin=0px">

    <tr>
        <td>
            <img src="{{url('img/seplogo.jpg')}}" style="width:200px; height:100px">
        </td>
        <td>
             <h4>Lista de alumnos para grupo {{$grupo->clave}}</h4>
        </td>
        <td>
            <img src="{{$escuela->ruta_imagen}}" style="width:80px; height:80px">
        </td>
    </tr>
</table>

<table width="100%" style="margin=0px" border="0.02">
    <tr><th>Nombre</th>
    <th>Matricula</th>
    <th>Carrera</th>
    <th>Semestre</th>
    <th>Turno</th>
    <th>Correo</th></tr>
    @foreach($alumnos as $alumno)
    <tr>
        <td>{{$alumno->datosUsuario->nombre}} {{$alumno->datosUsuario->apellido_paterno}} {{$alumno->datosUsuario->apellido_materno}}</td>
        <td>{{$alumno->matricula}}</td>
        <td>{{$alumno->carrera->nombre}}</td>
        <td>{{$alumno->semestre}}</td>
        <td>{{$alumno->turno->nombre}}</td>
        <td>{{$alumno->datosUsuario->correo}}</td>
    </tr>
    @endforeach
</table>

</center>

<h6>Materia: {{$grupo->materia->nombre}}</h6>
<h6>Maestro: {{$grupo->maestro->datosUsuario->nombre}} {{$grupo->maestro->datosUsuario->apellido_paterno}} {{$grupo->maestro->datosUsuario->apellido_materno}}</h6>
<h6>Aula: {{$grupo->aula->numero}}</h6>
<h6>Aprobados: {{$grupo->registro->aprobados}}</h6>
<h6>Reprobados: {{$grupo->registro->reprobados}}</h6>


</body>

</html>