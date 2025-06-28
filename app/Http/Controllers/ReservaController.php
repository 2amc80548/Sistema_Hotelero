<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cliente;
use App\Models\Factura;
use Carbon\Carbon;


class ReservaController extends Controller
{
    // Mostrar lista de reservas
    public function index()
    {
        $reservas = Reserva::with('cliente','habitacion')->orderBy('fecha_ingreso', 'desc')->get();
        return Inertia::render('Reservas/Index', [
            'reservas' => $reservas,
        ]);
       
    }



    // Mostrar formulario para crear reserva
    public function create()
    {
        $habitaciones = Habitacion::all();
        $clientes = Cliente::all(); // 

    return Inertia::render('Reservas/Create', [
        'habitaciones' => $habitaciones->where('estado', 'disponible'),
        'clientes' => $clientes, // 
 
    ]);

}
   

    // Guardar nueva reserva
    public function store(Request $request)
    {
        $request->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'fecha_ingreso' => 'required|date|before_or_equal:fecha_salida',
            'fecha_salida' => 'required|date|after_or_equal:fecha_ingreso',
            'estado' => 'required|in:pendiente,confirmada,finalizada,cancelada',
            'total' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string',
            'cliente_id' => 'required|exists:clientes,id',
            
             
        ]);

        Reserva::create($request->all());
   

        return redirect()->route('reservas.index')->with('success', 'Reserva creada correctamente.');
    }

    // Mostrar formulario para editar reserva
    public function edit(Reserva $reserva)
    {
         $habitaciones = Habitacion::all();
            $clientes = Cliente::all(); // 

    return Inertia::render('Reservas/Edit', [
        'reserva' => $reserva,
        'habitaciones' => $habitaciones->where('estado', 'disponible'),
        'clientes' => $clientes, // 
    ]);
}

    // Actualizar reserva
    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_ingreso' => 'required|date|before_or_equal:fecha_salida',
            'fecha_salida' => 'required|date|after_or_equal:fecha_ingreso',
            'estado' => 'required|in:pendiente,confirmada,finalizada,cancelada',
            'total' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string',
        ]);

        $reserva->update($request->all());
     


      
        // (Aquí podrías agregar lógica extra según reglas de negocio)

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente.');
    }

    // Eliminar reserva
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();

        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada correctamente.');
    }

    public function show(Reserva $reserva)
{
    $reserva->load('habitacion','cliente'); // Carga la relación con habitación y cliente si la necesitas
    return Inertia::render('Reservas/Show', [
        'reserva' => $reserva,
    ]);
}

}
