<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .letter {
            font-size: 13px;
        }
    </style>
    <title>Alumnos</title>
    <style>
        th, td {
            border: 1px solid black;
        }
        tr {
            height:25px;
        }
    </style>
</head>

<body>
<center>
    <table width="100%" style="margin=0px">
        <tr>
            <td>
                <img src="{{url('img/seplogo.jpg')}}" style="width:200px; height:100px">
            </td>
            <td>
                <h3 style="margin:0;margin-top:20px;">INSTITUTO TECNOLOGICO DE LEON</h3>
                <h4 style="margin:0;">DIVISION DE ESTUDIOS PROFESIONALES</h4>
                <h5 style="margin-top:10px;">Este reporte estará disponible hasta el cierre de bajas.</h5>
            </td>
            <td>
                <img src="{{$escuela->ruta_imagen}}" style="width:80px; height:80px">
            </td>
        </tr>
    </table>
</center>

<table style="width:50%;display:inline-block;margin-left:20px;">
    <tr>
        <td>Catedrático:</td>
        <td>{{$grupo->maestro->datosUsuario->nombre}} {{$grupo->maestro->datosUsuario->apellido_paterno}} {{$grupo->maestro->datosUsuario->apellido_materno}}</td>
        <td></td>
    </tr>
    <tr>
        <td>Asignatura:</td>
        <td>{{$grupo->materia->nombre}}</td>
        <td></td>
    </tr>
    <tr>
        <td>Carrera:</td>
        <td>INGENIERIA EN SISTEMAS COMPUTACIONALES</td>
        <td></td>
    </tr>
    <tr>
        <td>Clave Grupo:</td>
        <td>{{$grupo->clave}}</td>
        <td>Campus:</td>
        <td>{{$grupo->alumnos[0]->carrera->campus[0]->nombre}}</td>
    </tr>
</table>

<div style="border: 1px solid #000; border-top:3px solid #000; margin:10px; font-size:13px;" class="contenedor">
    <div class="seccion" style="vertical-align:top;">
        <h3>1. Cobertura del curso</h3>
        <div style="display:inline-block; width:40%;padding-left:20px;">
            <p>TOTAL DE UNIDADES DEL PROGRAMA</p>
            <p>UNIDADES PROGRAMADAS PARA CUBRISRSE A LA FECHA</p>
            <p>UNIDADES CUBIERTAS A LA FECHA</p>
            <p>UNIDADES EVALUADAS, CALIFICADAS Y ENTREGADAS</p>
        </div>
        <div style="display:inline-block;width:10%;">
            <p>Num</p>
            <p>3</p>
            <p></p>
            <p><input type="number" style="width:40px;"></p>
            <p><input type="number" style="width:40px;"></p>
        </div>
        <div style="display:inline-block;width:10%;vertical-align:top;">
            <p>%</p>
            <p><input type="number" style="width:40px;"></p>
            <p><input type="number" style="width:40px;"></p>
            <p></p>
            <p></p>
        </div>
    </div>
    <div class="seccion">
        <h3>2. Indices de reprobación y deserción</h3>
        <div style="display:inline-block; width:30%;padding-left:20px;">
            <p>ALUMNOS INSCRITOS</p>
            <p>ALUMNOS APROBADOS</p>
            <p>ALUMNOS NO APROBADOS</p>
        </div>
        <div style="display:inline-block;width:10%;">
            <p>Num</p>
            <p>{{$grupo->registro->total_alumnos}}</p>
            <p>{{$grupo->registro->aprobados}}</p>
            <p>{{$grupo->registro->reprobados}}</p>
        </div>
        <div style="display:inline-block;width:10%;vertical-align:bottom;">
            <p>%</p>
            <p>{{(100/$grupo->registro->total_alumnos)*$grupo->registro->aprobados}}</p>
            <p>{{(100/$grupo->registro->total_alumnos)*$grupo->registro->reprobados}}</p>
            <p></p>
            <p></p>
        </div>
        <div style="display:inline-block;width:20%;vertical-align:bottom;">
            <p>POR REPROBACION</p>
            <p>POR DESERCION</p>
        </div>
        <div style="display:inline-block;width:10%;vertical-align:bottom;">
            <p>Num</p>
            <p>{{$grupo->registro->reprobados-$grupo->registro->desertores}}</p>
            <p>{{$grupo->registro->desertores}}</p>
        </div>
        <div style="display:inline-block;width:10%;vertical-align:bottom;">
            <p>%</p>
            <p>{{(100/$grupo->registro->reprobados)*($grupo->registro->reprobados-$grupo->registro->desertores)}}</p>
            <p>{{(100/$grupo->registro->reprobados)*$grupo->registro->desertores}}</p>
        </div>
    </div>
    <div class="seccion">
        <h3>3. Desarrollo del curso</h3>
        <div style="width:80%;display:inline-block;padding-left:20px;">
            <div style="width:40%;display:inline-block;">
                <p>EL CURSO SE DESARROLLA</p>
            </div>
            <div style="width:15%;display:inline-block;">
                <p style="display:inline-block;">Regular </p><input type="text" style="width:25px;">
            </div>
            <div style="width:15%;display:inline-block;">
                <p style="display:inline-block;">Irregular </p><input type="text" style="width:25px;">
            </div>
            <div>
                <p>UNIDADES EVALUADAS Y CALIFICACIONES PARCIALES</p>
            </div>
            <div>
                <table style="bordered">
                    <tr>
                        <th width="10%">UNIDAD</th>
                        <th width="70%">FORMA EN LA QUE SE EVALUO</th>
                        <th width="10%">FECHA</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>

            <div>
                <p>PRACTICAS REALIZADAS</p>
            </div>
            <div>
                <table>
                    <tr>
                        <th width="10%">UNIDAD</th>
                        <th width="70%">FORMA EN LA QUE SE EVALUO</th>
                        <th width="10%">FECHA</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="width:20%;display:inline-block;"></div>
    </div>
    <div class="seccion">
        <h3>4. Observaciones generales</h3>
        <table style="width:82%;padding-left:20px;">
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        
    </div>
    <div class="seccion" style="margin-top:50px;">
        <center>
            <input type="text" style="border:0;border-bottom:1px solid #000;">
            <p>FIRMA DEL CATEDRATICO</p>
        </center>
    </div>

</div>


</body>

</html>