<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //CALENDAR
    public function calendar()
    {
        return Inertia::render('Calendar/Index', ['usuario'=>auth()->user(), 'proyectos' => \App\Models\Proyecto::all() , 'tareas' => \App\Models\Tarea::all(), 'subtareas' => \App\Models\SubTarea::all()]);
    }
}
