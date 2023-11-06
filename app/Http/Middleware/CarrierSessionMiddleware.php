<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarrierSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (session('role') === 'transporteur') {
            return $next($request);
        }

        return redirect()->route('home'); // Redirige vers la page d'accueil si l'utilisateur n'est pas un carrier
    }
}
