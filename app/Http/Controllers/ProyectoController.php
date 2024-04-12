<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\SubTarea;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProyectoController extends Controller
{
    //INDEX
    public function index()
    {
        return Inertia::render('Proyecto/Index', ['proyectos' => Proyecto::all(), 'usuario'=>auth()->user()]);
    }



    //STORE
     public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'user_id' => 'required',
        ]);
      Proyecto::create($request->all());
        return redirect()->route('proyectos.index');
    }

    //SHOW
    public function show(Proyecto $proyecto)
    {
        $tareas = Tarea::where('proyecto_id', $proyecto->id)->get();
        return Inertia::render('Proyecto/Show', ['proyecto' => $proyecto, 'tareas' => $tareas,'subtareas' => SubTarea::all()]);
    }

    //DESTROY
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        return redirect()->route('dashboard');
    }

}
