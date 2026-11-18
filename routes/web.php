<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\ReporteController;


/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rutas protegidas para cualquier usuario autenticado
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Tickets
    Route::resource('tickets', TicketController::class);

    // Comentarios
    Route::post('/tickets/{ticket}/comentarios', [ComentarioController::class, 'store'])
        ->name('comentarios.store');

        Route::middleware(['auth'])->group(function () {
//reportes

    Route::get(
        '/reportes',
        [ReporteController::class, 'index']
    )->name('reportes');

});
});

/*
|--------------------------------------------------------------------------
| SOLO ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('usuarios', UsuarioController::class);

    Route::get('/estadisticas', [EstadisticaController::class, 'index'])
        ->name('estadisticas');

    Route::get('/admin', function () {
        return 'Panel Admin';
    });
});

/*
|--------------------------------------------------------------------------
| SOLO TÉCNICOS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:tecnico'])->group(function () {

    Route::get('/mis-tickets', [TicketController::class, 'misTickets'])
        ->name('tickets.mis');

    Route::get('/tecnico', function () {
        return 'Panel Técnico';
    });
});

/*
|--------------------------------------------------------------------------
| SOLO USUARIOS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:usuario'])->group(function () {

    Route::get('/usuario', function () {
        return 'Panel Usuario';
    });
});

require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| SOLO SERVICIOS RÁPIDOS
|--------------------------------------------------------------------------
*/

Route::resource(
    'servicios-rapidos',
    App\Http\Controllers\ServicioRapidoController::class
);
