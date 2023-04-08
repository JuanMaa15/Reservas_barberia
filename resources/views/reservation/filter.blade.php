@foreach($reservations as $reservation)
    <div class="row">
        <div class="col">
            <div class="bloque-reserva {{ $reservation->estado == 2 ? 'trama-bloque-reserva' : '' }}">
                    
                    <div class="row text-center" id="cont_campos_reserva_hoy_{{ $reservation->id }}">
                        <div class="col-10">
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
                                <button type="button" class="btn btn-rojo btn-icon my-2 btn-modal-eliminar" value="{{ $reservation->id }}" data-bs-toggle="modal" data-bs-target="#modal-eliminar"><i class="fa-solid fa-ban"></i></button>
                            </div>
                        @endif
                    </div>
                
                     
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
            No se encontraron reservas
        </div>
    </div>
@endif
{{-- <div class="row mt-4">
    <div class="col">
        {{$reservations->links()}}
    </div>   
</div> --}}