@extends('layouts.client')

@section('header')  @endsection

@section('content')
    
    @if(session('message'))
    <section id="respuesta-formulario" class="py-5">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-8">
                    <div class="cont-respuesta-form">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center">
                                <div class="icono-respuesta">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <p class="texto-grande">Su reserva se ha completado exitosamente!</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    @else
    <section id="formulario_reserva" class="pb-5">
        <div class="container ">
            <div class="row mt-5">
                <div class="col d-flex justify-content-center">
                    <div class="cont-formulario-reserva mt-5">
                        <div class="encabezado-formulario">
                            <h2 class="titulos">Formulario de reserva</h2>
                        </div>
                        <div class=" row">
                            <div class="col-sm-6 bloque1-form text-center pt-2">
                                <h4>Fecha: {{ $fecha }}</h4>
                                <h4>Hora: {{ $hour->hora }}</h4>
                                <h4>Barbero:</h4>
                                <div class="img-barbero">
                                    <img src="{{ route('admin.image', ['nombre_imagen' => $user->imagen ]) }}" alt="">
                                </div>
                                <h4>{{ $user->nombre }}</h4>
                            </div>
                            <div class="col-sm-6 bloque2-form px-4">
                                <h4 class="subtitulos text-center mt-4">Ingresa tus datos</h4>
                                <form action="{{ route('reservation.save') }}" method="POST" class="mt-3 mb-5">
                                    
                                    @csrf
                                    <div class="my-4">
                                        <input type="text" name="nombre" placeholder="Nombre" class="form-control @error('nombre') is-invalid @enderror">
                                        @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="my-4">
                                        <input type="text" name="apellido" placeholder="Apellido" class="form-control @error('apellido') is-invalid @enderror">
                                        @error('apellido')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="my-4">
                                        <input type="text" name="telefono" placeholder="Teléfono" class="form-control @error('telefono') is-invalid @enderror">
                                        @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="my-4">
                                        <input type="email" name="email" placeholder="Correo Electrónico" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="my-3 d-none">
                                        <input type="hidden" name="fecha" value="{{ $fecha }}" class="form-control" readonly>
                                        @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="my-3 d-none">
                                        <input type="hidden" name="hora" value="{{ $hour->id }}" class="form-control" readonly>
                                        @error('hora')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="my-3 d-none">
                                        <input type="hidden" name="barbero" value="{{ $user->id }}" class="form-control" readonly>
                                        @error('barbero')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="my-5 text-center">
                                        <input type="submit" value="Registrar" class="btn btn-negro">
                                    </div>
                                    
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

@endsection