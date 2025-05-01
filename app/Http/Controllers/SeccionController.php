<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use App\Models\Alumno;
use App\Http\Requests\StoreSeccionRequest;
use App\Http\Requests\UpdateSeccionRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class SeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Seccion::class);

        // $secciones = Seccion::all();
    
        return view('secciones.index', [
            'secciones' => Seccion::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeccionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Seccion $seccion)
    {
            // Get all alumnos to show in the select dropdown
            $alumnos = Alumno::all();
        
            // Get IDs of already enrolled alumnos (for select pre-fill)
            $inscritos = $seccion->alumnos->pluck('id')->toArray();
        
            return view('secciones.show', compact('seccion', 'alumnos', 'inscritos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seccion $seccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeccionRequest $request, Seccion $seccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seccion $seccion)
    {
        //
    }

    public function asignarAlumnos(Request $request, Seccion $seccion): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('asignar-seccion');  // if you have this policy

        // validate input
        $data = $request->validate([
            'alumnos' => 'array',
            'alumnos.*' => 'exists:alumnos,id',
        ]);

        // sync pivot table
        $seccion->alumnos()->sync($data['alumnos'] ?? []);

        return redirect()
            ->route('seccion.show', $seccion)
            ->with('success', 'Lista de alumnos actualizada.');
    }
}
