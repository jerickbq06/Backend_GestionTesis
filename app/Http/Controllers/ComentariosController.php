<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            'message' => 'Lista de comentarios',
            'comentarios' => Comentarios::with('tesis', 'usuario')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'comentario' => 'required|string',
            'id_tesis' => 'required|integer',
            'id_usuario' => 'required|integer'
        ]);

        $idUsuario = $request->id_usuario;

        if ($usuario = Usuario::find($idUsuario)) {
            if ($usuario->id_rol != 2) {
                return response()->json([
                    'message' => 'El Id pasado en id_usuario no es un docente, solo los docentes pueden dar retroalimentación'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'El usuario no existe'
            ]);
        }

        $comentario = new Comentarios();
        $comentario->comentario = $request->comentario;
        $comentario->id_tesis = $request->id_tesis;
        $comentario->id_usuario = $request->id_usuario;
        $comentario->save();

        return response()->json([
            'message' => 'Comentario creado correctamente',
            'comentario' => $comentario
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $comentario = Comentarios::with('tesis', 'usuario')->find($id);

        if (!$comentario) {
            return response()->json([
                'message' => 'Comentario no encontrado'
            ]);
        }

        return response()->json([
            'message' => 'Comentario encontrado',
            'comentario' => $comentario
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $comentario = Comentarios::find($id);

        if (!$comentario) {
            return response()->json([
                'message' => 'Comentario no encontrado'
            ]);
        }

        $request->validate([
            'comentario' => 'string',
            'id_tesis' => 'integer',
            'id_usuario' => 'integer'
        ]);

        $comentario->update($request->only([
            'comentario',
            'id_tesis',
            'id_usuario'
        ]));

        return response()->json([
            'message' => 'Comentario actualizado correctamente',
            'comentario' => $comentario
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $comentario = Comentarios::find($id);

        if (!$comentario) {
            return response()->json([
                'message' => 'Comentario no encontrado'
            ]);
        }

        $comentario->delete();

        return response()->json([
            'message' => 'Comentario eliminado correctamente'
        ]);
        
    }
}
