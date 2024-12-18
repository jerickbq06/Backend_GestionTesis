<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

	    if ($requset->getMethod() == 'OPTIONS') {
	    	return response()->json([], 200)
	    }
	    $response = $next($request);
	    $response->headers->set('Access-Control-Allow-Origin', '*');
    		$response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
		$response->headers->set('Acess-Control-Allow-Headers', 'Content-Type', 'Authorization');	    
       	    return $response;
    }
}
