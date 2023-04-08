@extends('layouts.client')

@section('content')
    <section id="banner">
        <div class="container-fluid p-0">
            <div class="img-banner">
                <img src="{{ asset('img/banner-img.jpg') }}" alt="Banner">
            </div>
            <div class="texto-banner">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis deleniti esse magnam libero voluptatibus ut, excepturi assumenda quia quis, fugit natus distinctio tenetur quam pariatur?</p>
                <a href="#" class="btn btn-transparente mt-2">Mirar reservas</a>
            </div>
        </div>
    </section>
    <section id="reservar" class="py-5">
        <div class="container">
            
            <div class="row">
                <div class="col">
                    <h2 class="titulos">Reserva tu corte</h2>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <form action="{{ route('reservation.create') }}" method="GET" id="form-traer-horas">
                        @csrf
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-6 px-3 bloque-input mt-3">
                                <label for="fecha" class="label-form">Fecha</label>
                                <input type="date" id="fecha" name="fecha" class="form-control @error('fecha') is-invalid @enderror">
                                @error('fecha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 px-3 bloque-input mt-3">
                                <label for="fecha" class="label-form">Barbero</label>
                                <input type="text" id="barbero" name="barbero" placeholder="Seleccionar" class="form-control input-seleccion @error('barbero') is-invalid @enderror" readonly>
                                @error('barbero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 px-3 bloque-input d-flex justify-content-center mt-3">
                                <input type="button" class="btn btn-negro" id="btn_buscar_hora" value="Buscar">
                            </div>
                        </div>   
                        
                        <div class="row mt-3" id="reservas-disponibles">
                
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </section>
    <section id="contacto" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="titulos mb-4">Contactanos</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 px-3 mb-4">
                    <div class="cont-img-logo">
                        <img src="{{ asset('img/logo-img.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 justify-content-end px-3 mb-4">
                    <h3 class="subtitulos">Redes Sociales</h3>
                    <div class="cont-redes-sociales">
                        <a class="enlace-red-social" href="">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a class="enlace-red-social" href="">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a class="enlace-red-social" href=
                        "">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a class="enlace-red-social" href="#">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 justify-content-end px-3 mb-4">
                    <h3 class="subtitulos">Información adicional</h3>
                    <div class="cont-info-contacto">
                        <div class="icono-info-contacto">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="descripcion-info-contacto">
                            <h4 class="texto-mediano">Dirección</h4>
                            <p>Carrera 13A #34-33</p>
                        </div>
                    </div>
                    <div class="cont-info-contacto">
                        <div class="icono-info-contacto">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="descripcion-info-contacto">
                            <h4 class="texto-mediano">Teléfono móvil</h4>
                            <p>+57 312 23212242</p>
                        </div>
                    </div>
                    <div class="cont-info-contacto">
                        <div class="icono-info-contacto">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="descripcion-info-contacto">
                            <h4 class="texto-mediano">Email</h4>
                            <p>nuevocorreo230@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="mis_reservas" class="py-5">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h2 class="titulos">Tus reservas</h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="">
                        @csrf
                        <div class="row align-items-center justify-content-center ">
                            <div class="col-sm-6 px-3 bloque-input mb-3">
                                <input type="text" id="codigo" class="form-control" placeholder="Ingrese el código de la reserva">
                                
                            </div>
                            <div class="col-sm-6 px-3 bloque-input d-flex justify-content-center mb-3">
                                <input type="button" class="btn btn-negro" value="Buscar" id="btn_buscar_reserva">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="cont-consulta-reserva d-none">
                        <div class="row text-center" id="consulta-reserva">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="trama">
        <div class="cont-modal">
            <div class="modal-cabecera">
                <h3 class="subtitulos">Barbero</h3>
                <div class="btn-salir" id="btn-salir">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
            <div class="modal-cuerpo">
                <form action="" class="d-flex">
                    @foreach ($users as $user)
                        <div class="bloque-barbero" id="{{ $user->id }}">
                            <div class="img-barbero">
                                <img src="{{ isset($user->imagen) ? route('admin.image', ['nombre_imagen' => $user->imagen]) : '' }}" alt="">
                            </div>
                            <div class="nombre-barbero">
                                <h3 class="text-nombre">{{ $user->nombre }}</h3>
                            </div>
                        </div>
                    @endforeach
                    
                </form>
            </div>
            <div class="modal-pie">
                <button class="btn btn-cerrar" id="cerrar-modal">Cerrar</button>
            </div>
        </div>
    </div>
@endsection

