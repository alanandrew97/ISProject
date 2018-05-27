<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{url('/css/materialize.css')}}">
    <link rel="stylesheet" href="{{url('/css/style.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript" src="{{url('/js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/materialize.js')}}"></script>
    @yield('head')
</head>
<body>
    {{--<div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('contenedor')
        </main>
    </div>--}}

    <input type="hidden" id="_url" value="{{ url('/') }}">
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
    <!--Barra de navegación-->
    <nav style="height:100px; color:#black;">
        <div class="nav-wrapper white-color" style="height:100px;">
            <a href="{{url('inicio')}}" class="brand-logo" style="padding-left: 2.5%;">
                <img src="{{$escuela->ruta_imagen}}" style="vertical-align: middle; display:inline-block; height:95px;" alt="Inicio">
                <div style="display:inline-block; line-height: 100px; color: #4d4d4d;">{{$escuela->nombre}}</div>
            </a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul  id="nav" class="right hide-on-med-and-down">
                <li><a class="menuItem" href="{{url('escuela')}}">Escuela</a></li>

                <li><a class="menuItem menuSelected" href="{{url('usuarios')}}">Usuarios</a></li>

                <li><a class="menuItem" href="{{url('grupos')}}">Grupos</a></li>

                <li><a style="margin:0;cursor:pointer;">Usuario nombre <i style="display:inline-block;vertical-align: middle;" class="material-icons">arrow_drop_down</i></a></li>
                {{--<li><p>{{$usuario['nombre']}}</p></li>--}}
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col s10 offset-s1">
            <nav id="submenu" class="submenu col l2 m3 s4" style=" box-shadow:none;background:#fff;color:#ddd;margin-top:30px;">
                <ul>
                    @foreach ($submenuItems as $submenuItem)
                        <li><a class="{{$submenuItem['selected']?'submenuSelected':''}}" href="{{$submenuItem['link']}}">{{$submenuItem['nombre']}}</a></li>
                    @endforeach
                </ul>
            </nav>
            <div class="container col l10 m9 s8" id="container" style="background:white; border-left: #9d9d9d 1px solid; padding:0 30px; margin-top:30px;">
                @yield('contenedor')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @yield('modals')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
