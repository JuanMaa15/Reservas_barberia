<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

route::group(['prefix' => 'admin', 'middleware' => ['auth']],function(){

    //Productos
    Route::get('productos/config', [ProductoController::class, 'config'])->name('productos.config');
    Route::resource('productos', ProductoController::class);


});