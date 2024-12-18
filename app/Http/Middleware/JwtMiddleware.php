<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Log as FacadesLog;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        FacadesLog::info('JwtMiddleware ejecutado para ruta: ' . $request->path());
        try {
                // Intenta autenticar solo si hay un token presente
                $user = JWTAuth::parseToken()->authenticate();

        } catch (JWTException $e) {
            return response()->json(['error' => 'Token not valid'], 401);
        }

        // 
        return $next($request);
    
    }
}