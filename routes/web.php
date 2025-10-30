<?php

use App\Http\Controllers\EdificioController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;

// Rutas existentes
Route::resource('tasks', TaskController::class);
Route::resource('alumnos', AlumnoController::class);

// Rutas para edificios
Route::resource('edificios', EdificioController::class);

// Ruta adicional POST para agregar aulas - recibe el id del edificio como parámetro
Route::post('edificios/{edificio}/aulas', [EdificioController::class, 'agregarAula'])
    ->name('edificios.aulas.store');