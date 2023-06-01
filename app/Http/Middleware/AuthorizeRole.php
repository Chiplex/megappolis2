<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Solo ingresan aquellos usuarios que tiene el rol asignado por la ruta
        if (!$request->user()->roles()->where('name', $role)->exists()) {
            return back()->with('message', 'Acceso no autorizado');
        }
        
        return $next($request);
    }
}
