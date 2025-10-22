<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;

Route::resource('tasks', TaskController::class);
Route::resource('alumnos', AlumnoController::class); 