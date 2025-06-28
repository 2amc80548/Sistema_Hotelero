<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventarioController extends Controller
{
    public function index()
    {
        $items = Inventario::orderBy('producto')->get();

        return Inertia::render('Inventario/Index', [
            'inventario' => $items
        ]);
    }

    public function create()
    {
        return Inertia::render('Inventario/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'ubicacion' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        Inventario::create($request->all());

        return redirect()->route('inventario.index')->with('success', 'Producto registrado correctamente.');
    }

    public function edit(Inventario $inventario)
    {
        return Inertia::render('Inventario/Edit', [
            'inventario' => $inventario
        ]);
    }

    public function update(Request $request, Inventario $inventario)
    {
        $request->validate([
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'ubicacion' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        $inventario->update($request->all());

        return redirect()->route('inventario.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Inventario $inventario)
    {
        $inventario->delete();

        return redirect()->route('inventario.index')->with('success', 'Producto eliminado.');
    }
} 