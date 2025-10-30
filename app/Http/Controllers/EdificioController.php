<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use App\Models\Aula;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $edificios = Edificio::withCount('aulas')->latest()->get();
        return view('edificios.index', compact('edificios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('edificios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'direccion' => 'required|string|max:200',
            'pisos' => 'required|integer|min:1|max:50',
        ]);

        Edificio::create($request->all());

        return redirect()->route('edificios.index')
            ->with('success', 'Edificio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Edificio $edificio)
    {
        // Cargar las aulas relacionadas
        $edificio->load('aulas');
        return view('edificios.show', compact('edificio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Edificio $edificio)
    {
        return view('edificios.edit', compact('edificio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Edificio $edificio)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'direccion' => 'required|string|max:200',
            'pisos' => 'required|integer|min:1|max:50',
        ]);

        $edificio->update($request->all());

        return redirect()->route('edificios.index')
            ->with('success', 'Edificio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Edificio $edificio)
    {
        $edificio->delete();

        return redirect()->route('edificios.index')
            ->with('success', 'Edificio eliminado exitosamente.');
    }

    /**
     * Método adicional para agregar aula al edificio
     */
    public function agregarAula(Request $request, $edificioId)
    {
        // Obtener la instancia del edificio
        $edificio = Edificio::findOrFail($edificioId);
        
        // Validar los datos del formulario
        $request->validate([
            'numero' => 'required|string|max:10',
            'piso' => 'required|integer|min:1|max:' . $edificio->pisos,
            'capacidad' => 'required|integer|min:1',
        ]);

        // Insertar el registro del aula usando el método create de la relación
        $edificio->aulas()->create([
            'numero' => $request->numero,
            'piso' => $request->piso,
            'capacidad' => $request->capacidad,
        ]);

        // Redireccionar hacia show del edificio
        return redirect()->route('edificios.show', $edificio)
            ->with('success', 'Aula agregada exitosamente al edificio.');
    }
}