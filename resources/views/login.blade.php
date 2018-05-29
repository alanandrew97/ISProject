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

    <body style="height:100%">
        <div style="background-image:url({{url('img/background.png')}}) !important; height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover">
        

        <div class="row">
            <div class="container" style="padding-top: 50px;padding-left:250px; padding-right:250px;padding-bottom:250px;">
                <div class="card" style="padding:20px;">
                    <form method="post" action="{{ url('/usuarios/login') }}" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="center">
                            <img class="center-align" src="{{ $escuela->ruta_imagen }}" style="width: 100px; height: 100px">
                        </div>
                        <div>
                            <h4 class="center-align" style="padding:20px;">{{ $escuela->nombre }}</h4>
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
                        
                        <div class="center">
                            <h6 class="center-align" style="margin-top:-20px;margin-bottom: 20px;"><a href="recuperarpassword">Recuperar contraseña</a></h6>
                        </div>
                
                       <div class="row">
                            <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Iniciar sesión">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>