<?php

namespace App\Http\Controllers;

use App\Http\Requests\HourAvaliableRequest;
use App\Models\Hour;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HourController extends Controller
{
    //Mostrar horas disponibles
    public function getAvailable(HourAvaliableRequest $request) {

        // Traer de la base de datos las reservas que cumplan con las condiciones
        $reservations = Reservation::where('fecha', $request->input('fecha'))
                                ->where('user_id', $request->input('barbero'))
                                ->get();

        //Traer listado de las horas
        $hours = Hour::all();
        return view('hour.hourdate',compact('hours','reservations'));
        
    }

}
