<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\SancionController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false, 'reset' => false, 'verify' => false, 'confirm' => false]);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'can:dashboard'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth', 'can:usuario.index'])->get('/usuarios', [UsuarioController::class, 'index'])->name('usuario.index');
Route::middleware(['auth', 'can:reservacion.index'])->get('/reservaciones', [ReservacionController::class, 'index'])->name('reservacion.index');

Route::middleware('auth')->prefix('prestamos')->name('prestamo.')->group(function () {
    Route::middleware('can:prestamo.index')->get('/', [PrestamoController::class, "index"])->name('index');
    Route::middleware('can:prestamo.historial')->get('/historial', [PrestamoController::class, "historial"])->name('historial');
    Route::middleware('can:prestamo.reporte')->get('/reporte', [PrestamoController::class, "reporte"])->name('reporte');
});

Route::middleware('auth')->prefix('sanciones')->name('sancion.')->group(function () {
    Route::middleware('can:sancion.index')->get('/', [SancionController::class, "index"])->name('index');
    Route::middleware('can:sancion.historial')->get('/historial', [SancionController::class, "historial"])->name('historial');
    Route::middleware('can:sancion.reporte')->get('/reporte', [SancionController::class, "reporte"])->name('reporte');
});

Route::middleware('auth')->prefix('libros')->name('libro.')->group(function () {
    Route::middleware('can:libro.index')->get('/', [LibroController::class, "index"])->name('index');
    Route::middleware('can:libro.ejemplares')->get('/ejemplares/{titulo_slug?}', [LibroController::class, "ejemplares"])->name('ejemplares');
    Route::middleware('can:libro.buscar')->get('/buscar', [LibroController::class, "buscarLibro"])->name('buscar');
});
