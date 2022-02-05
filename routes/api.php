<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\EjemplarController;
use App\Http\Controllers\DataTablesController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\SancionController;
use App\Http\Controllers\Select2Controller;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Login y Logout
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth:sanctum')->get('/ping', [AuthController::class, 'ping'])->name('ping');

//Usuarios
Route::middleware('auth:sanctum')->prefix('usuarios')->name('usuario.')->group(function () {
    Route::middleware('can:usuario.store')->post('/', [UsuarioController::class, 'store'])->name('store');
    Route::middleware('can:usuario.update')->put('/{usuario_id}', [UsuarioController::class, 'update'])->name('update');
});

//Libros
Route::middleware('auth:sanctum')->prefix('libros')->name('libro.')->group(function () {
    Route::middleware('can:libro.store')->post('/', [LibroController::class, 'store'])->name('store');
    Route::middleware('can:libro.search')->get('/search', [LibroController::class, 'search'])->name('search');
    Route::middleware('can:libro.show')->get('/{titulo_slug}', [LibroController::class, 'show'])->name('show');
    Route::middleware('can:libro.update')->put('/{libro_id}', [LibroController::class, 'update'])->name('update');
});

//Ejemplares
Route::middleware('auth:sanctum')->prefix('ejemplares')->name('ejemplar.')->group(function () {
    Route::middleware('can:ejemplar.store')->post('/', [EjemplarController::class, 'store'])->name('store');
    Route::middleware('can:ejemplar.update')->put('/{ejemplar_id}', [EjemplarController::class, 'update'])->name('update');
    Route::middleware('can:ejemplar.show')->get('/{ejemplar_id}', [EjemplarController::class, 'show'])->name('show');
});

//Prestamos
Route::middleware('auth:sanctum')->prefix('prestamos')->name('prestamo.')->group(function () {
    Route::middleware('can:prestamo.store')->post('/', [PrestamoController::class, 'store'])->name('store');
    Route::middleware('can:prestamo.update')->put('/{prestamo_id}', [PrestamoController::class, 'update'])->name('update');
    Route::middleware('can:prestamo.mis-prestamos')->get('/mis-prestamos', [PrestamoController::class, 'misPrestamos'])->name('misPrestamos');
    Route::middleware('can:prestamo.show')->get('/{prestamo_id}', [PrestamoController::class, 'show'])->name('show');
});

//Sanciones
Route::middleware('auth:sanctum')->prefix('sanciones')->name('sancion.')->group(function () {
    Route::middleware('can:sancion.store')->post('/', [SancionController::class, 'store'])->name('store');
    Route::middleware('can:sancion.update')->put('/{sancion_id}', [SancionController::class, 'update'])->name('update');
    Route::middleware('can:sancion.mis-sanciones')->get('/mis-sanciones', [SancionController::class, 'misSanciones'])->name('misSanciones');
});

//Reservaciones
Route::middleware('auth:sanctum')->prefix('reservaciones')->name('reservacion.')->group(function () {
    Route::middleware('can:reservacion.store')->post('/', [ReservacionController::class, 'store'])->name('store');
    Route::middleware('can:reservacion.update')->put('/{reservacion_id}', [ReservacionController::class, 'update'])->name('update');
});

