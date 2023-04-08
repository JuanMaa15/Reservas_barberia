@extends('layouts.admin')

@section('content')
    
    <section id="reservas" class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <h2 class="titulos">Reservas</h2>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-9 d-flex justify-content-end align-items-center cont-filtros">
                    
                    <form action="" class="me-sm-2 me-md-2 me-lg-5 form-movil">
                        @csrf
                        <h4 class="label-form me-2"> Fecha reserva: </h4>
                        <input type="date" class="form-control" id="fecha" value="{{ date('Y-m-d') }}">
                    </form>
                    
                    <form action="" class="form-movil">
                        <h4 class="label-form me-2"> Buscar: </h4>
                        <input type="text" id="busqueda" class="form-control" placeholder="Busqueda general">
                    </form>
                </div>
            </div>
            
            <div class="row">
                <div class="col" id="contenedor_reservas">
                    @if (session('message'))
                        <div class="row mt-3">
                            <div class="col">
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @foreach($reservations as $reservation)
                    <div class="row">
                        <div class="col">
                            <div class="bloque-reserva {{ $reservation->estado == 2 ? 'trama-bloque-reserva' : '' }}">
                                    
                                    <div class="row text-center" id="cont_campos_reserva_hoy_{{ $reservation->id }}">
                                        <div class="col-10" class="datos-reserva">
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4 col-lg-3 px-4 texto-mediano">
                                                    Nombre: 
                                                    <span class="span-text-reserva">{{ $reservation->nombre }}</span>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-lg-3 px-4 texto-mediano">
                                                    Apellido: 
                                                    <span class="span-text-reserva">{{ $reservation->apellido }}</span>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-lg-3 px-4 texto-mediano">
                                                    Teléfono: 
                                                    <span class="span-text-reserva">{{ $reservation->telefono }}</span>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-lg-3 px-4 texto-mediano">
                                                    Correo Electrónico: 
                                                    <span class="span-text-reserva">{{ $reservation->email }}</span>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-lg-3 px-4 texto-mediano">
                                                    Fecha: 
                                                    <span class="span-text-reserva">{{ $reservation->fecha }}</span>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-lg-3 px-4 texto-mediano">
                                                    Hora: 
                                                    <span class="span-text-reserva">{{ $reservation->hours->hora }}</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        @if ($reservation->estado == 1)
                                            <div class="col-2 d-flex flex-column justify-content-center align-items-center">
                                                <button type="button" class="btn btn-verde btn-icon my-2 btn-reserva-lista" value="{{ $reservation->id }}"><i class="fa-solid fa-circle-check"></i></button>
                                                <button type="button" class="btn btn-rojo btn-icon my-2 btn-modal-eliminar" value="{{ $reservation->id }} " data-bs-toggle="modal" data-bs-target="#modal-eliminar"><i class="fa-solid fa-ban"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                
                                    {{--    --}}   
                                    @if ($reservation->estado == 2)
                                        <i class="fa-solid fa-circle-check icon-reserva-lista"></i>
                                    @endif
                                    
                            </div>
                        </div>
                    </div>
                @endforeach
                @if(count($reservations) == 0)
                    <div class="row mt-5">
                        <div class="col d-flex justify-content-center texto-mediano">
                            No se encontraron reservas para el día de hoy
                        </div>
                    </div>
                @endif

                {{-- <div class="row mt-4">
                    <div class="col">
                        {{$reservations->links()}}
                    </div>   
                </div> --}}
                
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modal-eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Esta seguro de eliminar la reserva?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('reservation.delete') }}" method="POST">
                        @csrf
                        <button type="submit" name="eliminar" class="btn btn-sm btn-danger btn-eliminar-reserva">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection