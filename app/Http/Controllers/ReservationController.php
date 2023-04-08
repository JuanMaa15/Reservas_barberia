<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function __construct()
    {   
        $this->middleware('auth')->only('list', 'delete', 'updateStatus');
    }

    public function reservation(Request $request) {

        //Validar el formulario
        $request->validate([
            'fecha' => ['required', 'string'],
            'barbero' => ['required', 'integer'],
            'hora' => ['required', 'integer']
        ]);

        //Recoger datos
        $fecha = $request->input('fecha');
        $user_id = $request->input('barbero');
        $hour_id = $request->input('hora');

        //Seguridad
        // Traer registros con reservas listas
        $reservations = Reservation::where('fecha', $fecha)
                                    ->where('user_id', $user_id)
                                    ->where('hour_id', $hour_id)
                                    ->get();
        
        //Si la consulta me trae registros que me redireccione a la pagina de inicio.
        /* Esto se hace ya que algun usuario puede manipular el formulario desde el inspeccionador 
        cambiando los valores de los inputs */
        if (count($reservations) > 0) {
            return redirect()->route('index');
        }
        
        $user = User::find($user_id);
        $hour = Hour::find($hour_id);

        return view('reservation.create', [
            'fecha' => $fecha,
            'user' => $user,
            'hour' => $hour
        ]);

    }

    public function create(Request $request) {

        //Validar el formulario
        $request->validate([
            'barbero' => ['required', 'integer'],
            'hora' => ['required', 'integer'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['string', 'max:255'],
            'telefono' => ['string', 'max:255'],
            'email' => ['string', 'max:255'],
            'fecha' => ['required', 'string'],     
        ]);

        //Recoger datos
        $user_id = $request->input('barbero');
        $hour_id = $request->input('hora');
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $telefono = $request->input('telefono');
        $email = $request->input('email');    
        $fecha = $request->input('fecha');

        //Seguridad
        // Traer registros con reservas listas
        $reservations = Reservation::where('fecha', $fecha)
                                    ->where('user_id', $user_id)
                                    ->where('hour_id', $hour_id)
                                    ->get();
        
        //Si la consulta me trae registros que me redireccione a la pagina de inicio.
        /* Esto se hace ya que algun usuario puede manipular el formulario desde el inspeccionador 
        cambiando los valores de los inputs */
        if (count($reservations) > 0) {
            return redirect()->route('index');
        }

        
        //Llamar el objeto reservation
        $reservation = new Reservation();

        //Enviar datos
        $reservation->user_id = $user_id;
        $reservation->hour_id = $hour_id;
        $reservation->nombre = $nombre;
        $reservation->apellido = $apellido;
        $reservation->telefono = $telefono;
        $reservation->email = $email;
        $reservation->fecha = $fecha;
        $reservation->estado = 1;

        //Crear reserva
        $reservation->save();

        $user = User::find($user_id);
        $hour = Hour::find($hour_id);

        return redirect()->route('index')->with(['message' => '']);
    }

    public function getReservation(Request $request) {

        $request->validate([
            'codigo' => ['required', 'integer']
        ]);

        $id = $request->input('codigo');

        //Traer reserva
        $reservation = Reservation::where('id', $id)
                                    ->where('estado', 1)
                                    ->first();
        
        
        return view('reservation.show', ['reservation' => $reservation]);

    }

    public function list(Request $request) {


        $user_id = Auth::user()->id;

        // Si la variable type existe que me permita continuar a los filtros de reservas
        if ($request->input('type') !== null){

            $type = $request->input('type');
            
            
            if ($type == "fecha") {
                // Filtrar por fecha de reservas

                $request->validate([
                    'fecha' => ['required', 'string']
                ]);

                $fecha = $request->input('fecha');

                $reservations = Reservation::where('fecha', $fecha)
                                             ->where('user_id', $user_id)
                                            ->orderBy('hour_id', 'ASC')
                                            ->get();
                                            /* ->paginate(6); */

                return view('reservation.filter', ['reservations' => $reservations]);
            }else{
                //Filtrar por barra de busqueda
                $busqueda = $request->input('busqueda');

                /* $request->validate([
                    'busqueda' => ['string']
                ]); */

                if (!empty($busqueda)) {

                    //Trae las reservas que coincidan con la busqueda (solo reservas no listas - estado)
                    $reservations = Reservation::where('estado', 1)
                                        ->where('user_id', $user_id)
                                        ->where('nombre', 'LIKE' , '%'.$busqueda.'%')
                                        /* ->orWhere('apellido', 'LIKE' , '%'.$busqueda.'%')
                                        ->orWhere('id', 'LIKE' , '%'.$busqueda.'%') */
                                        ->orderBy('hour_id', 'ASC')
                                        ->get();
                    /* ->paginate(6); */
                }else{

                      // Trae las reservas para el dia de hoy
                    $reservations = Reservation::where('fecha', date('Y-m-d'))
                                        ->where('user_id', $user_id)
                                        ->orderBy('hour_id', 'ASC')
                                        ->get();
                }
                
                //Vista
                return view('reservation.filter', ['reservations' => $reservations]);
            }

        }else{
            //Mostrar listado de las reservas de hoy

            $reservations = Reservation::where('fecha', date('Y-m-d'))
                                ->where('user_id', $user_id)
                                        ->orderBy('hour_id', 'ASC')
                                        ->get();
                                        /* ->paginate(6); */ 
    
            return view('reservation.list', ['reservations' => $reservations]);
        }
        
    }


    public function delete(Request $request) {


        $request->validate([
            'eliminar' => ['required', 'integer']
        ]);

        $id = $request->input('eliminar');

        //Traer registro
        $reservation = Reservation::find($id);

        //Eliminar
        $delete = $reservation->delete();

        if ($delete) return redirect()->route('reservation.list')->with(['message' => 'La reserva se elimino correctamente']);
        
        return redirect()->route('reservation.list')->with(['message' => 'La reserva NO se eliminó']);
    }

    public function updateStatus(Request $request) {

        $request->validate([
            'id' => ['required', 'integer']
        ]);

        $id = $request->input('id');

        //Traer registro
        $reservation = Reservation::find($id);
        //Enviar dato
        $reservation->estado = 2;

        //Actualizar
        $reservation->update();

    }


}
