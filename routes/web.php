<?php

use App\Http\Controllers\HourController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


 Route::get('/', [UserController::class, 'indexClient'])->name('index');

// Usuarios 
Route::get('/admin/index', [UserController::class, 'index'])->name('admin.index');
Route::get('/admin/edit', [UserController::class, 'edit'])->name('admin.edit');
Route::post('/admin/update', [UserController::class, 'update'])->name('admin.update')->middleware('auth');
Route::get('/admin/image/{nombre_imagen}', [UserController::class, 'getImage'])->name('admin.image');
Route::get('/admin/config', [UserController::class, 'config'])->name('admin.config');
Route::post('/admin/delete', [UserController::class, 'delete'])->name('admin.delete');

// Reservas
Route::get('/reservas/crear', [ReservationController::class, 'reservation'])->name('reservation.create');
Route::get('/reservas/listado', [ReservationController::class, 'list'])->name('reservation.list');
Route::post('/reservas/save', [ReservationController::class, 'create'])->name('reservation.save');
Route::post('/reservas/show', [ReservationController::class, 'getReservation'])->name('reservation.show');
Route::post('/reservas/delete', [ReservationController::class, 'delete'])->name('reservation.delete');
Route::post('/reservas/update-status', [ReservationController::class, 'updateStatus'])->name('reservation.updatestatus');

// Horas
Route::post('/hora/disponible', [HourController::class, 'getAvailable'])->name('hora.disponible');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

