<?php

use App\Models\Factura;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with('reserva.cliente', 'reserva.habitacion')->latest()->get();

        return Inertia::render('Facturas/Index', [
            'facturas' => $facturas
        ]);
    }

    public function show(Factura $factura)
    {
        $factura->load('reserva.cliente', 'reserva.habitacion');

        return Inertia::render('Facturas/Show', [
            'factura' => $factura
        ]);
    }

    public function descargarPDF(Factura $factura)
    {
        $factura->load('reserva.cliente', 'reserva.habitacion');

        $pdf = \PDF::loadView('pdf.factura', compact('factura'));
        return $pdf->download("Factura_{$factura->id}.pdf");
    }
}

