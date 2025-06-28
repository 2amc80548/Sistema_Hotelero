<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('dash', function () {
//     return Inertia::render('Welcome');
// })->name('home');

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


use App\Http\Controllers\HabitacionController;

Route::middleware(['auth'])->group(function () {
    Route::resource('habitaciones', HabitacionController::class)->parameters([
        'habitaciones' => 'habitacion'
    ]);
});



use App\Http\Controllers\ReservaController;

Route::middleware(['auth'])->group(function () {
    Route::resource('reservas', ReservaController::class)->parameters([
        'reservas' => 'reserva'  // singular 'reserva' para el parámetro en controlador
    ]);
});


use App\Http\Controllers\ClienteController;

Route::middleware(['auth'])->group(function () {
    Route::resource('clientes', ClienteController::class)->parameters([
        'clientes' => 'cliente'  // singular 'cliente' para el parámetro en controlador
    ]);
});

use App\Http\Controllers\InventarioController;

Route::middleware(['auth'])->group(function () {
    Route::resource('inventario', InventarioController::class)->parameters([
        'inventario' => 'inventario'  // singular 'cliente' para el parámetro en controlador

   ]);
});

use App\Http\Controllers\ReporteController;

Route::middleware(['auth'])->group(function () {
    Route::resource('reportes', ReporteController::class)->parameters([
        'reportes' => 'reporte'
        
    ]);
});






