<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            'message' => 'users list',
            'data' => Usuario::with(['rol', 'tesis', 'tesis.estudiante', 'tesis.tutor', 'tesis.estudianteCompanero', 'tesis.comentarios', 'tesis.calificaciones', ])->get()
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
    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nombres_usuario = $request->nombres_usuario;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->id_rol = $request->id_rol;
        $usuario->telefono_usuario = $request->telefono_usuario;
        $usuario->direccion_usuario = $request->direccion_usuario;
        $usuario->save();

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'usuario' => $usuario
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // find the user by id with the rol
        $usuario = Usuario::with('rol', 'tesis')->find($id);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado'
            ]);
        }

        return response()->json([
            'message' => 'Usuario encontrado',
            'usuario' => $usuario
        ]);
        
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado'
            ]);
        }

        $request->validate([
            'nombres_usuario' => 'string|max:255',
            'email' => 'email',
            'password' => 'string|confirmed',
            'id_rol' => 'int',
            'telefono_usuario' => 'string',
            'direccion_usuario' => 'string',
        ]);
        
        $usuario->update($request->only([
            'nombres_usuario',
            'email',
            'password',
            'id_rol',
            'telefono_usuario',
            'direccion_usuario',
        ]));
        
        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'usuario' => $usuario
        ]);
        
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $usuario = Usuario::FindOrFail($id);
        $usuario->delete();

        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ]);
    }
}
