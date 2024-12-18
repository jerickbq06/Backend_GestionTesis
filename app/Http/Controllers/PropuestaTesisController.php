<?php

namespace App\Http\Controllers;

use App\Models\PropuestaTesis;
use Illuminate\Http\Request;

class PropuestaTesisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            'message' => 'Lista de propuestas de tesis',
            'propuestas' => PropuestaTesis::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //usuario de la petiicion
        $usuario = $request->user();


        $validated = $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'ambito' => 'required|string|in:investigacion,desarrollo web,desarrollo movil,desarrollo videojuegos,inteligencia artificial'
        ]);

        $propuestaTesis = PropuestaTesis::create($validated);
        return response()->json([
            'message' => 'Propuesta de tesis creada correctamente',
            'propuesta' => $propuestaTesis,
            'user' => $usuario
        ], 201);
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $propuestaTesis = PropuestaTesis::find($id);

        if (!$propuestaTesis) {
            return response()->json([
                'message' => 'Propuesta de tesis no encontrada'
            ], 404);
        }
        return response()->json([
            'message' => 'Propuesta de tesis encontrada',
            'propuesta' => $propuestaTesis
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $propuestaTesis = PropuestaTesis::find($id);

        if (!$propuestaTesis) {
            return response()->json([
                'message' => 'Propuesta de tesis no encontrada'
            ], 404);
        }

        $request->validate([
            'titulo' => 'string',
            'descripcion' => 'string',
            'ambito' => 'string|in:investigacion,desarrollo web,desarrollo movil,desarrollo videojuegos,inteligencia artificial'
        ]);

        if (isset($request->titulo)) {
            $propuestaTesis->titulo = $request->titulo;
        }

        if (isset($request->descripcion)) {
            $propuestaTesis->descripcion = $request->descripcion;
        }

        if (isset($request->ambito)) {
            $propuestaTesis->ambito = $request->ambito;
        }

        $propuestaTesis->save();

        return response()->json([
            'message' => 'Propuesta de tesis actualizada correctamente',
            'propuesta' => $propuestaTesis
        ]);

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $propuestaTesis = PropuestaTesis::find($id);

        if (!$propuestaTesis) {
            return response()->json([
                'message' => 'Propuesta de tesis no encontrada'
            ], 404);
        }

        $propuestaTesis->delete();

        return response()->json([
            'message' => 'Propuesta de tesis eliminada correctamente'
        ]);
    }
}
