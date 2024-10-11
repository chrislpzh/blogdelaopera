<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Estilos personalizados -->
    <style>
        .list-group-item.active {
            background-color: #007bff !important; 
            color: #ffffff !important;           
            border-color: #007bff !important;    
            font-weight: bold;                   
        }

        .list-group-item.active:hover {
            background-color: #0056b3; 
            color: #ffffff !important; 
        }
         
        body, html {
        margin: 0;
        padding: 0;
        }

         
        main.py-3 {
        padding-top: 0 !important;
        margin-top: -1rem; 
        }

        .promo-banner {
        padding-top: 1rem; 
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex">
        <!-- Barra lateral solo si el Usuario está autenticado -->
        @auth
        <div class="bg-light border-end" id="sidebar-wrapper" style="width: 250px;">
            <div class="sidebar-heading p-4">
                <img src="{{ asset('images/Logo-USAP-naranja-2.png') }}" alt="USAP Logo" style="max-width: 100%; height: auto;">
                <h4 class="mt-2">UNIVERSIDAD DE SAN PEDRO SULA</h4>
            </div>
            <div class="list-group list-group-flush">
                <!-- Pagina principal -->
                <a href="/" class="list-group-item list-group-item-action bg-light {{ Request::is('/') ? 'active' : '' }}">
                    Página Principal
                </a>

                <!-- Artículos -->
                <a href="{{ route('posts.index') }}" class="list-group-item list-group-item-action bg-light {{ Request::is('posts') ? 'active' : '' }}">
                    Artículos-Mantenimiento
                </a>

                <!-- Bolsa de empleo -->
                <a href="#" class="list-group-item list-group-item-action bg-light">
                    Bolsa de Empleo
                </a>

                <!-- Configuraciones -->
                <a href="#" class="list-group-item list-group-item-action bg-light">
                    Configuraciones
                </a>
            </div>
        </div>
        @endauth

        <!-- Contenido Principal -->
        <div class="flex-fill">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       
                        <ul class="navbar-nav ms-auto">
                            <!-- Links de autenticación -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>



