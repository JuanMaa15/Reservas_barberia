<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    // public function __construct()
    // {
    //     //Solo los usuarios que iniciaron sesión tendrán acceso a estas acciones
    //     $this->middleware('auth')->only('index', 'edit', 'update', 'config', 'delete');
    // }

    public function index() {
        
        $reservations = Reservation::where('fecha', date('Y-m-d'))
                                    ->where('user_id', Auth::user()->id)
                                    ->orderBy('hour_id', 'ASC')
                                    ->get();

        return view('user.index', ['reservations' => $reservations]);
    }

    public function indexClient() {

        $users = User::All();
        return view('index', ['users' => $users]);
    }

    public function config() {

        $users = User::paginate(9);
        $hours = Hour::paginate(8);

        return view('user.config', [
            'users' => $users,
            'hours' => $hours
        ]);
    }

    public function getImage ($nombre_imagen) {

        // Traer
        $imagen = Storage::disk('users')->get($nombre_imagen);

        // Devolver imagen
        return response($imagen, 200);
    }
    
    public function edit() {

        $id = Auth::user()->id;

        $user = User::find($id);

        return view('user.update', ['user' => $user]);
    }

    public function update(Request $request) {

        //Validar datos
        $validate = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['string', 'max:255'],
            'telefono' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email, '. Auth::user()->id],
            'imagen' => ['image']   
        ]);

        //Recoger datos
        $id = Auth::user()->id;
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $telefono = $request->input('telefono');
        $email = $request->input('email');
        $imagen = $request->file('imagen');

        //Llamar al objeto y pasar datos
        $user = Auth::user();
        $user->nombre = $nombre;
        $user->apellido = $apellido;
        $user->telefono = $telefono;
        $user->email = $email;   
        
        //Subir nombre
        if ($imagen) {
            //Nombrar la imagen
            $nombre_imagen = time().$imagen->getClientOriginalName();

            //Guardar en la carpeta storage
            Storage::disk('users')->put($nombre_imagen, File::get($imagen));

            //Pasar imagen al objeto
            $user->imagen = $nombre_imagen;
        }

       
        //Ejecutar consulta
        $validar = $user->update();

        if ($validar) {
            return redirect()->route('admin.edit')->with(['message' => 'Los datos se han actualizado correctamente']);
        }

        return redirect()->route('admin.edit')->with(['message' => 'Los datos no se han actualizado']);

    }


    public function delete(Request $request) {

        $request->validate([
            'eliminar' => ['required', 'integer']
        ]);

        $id = $request->input('eliminar');

        //Traer usuario
        $user = User::find($id);

        //Traer reservaciones que pertenecen al usuario
        $reservations = Reservation::where('user_id')->get();

        
        //Eliminar reservaciones
        if ($reservations && count($reservations) > 0) {
            foreach ($reservations as $reservation) {
                $reservation->delete();
            }    
        }
        
        //Eliminar usuario
        $user->delete();

        return redirect()->route('admin.config')->with(['message' => 'El usuario se elimino correctamente']);
    }


}
