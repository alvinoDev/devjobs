<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacanteControler;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CandidatosController;
use App\Http\Controllers\NotificacionController;

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', [VacanteControler::class, 'index'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('vacantes.index');
Route::get('/vacantes/create', [VacanteControler::class, 'create'])->middleware(['auth', 'verified'])->name('vacantes.create');
Route::get('/vacantes/{vacante}/edit', [VacanteControler::class, 'edit'])->middleware(['auth', 'verified'])->name('vacantes.edit');
Route::get('/vacantes/{vacante}', [VacanteControler::class, 'show'])->name('vacantes.show');

//Candidatos
Route::get('/candidatos/{vacante}', [CandidatosController::class, 'index'])->name('candidatos.index');

//Notificaciones
Route::get('/notificaciones', NotificacionController::class)->middleware(['auth', 'verified', 'rol.reclutador'])->name('notificaciones'); //Al tener un solo metodo no se especifica nigun metodo

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
