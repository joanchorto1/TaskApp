<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TareaController extends Controller
{
    //INDEX
    public function index()
    {
        return Inertia::render('Tareas/Index', ['tareas' => Tarea::all(), 'usuario'=>auth()->user(), 'proyectos' => Proyecto::all()]);
    }

    //CREATE
    public function create()
    {
        return Inertia::render('Tarea/Create');
    }

    //STORE
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
        ]);

        Tarea::create($request->all());


    }

    //SHOW
    public function show(Tarea $tarea)
    {
        return Inertia::render('Tarea/Show', ['tarea' => $tarea]);
    }

    //DESTROY
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return redirect()->route('dashboard');
    }

    //UPDATE
    public function completar(Tarea $tarea, $id)
    {
        $tarea = Tarea::find($id);
        $tarea->completada = !$tarea->completada;
        $tarea->save();
        return redirect()->route('proyectos.show',Proyecto::find($tarea->proyecto_id));
    }



}
