{{-- Variable para validar creacion de un boton --}}
<?php $crear = true; ?>

{{-- Verificar si hay registros --}}
@if (count($reservations) != 0) 
    
    {{-- Recorrer las reservas --}}
    @foreach($reservations as $reservation) 
        {{-- Verificar las horas reservadas --}}
        @if ($reservation->hours->hora == $hour->hora) 
            <div class="col-sm-6 col-md-4 col-lg-3">
            <button type="submit" name="hora" class="btn btn-seleccionar-hora reservada @error("hora") is-invalid @enderror" value="{{ $hour->id }}" disabled>
                {{ $hour->hora }}
                <span class="span-text-reserva">Reservada</span>
            </button>
            @error("barbero")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            {{-- Asignar un false a la variable para no crear un boton igual --}}
            <?php $crear = false; ?>
        @endif

    @endforeach           
    
@endif

{{-- Verificar si crear un boton --}}
@if ($crear)
<div class="col-sm-6 col-md-4 col-lg-3">
    <button type="submit" name="hora" class="btn btn-seleccionar-hora sin-reservar @error("hora") is-invalid @enderror" value="{{ $hour->id }}">
        {{ $hour->hora }}
    <span class="span-text-reserva">Disponible</span>
</button>
    @error("barbero")
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@endif

