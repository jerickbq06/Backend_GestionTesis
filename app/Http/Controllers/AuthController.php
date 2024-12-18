<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Registro de usuario
    public function register(Request $request)
    {
        // Validar datos
        $request->validate([
            'nombres_usuario' => 'required|string',
            'email' => 'required|string|email|unique:usuarios',
            'password' => 'required|string',
            'id_rol' => 'required|integer',
            'telefono_usuario' => 'required|string',
            'direccion_usuario' => 'required|string'
        ]);
        // Crear usuario
        $usuario = Usuario::create([
            'nombres_usuario' => $request->nombres_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_rol' => $request->id_rol,
            'telefono_usuario' => $request->telefono_usuario,
            'direccion_usuario' => $request->direccion_usuario
        ]);

        $token = JWTAuth::fromUser($usuario); // Generar token JWT

        // Respuesta
        return response()->json([
            'usuario' => $usuario,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        // Validar datos
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        // Verificar credenciales
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
        // Generar token JWT
        $generatedToken = JWTAuth::fromUser(Auth::user());

        // Respuesta
        return response()->json([
            'message' => 'Login exitoso',
            'token' => $generatedToken,
            'user' => Auth::user(), // Devuelve el usuario autenticado
        ]);
    }
    
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Sesión cerrada']);
    }

    /* public function me()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'No autenticado'], 401);
        }
        return response()->json(Auth::user());
    }
 */
}
