<?php
namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Habitacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Periodo actual (este mes)
        $fechaInicio = now()->startOfMonth()->format('Y-m-d');
        $fechaFin = now()->endOfMonth()->format('Y-m-d');

        // Totales generales
        $totalHabitaciones = Habitacion::count();
        $reservasActivas = Reserva::where('estado', 'confirmada')
            ->where('fecha_ingreso', '<=', $fechaFin)
            ->where('fecha_salida', '>=', $fechaInicio)
            ->count();
        
        // Datos para gráficos
        $ocupacionData = $this->getOcupacionData($fechaInicio, $fechaFin);
        $ingresosData = $this->getIngresosData($fechaInicio, $fechaFin);
        $clientesData = $this->getClientesData($fechaInicio, $fechaFin);
        
        // Métricas clave
        $metricas = [
            'ocupacion' => $this->calcularPorcentajeOcupacion($fechaInicio, $fechaFin),
            'ingresos' => $this->getIngresosPeriodo($fechaInicio, $fechaFin),
            'reservas' => $this->getTotalReservas($fechaInicio, $fechaFin),
            'adr' => $this->calcularADR($fechaInicio, $fechaFin),
            'revpar' => $this->calcularRevPAR($fechaInicio, $fechaFin)
        ];

        return Inertia::render('Dashboard/Index', [
            'metricas' => $metricas,
            'ocupacionData' => $ocupacionData,
            'ingresosData' => $ingresosData,
            'clientesData' => $clientesData,
            'totalHabitaciones' => $totalHabitaciones,
            'reservasActivas' => $reservasActivas,
            'fechas' => [
                'inicio' => $fechaInicio,
                'fin' => $fechaFin,
                'mes_actual' => now()->translatedFormat('F Y')
            ]
        ]);
    }

    private function calcularPorcentajeOcupacion($inicio, $fin)
    {
        $totalHabitaciones = Habitacion::count();
        if ($totalHabitaciones == 0) return 0;
        
        // Cálculo preciso de noches ocupadas
        $reservas = Reserva::where('fecha_ingreso', '<=', $fin)
            ->where('fecha_salida', '>=', $inicio)
            ->get();
        
        $nochesOcupadas = 0;
        foreach ($reservas as $reserva) {
            $start = max(Carbon::parse($reserva->fecha_ingreso), Carbon::parse($inicio));
            $end = min(Carbon::parse($reserva->fecha_salida), Carbon::parse($fin));
            $nochesOcupadas += $start->diffInDays($end);
        }
        
        $diasPeriodo = Carbon::parse($inicio)->diffInDays($fin) + 1;
        $totalNoches = $totalHabitaciones * $diasPeriodo;
        
        return $totalNoches > 0 ? round(($nochesOcupadas / $totalNoches) * 100, 2) : 0;
    }

    private function calcularADR($inicio, $fin)
    {
        $ingresos = $this->getIngresosPeriodo($inicio, $fin);
        $nochesOcupadas = $this->getNochesOcupadas($inicio, $fin);
        
        return $nochesOcupadas > 0 ? round($ingresos / $nochesOcupadas, 2) : 0;
    }

    private function calcularRevPAR($inicio, $fin)
    {
        $ingresos = $this->getIngresosPeriodo($inicio, $fin);
        $totalHabitaciones = Habitacion::count();
        $dias = Carbon::parse($inicio)->diffInDays($fin) + 1;
        $totalNoches = $totalHabitaciones * $dias;
        
        return $totalNoches > 0 ? round($ingresos / $totalNoches, 2) : 0;
    }

    private function getNochesOcupadas($inicio, $fin)
    {
        $reservas = Reserva::where('fecha_ingreso', '<=', $fin)
            ->where('fecha_salida', '>=', $inicio)
            ->get();
        
        $noches = 0;
        foreach ($reservas as $reserva) {
            $start = max(Carbon::parse($reserva->fecha_ingreso), Carbon::parse($inicio));
            $end = min(Carbon::parse($reserva->fecha_salida), Carbon::parse($fin));
            $noches += $start->diffInDays($end);
        }
        
        return $noches;
    }

    private function getIngresosPeriodo($inicio, $fin)
    {
        return Reserva::whereBetween('fecha_ingreso', [$inicio, $fin])
            ->sum('total');
    }

    private function getTotalReservas($inicio, $fin)
    {
        return Reserva::whereBetween('fecha_ingreso', [$inicio, $fin])
            ->count();
    }

    private function getOcupacionData($inicio, $fin)
    {
        $totalHabitaciones = Habitacion::count();
        
        // Versión con consulta SQL directa
        $query = "
            SELECT 
                DATE(fecha_ingreso) as fecha, 
                COUNT(*) as reservas, 
                ROUND((COUNT(*) / {$totalHabitaciones}) * 100, 2) as porcentaje 
            FROM reservas 
            WHERE fecha_ingreso BETWEEN ? AND ? 
            GROUP BY fecha 
            ORDER BY fecha ASC
        ";
        
        return DB::select($query, [$inicio, $fin]);
    }
    private function getIngresosData($inicio, $fin)
    {
        return DB::select("
            SELECT 
                DATE(fecha_ingreso) as fecha, 
                SUM(total) as ingresos 
            FROM reservas 
            WHERE fecha_ingreso BETWEEN ? AND ? 
            GROUP BY fecha 
            ORDER BY fecha ASC
        ", [$inicio, $fin]);
    }
    
    private function getClientesData($inicio, $fin)
    {
        return DB::select("
            SELECT 
                c.id,
                c.nombre,
                COUNT(r.id) as reservas,
                SUM(r.total) as gasto_total
            FROM clientes c
            JOIN reservas r ON c.id = r.cliente_id
            WHERE r.fecha_ingreso BETWEEN ? AND ?
            GROUP BY c.id, c.nombre
            ORDER BY reservas DESC
            LIMIT 5
        ", [$inicio, $fin]);
    }   
}