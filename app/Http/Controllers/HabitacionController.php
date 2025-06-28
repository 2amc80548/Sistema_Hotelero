<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class HabitacionController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::orderBy('numero')->get();

        return Inertia::render('Habitaciones/Index', [
            'habitaciones' => $habitaciones
        ]);
    }

    public function create()
    {
        return Inertia::render('Habitaciones/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones',
            'tipo' => 'required|in:simple,doble,suite',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|in:disponible,reservada,ocupada,limpieza',
            'piso' => 'nullable|string',
            'observaciones' => 'nullable|string'
        ]);

        Habitacion::create($request->all());

      return redirect()->route('habitaciones.index')->with('success', 'Habitación registrada correctamente.');

    }

   public function edit(Habitacion $habitacion)
{
    return Inertia::render('Habitaciones/Edit', [
        'habitacion' => $habitacion
    ]);
}


    public function update(Request $request, Habitacion $habitacion)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones,numero,' . $habitacion->id,
            'tipo' => 'required|in:simple,doble,suite',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|in:disponible,reservada,ocupada,limpieza',
            'piso' => 'nullable|string',
            'observaciones' => 'nullable|string'
        ]);

        $habitacion->update($request->all());

        return redirect()->route('habitaciones.index')->with('success', 'Habitación actualizada.');
    }

    public function destroy(Habitacion $habitacion)
    {
        $habitacion->delete();

        return redirect()->route('habitaciones.index')->with('success', 'Habitación eliminada.');
    }
}