//DataTables
Route::middleware('auth:sanctum')->prefix('datatable')->name('datatable.')->group(function () {
    Route::get('limpiar', [DataTablesController::class, 'limpiar'])->name('limpiar');
    Route::middleware('can:datatable.libros')->get('libros', [DataTablesController::class, 'libros'])->name('libros');

    Route::prefix('usuarios')->name('usuario.')->group(function () {
        Route::middleware('can:datatable.usuarios')->get('usuarios', [DataTablesController::class, 'usuarios'])->name('usuarios');
        Route::middleware('can:datatable.usuarios-habilitados')->get('habilitados', [DataTablesController::class, 'usuariosHabilitados'])->name('habilitados');
    });

    Route::prefix('ejemplares')->name('ejemplar.')->group(function () {
        Route::middleware('can:datatable.ejemplares')->get('/{libro_id}', [DataTablesController::class, 'ejemplares'])->name('ejemplares');
        Route::middleware('can:datatable.ejemplares-disponibles')->get('disponibles/{libro_id}', [DataTablesController::class, 'ejemplaresDisponibles'])->name('disponibles');
    });

    Route::prefix('reservaciones')->name('reservacion.')->group(function () {
        Route::middleware('can:datatable.reservaciones')->get('/', [DataTablesController::class, 'reservaciones'])->name('reservaciones');
        Route::middleware('can:datatable.mis-reservaciones')->get('mis-reservaciones', [DataTablesController::class, 'misReservaciones'])->name('misReservaciones');
    });

    Route::prefix('prestamos')->name('prestamo.')->group(function () {
        Route::middleware('can:datatable.prestamos')->get('/', [DataTablesController::class, 'prestamos'])->name('prestamos');
        Route::middleware('can:datatable.prestamos-sin-sancion')->get('sin-sancion', [DataTablesController::class, 'prestamosSinSancion'])->name('sinSancion');
        Route::middleware('can:datatable.prestamos-reporte')->get('anyo-mes', [DataTablesController::class, 'prestamosReportePorAnyoMes'])->name('reportePorAnyoMes');
        Route::middleware('can:datatable.prestamos-reporte')->get('anyo-trimestre', [DataTablesController::class, 'prestamosReportePorAnyoTrimestre'])->name('reportePorAnyoTrimestre');
    });

    Route::prefix('sanciones')->name('sancion.')->group(function () {
        Route::middleware('can:datatable.sanciones')->get('/', [DataTablesController::class, 'sanciones'])->name('sanciones');
        Route::middleware('can:datatable.sanciones-reporte')->get('anyo-mes', [DataTablesController::class, 'sancionesReportePorAnyoMes'])->name('reportePorAnyoMes');
        Route::middleware('can:datatable.sanciones-reporte')->get('anyo-trimestre', [DataTablesController::class, 'sancionesReportePorAnyoTrimestre'])->name('reportePorAnyoTrimestre');
    });
});


//Select2
Route::middleware('auth:sanctum')->prefix('select2')->name('select2.')->group(function () {
    Route::get('select2', [Select2Controller::class, 'select2'])->name('select2');
    Route::get('estados-de-los-usuarios', [Select2Controller::class, 'estadosDeLosUsuarios'])->name('estadosDeLosUsuarios');
    Route::get('autores', [Select2Controller::class, 'autores'])->name('autores');
    Route::get('libros-todos', [Select2Controller::class, 'librosTodos'])->name('librosTodos');
    Route::get('libros/{titulo?}', [Select2Controller::class, 'libros'])->name('libros');
    Route::get('clasificaciones', [Select2Controller::class, 'clasificaciones'])->name('clasificaciones');
    Route::get('editoriales', [Select2Controller::class, 'editoriales'])->name('editoriales');
    Route::get('generos', [Select2Controller::class, 'generos'])->name('generos');
    Route::get('idiomas', [Select2Controller::class, 'idiomas'])->name('idiomas');
    Route::get('estados-fisicos-de-los-ejemplares', [Select2Controller::class, 'estadosFisicosDeLosEjemplares'])->name('estadosFisicosDeLosEjemplares');
    Route::get('estados-de-los-prestamos', [Select2Controller::class, 'estadosDeLosPrestamos'])->name('estadosDeLosPrestamos');
    Route::get('estados-de-los-ejemplares', [Select2Controller::class, 'estadosDeLosEjemplares'])->name('estadosDeLosEjemplares');
    Route::get('estados-de-las-sanciones', [Select2Controller::class, 'estadosDeLasSanciones'])->name('estadosDeLasSanciones');
    Route::get('sub-clasificaciones', [Select2Controller::class, 'subClasificaciones'])->name('subClasificaciones');
    Route::get('tipos-de-sanciones', [Select2Controller::class, 'tiposDeSanciones'])->name('tiposDeSanciones');
    Route::get('roles', [Select2Controller::class, 'roles'])->name('roles');
});
