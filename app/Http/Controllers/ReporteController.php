<?php
namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Habitacion;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        // Validar fechas
        $request->validate([
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $fechaInicio = $request->fecha_inicio ?? now()->subMonth()->format('Y-m-d');
        $fechaFin = $request->fecha_fin ?? now()->format('Y-m-d');

        // Reporte de reservas
        $reservas = Reserva::with(['cliente', 'habitacion'])
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha_ingreso', [$fechaInicio, $fechaFin]);
            })
            ->orderBy('fecha_ingreso', 'desc')
            ->get();

        // Totales
        $totalIngresos = $reservas->sum('total');
        $totalReservas = $reservas->count();

        // Clientes frecuentes en el periodo
        $clientesFrecuentes = Cliente::select('clientes.id', 'clientes.nombre', DB::raw('COUNT(reservas.id) as total_reservas'))
            ->join('reservas', 'clientes.id', '=', 'reservas.cliente_id')
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('reservas.fecha_ingreso', [$fechaInicio, $fechaFin]);
            })
            ->groupBy('clientes.id', 'clientes.nombre')
            ->orderByDesc('total_reservas')
            ->limit(5)
            ->get();

        // Habitaciones más ocupadas en el periodo
        $habitacionesOcupadas = Habitacion::select('habitaciones.id', 'habitaciones.numero', 'habitaciones.tipo', DB::raw('COUNT(reservas.id) as veces_ocupada'))
            ->join('reservas', 'habitaciones.id', '=', 'reservas.habitacion_id')
            ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('reservas.fecha_ingreso', [$fechaInicio, $fechaFin]);
            })
            ->groupBy('habitaciones.id', 'habitaciones.numero', 'habitaciones.tipo')
            ->orderByDesc('veces_ocupada')
            ->limit(5)
            ->get();

        return Inertia::render('Reportes/Index', [
            'reservas' => $reservas,
            'totalIngresos' => $totalIngresos,
            'totalReservas' => $totalReservas,
            'clientesFrecuentes' => $clientesFrecuentes,
            'habitacionesOcupadas' => $habitacionesOcupadas,
            'filtros' => [
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin
            ]
        ]);
    }
}