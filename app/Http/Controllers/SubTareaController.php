<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\SubTarea;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubTareaController extends Controller
{
    //INDEX
    public function index()
    {
        return Inertia::render('Dashboard', ['subtareas' => SubTarea::all()]);
    }

    //CREATE
    public function create(Request $request)
    {
        return Inertia::render('Subtarea/Create', ['tarea' => Tarea::find($request->id)]);
    }

    //STORE
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        $tarea = Tarea::find($request->tarea_id);

        SubTarea::create($request->all());

        return redirect()->route('proyectos.show', Proyecto::find($tarea->proyecto_id) );
    }

    //SHOW
    public function show(SubTarea $subtarea)
    {
        return Inertia::render('SubTarea/Show', ['subtarea' => $subtarea]);
    }

    //DESTROY
    public function destroy(SubTarea $subtarea)
    {
        $subtarea->delete();

        return redirect()->route('dashboard');
    }

    //Actualizar
    public function completar(Tarea $subtarea, $id)
    {
        $subtarea = SubTarea::find($id);
        $subtarea->completada = !$subtarea->completada;
        $tarea = Tarea::find($subtarea->tarea_id);
        $subtarea->save();
//        return redirect()->route('proyectos.show',Proyecto::find($tarea->proyecto_id));
    }
}
