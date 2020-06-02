<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'test') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>

    <!-- Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/bde0c72689.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            CardCenter<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
                <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">
                    Close &times;
                </button>
                <a href="{{url('/')}}" class="w3-bar-item w3-button">Home</a>
                <a href="{{url('view/')}}" class="w3-bar-item w3-button">Cards List</a>
                @auth         
                    <a href="{{url('changePassword/')}}" class="w3-bar-item w3-button">Change Password</a>
                    @if (Auth::user()->type == "admin")
                        <a href="{{url('add/')}}" class="w3-bar-item w3-button">Add carts</a>
                    @endif
                @endauth
            </div>
            <div id="main">
                <div class="w3-Light Gray">
                    <button id="openNav" class="w3-button w3-Light Gray w3-xlarge" onclick="w3_open()">&#9776;</button>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn" onclick="gameMenu()">Game</button>
                <div id="dropdown-content">
                    <a href="{{url('/Force of Will')}}">Force of will</a>
                    <a href="{{url('/Magic')}}">Magic</a>
                    <a href="{{url('/yugiho')}}">Yu-gi-ho</a>
                    <a href="{{url('/pokemon')}}">pokemon</a>
                </div>
            </div>
            <ul class="navbar-nav mr-auto"></ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="logoutMenu()">
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="pruebas">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>                            
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>

    <main class="py-4" id="p1">
        @yield('content')
    </main>
</body>
</html>