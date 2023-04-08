@if (!empty($reservation))
    <div class="col-sm-4 py-1 px-2 texto-mediano">
        Nombre: 
        <span class="span-text-reserva">  {{ $reservation->nombre }} </span>
    </div>
    <div class="col-sm-4 py-1 px-2 texto-mediano">
        Apellido: 
        <span class="span-text-reserva">  {{ $reservation->apellido }} </span>
    </div>
    <div class="col-sm-4 py-1 px-2 texto-mediano">
        Teléfono: 
        <span class="span-text-reserva">  {{ $reservation->telefono }}  </span>
    </div>
    <div class="col-sm-4 py-1 px-2 texto-mediano">
        Fecha: 
        <span class="span-text-reserva">  {{ $reservation->fecha }}  </span>
    </div>
    <div class="col-sm-4 py-1 px-2 texto-mediano">
        Hora: 
        <span class="span-text-reserva">  {{ $reservation->hours->hora }} </span>
    </div>
     <div class="col-sm-4 py-1 px-2 texto-mediano">
        Barbero: 
        <span class="span-text-reserva">  {{ $reservation->users->nombre }} </span>
    </div>
@else
    <div class="col d-flex justify-content-center py-3 texto-mediano">
        La reserva no esta disponible!
    </div>
@endif