<?php

namespace App\Http\Controllers;

use App\Models\Calificaion_tesis;
use Illuminate\Http\Request;

class CalificaionTesisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            'message' => 'calificaciones de tesis',
            'data' => Calificaion_tesis::with('tesis')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
	    $calificacion = new Calificaion_tesis();
	    $calificacion->id_tesis = $request->id_tesis;
	    $calificacion->id_estudiante = $request->id_estudiante;
	    $calificacion->calificacion = $request->calificacion;
	    $calificacion->observaciones = $request->observaciones;
	    $calificacion->save();

        return response()->json([
            'message' => 'calificacion creada',
            'data' => $calificacion
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $calificacion = Calificaion_tesis::find($id);

        return response()->json([
            'message' => 'calificacion de tesis',
            'data' => $calificacion
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $calificacion = Calificaion_tesis::find($id);
        $calificacion->id_estudiante = $request->id_estudiante;
        $calificacion->calificacion = $request->calificacion;
        $calificacion->observaciones = $request->observaciones;
        $calificacion->save();

        return response()->json([
            'message' => 'calificacion actualizada',
            'data' => $calificacion
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $calificacion = Calificaion_tesis::find($id);
        $calificacion->delete();

        return response()->json([
            'message' => 'calificacion eliminada',
            'data' => $calificacion
        ]);
    }
}
