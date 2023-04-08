<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HourController extends Controller
{
    //Mostrar horas disponibles
    public function getAvailable(Request $request) {

        //Validar el formulario
        $request->validate([
            'fecha' => ['required', 'string'],
            'barbero' => ['required', 'integer']
        ]);

        //Recoger datos
        $fecha = $request->input('fecha');
        $user_id = $request->input('barbero');
        
        // Traer de la base de datos las reservas que cumplan con las condiciones
        $reservations = Reservation::where('fecha', $fecha)
                                ->where('user_id', $user_id)
                                ->get();


        //Traer listado de las horas
        $hours = Hour::all();

        $html = "";
        
        
        //Recoger las horas para verificar si ya estan reservadas
        foreach($hours as $hour) {
            
            //Mostrar vista
            echo view('hour.hourdate', ['hour' => $hour, 'reservations' => $reservations]);

        }

        // Retornar HTML
        return $html;
        
    }

}
