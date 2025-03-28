<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitadoController;
use App\Models\Invitado;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/verificar-codigo', [InvitadoController::class, 'verificarCodigo'])->name('verificar.codigo');
Route::get('/confirmar-asistencia/{invitado}', [InvitadoController::class, 'formularioConfirmacion'])->name('confirmar.asistencia');
Route::post('/confirmar-asistencia/{invitado}', [InvitadoController::class, 'guardarConfirmacion'])->name('guardar.confirmacion');


Auth::routes();

Route::get('/tabla-invitados', function () {
    return view('tablainvitados');
})->middleware('auth')->name('tabla.invitados');

Route::get('/tabla-invitados', function () {
    $invitados = Invitado::all();
    return view('tablainvitados', compact('invitados'));
})->middleware('auth')->name('tabla.invitados');
