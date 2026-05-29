<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComentarioController;

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/admin', function () {
        return 'Panel Admin';
    })->middleware('role:admin');

    Route::get('/tecnico', function () {
        return 'Panel Técnico';
    })->middleware('role:tecnico');

    Route::get('/usuario', function () {
        return 'Panel Usuario';
    })->middleware('role:usuario');

});

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🎫 Rutas de tickets (CORRECTO)
    Route::resource('tickets', TicketController::class);

    
    Route::post('/tickets/{ticket}/comentarios',
    [ComentarioController::class, 'store'])
    ->name('comentarios.store');

    
});

require __DIR__.'/auth.php';