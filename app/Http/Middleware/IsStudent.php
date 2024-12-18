<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // traer el usuario actual
        $usuario = $request->user();

        // ver su rol, id de rol 1 es igual a estudiante, los estudiantes no pueden modificar propuesta de tesis, solo consultarlas
        if ($usuario->id_rol == 1) {
            return response()->json([
                'message' => 'No tienes permisos para realizar esta acción'
            ], 403);
        }
        return $next($request);
    }
}
