<?php

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\SubTareaController;
use App\Http\Controllers\TareaController;
use App\Models\Proyecto;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {

        return Inertia::render('Dashboard', ['proyectos' => Proyecto::all(), 'usuario'=>auth()->user(), 'tareas'=> \App\Models\Tarea::all()]);

    })->name('dashboard');
});


//PROYECTOS

Route::get('/proyectos',[ProyectoController::class,'index'])->name('proyectos.index');
Route::get('/proyectos/create',[ProyectoController::class,'create'])->name('proyectos.create');
Route::post('/proyectos',[ProyectoController::class,'store'])->name('proyectos.store');
Route::get('/proyectos/{proyecto}',[ProyectoController::class,'show'])->name('proyectos.show');
Route::delete('/proyectos/{proyecto}',[ProyectoController::class,'destroy'])->name('proyectos.destroy');

Route::get('/tareas',[TareaController::class,'index'])->name('tareas.index');
Route::post('/tareas',[TareaController::class,'store'])->name('tareas.store');
Route::post('/tareas/{id}',[TareaController::class,'update'])->name('tareas.update');
Route::post('/tareas/{id}',[TareaController::class,'completar'])->name('tareas.actualizar');

Route::get('/calendar',[\App\Http\Controllers\Controller::class,'calendar'])->name('calendar.index');

Route::get('/subtareas',[App\Http\Controllers\SubTareaController::class,'index'])->name('subtareas.index');
Route::post('/subtareas',[App\Http\Controllers\SubTareaController::class,'store'])->name('subtareas.store');
Route::get('/subtareas/create',[App\Http\Controllers\SubTareaController::class,'create'])->name('subtareas.create');
Route::post('/subtareas/{id}',[App\Http\Controllers\SubTareaController::class,'completar'])->name('subtareas.actualizar');


