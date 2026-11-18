
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ServicioRapidoController;

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
| Rutas protegidas para usuarios autenticados
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
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

    // Servicios rápidos
    Route::resource(
        'servicios-rapidos',
        ServicioRapidoController::class
    );

});

/*
|--------------------------------------------------------------------------
| SOLO ADMINISTRADORES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Usuarios
    Route::resource('usuarios', UsuarioController::class);

    // Estadísticas
    Route::get('/estadisticas', [EstadisticaController::class, 'index'])
        ->name('estadisticas');

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])
        ->name('reportes');

    // Exportar Excel
    Route::get('/reportes/excel', [ReporteController::class, 'exportarExcel'])
        ->name('reportes.excel');

    // Exportar PDF
    Route::get('/reportes/pdf', [ReporteController::class, 'exportarPdf'])
        ->name('reportes.pdf');

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
