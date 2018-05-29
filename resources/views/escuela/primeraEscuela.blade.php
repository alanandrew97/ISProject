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
        <div>
            <h4 class="center-align" style="padding:20px;">Registro de escuela</h4>
        </div>

        <div class="row">
            <div class="container" style="padding-left:150px; padding-right:150px;padding-bottom:150px;">
                <div class="card" style="padding:20px; margin-bottom:120px;">
                    <form method="post" action="{{ url('/escuela/registrar') }}" enctype="multipart/form-data">
                        {{csrf_field()}}

                            <div class="row">
                            <div class="file-field input-field col s12">
                                <div class="btn" style="background: #BF3364;">
                                    <span>Imagen</span>
                                    <input type="file" name="imagen" >
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Subir imagen">
                                </div>
                            </div>
                            </div>
                        
                            <div class="row">
                                <div class="input-field col s12 ">
                                    <input  id="nombre" name="nombre" type="text" maxlength="70" required>
                                    <label for="nombre">Nombre</label>
                                </div>
                            </div>
                                            
                            <div class="row">
                                <input class="input-field btn right dark-primary-color" style="width:70%; margin:auto;" type="submit" value="Registrar">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>