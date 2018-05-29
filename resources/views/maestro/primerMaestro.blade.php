<!doctype html>
<html>
    <head>    
        <!-- Styles -->
        <link rel="stylesheet" href="{{url('/css/materialize.css')}}">
        <link rel="stylesheet" href="{{url('/css/style.css')}}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Scripts -->
        <script type="text/javascript" src="{{url('/js/jquery-3.3.1.min.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/materialize.js')}}"></script>
    </head>

    <body>
        <div>
            <h4>Registro de primer administrador</h4>

            <div class="card">
                <form method="post" action="{{ url('/escuela/registrar') }}" enctype="multipart/form-data">
                    {{csrf_field()}}

                        <div class="row">
                            <div class="input-field col s12">
                                <input  id="nombre" name="nombre" type="text" maxlength="70" required>
                                <label for="nombre">Nombre</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 ">
                                <input  id="apellido_paterno" name="apellido_paterno" type="text" maxlength="70" required>
                                <label for="apellido_paterno">Apellido paterno</label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12 ">
                                <input  id="apellido_materno" name="apellido_materno" type="text" maxlength="70" required>
                                <label for="apellido_materno">Apellido materno</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 ">
                                <input  id="correo" name="correo" type="text" maxlength="70" required>
                                <label for="correo">Correo</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 ">
                                <input  id="password" name="password" type="password" maxlength="70" required>
                                <label for="password">Password</label>
                            </div>
                        </div>

                        <!--TODO checkbox administrador-->
                                        
                        <div class="row">
                            <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Registrar">
                        </div>
                </form>
            </div>
        </div>
    </body>
</html>