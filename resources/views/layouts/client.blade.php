<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" type="image/png" href="{{ asset('img/logo-img.png') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/4240342587.js"></script>
        <script src="{{ asset('jquery.js') }}"></script>
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
        @vite(['resources/css/style.css', 'resources/js/main.js'])
        
    </head>
    <body class="">
        @section('header')
            <header>
                <div class="barra-navegacion">
                    
                    <div class="container-md" >
                        
                        <nav class="menu">
                            <div class="logo">
                                <h1>
                                    <a href="index.php">Sweed <span class="texto-logo">Tood</span></a>
                                </h1>
                            </div>
                            <div class="boton-cont-navegacion">
                                <i class="fa-solid fa-bars"></i>
                            </div>
                            <ul class="cont-enlaces-menu">
                                <li>
                                    <a class="enlaces-menu" href="#banner">Inicio</a>
                                </li>
                                <li>
                                    <a class="enlaces-menu" href="#reservar">Reservar</a>
                                </li>
                                <li>
                                    <a class="enlaces-menu" href="#contacto">Contacto</a>
                                </li>
                                <li>
                                    <a class="enlaces-menu" href="#mis_reservas">Mis reservas</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
        @show

        <main class="content">
            @yield('content')
        </main>

         <!-- pie de pagina -->

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col text-center py-3">
                        <p class="texto-footer">Juan Manuel Henao - &copy; Todos los derechos reservados <?= date("Y"); ?></p>
                    </div>
                </div>
            </div>
        </footer>
    
        <div id="overlay">
            <div id="loader">
                <img src=" {{ asset('img/load.png') }}" alt="">
            </div>
        </div>
        <div id="url" class="d-none" data-url="{{ route('index') }}"></div>
    </body>
</html>
