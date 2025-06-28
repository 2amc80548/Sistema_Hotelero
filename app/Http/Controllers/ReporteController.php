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
    public function index()
    {
        // Reservas por mes
        $reservasPorMes = Reserva::selectRaw("DATE_FORMAT(fecha_ingreso, '%Y-%m') as mes, COUNT(*) as total")
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // Ingresos por mes
        $ingresosPorMes = Reserva::selectRaw("DATE_FORMAT(fecha_ingreso, '%Y-%m') as mes, SUM(total) as ingresos")
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // Clientes frecuentes
        $clientesFrecuentes = Cliente::select('clientes.id', 'clientes.nombre', DB::raw('COUNT(reservas.id) as total_reservas'))
            ->join('reservas', 'clientes.id', '=', 'reservas.cliente_id')
            ->groupBy('clientes.id', 'clientes.nombre')
            ->orderByDesc('total_reservas')
            ->limit(5)
            ->get();

        // Habitaciones más ocupadas
        $habitacionesOcupadas = Habitacion::select('habitaciones.numero', DB::raw('COUNT(reservas.id) as veces_ocupada'))
            ->join('reservas', 'habitaciones.id', '=', 'reservas.habitacion_id')
            ->groupBy('habitaciones.id', 'habitaciones.numero')
            ->orderByDesc('veces_ocupada')
            ->limit(5)
            ->get();

        // Inventario bajo stock
        $productosBajoStock = Inventario::whereColumn('cantidad', '<=', 'stock_minimo')->get();

        return Inertia::render('Reportes/Index', [
            'reservasPorMes' => $reservasPorMes,
            'ingresosPorMes' => $ingresosPorMes,
            'clientesFrecuentes' => $clientesFrecuentes,
            'habitacionesOcupadas' => $habitacionesOcupadas,
            'productosBajoStock' => $productosBajoStock,
        ]);
    }
}
