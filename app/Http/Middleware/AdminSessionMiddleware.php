<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') === 'admin') {
            return $next($request);
        }

        return redirect()->route('home'); // Redirige vers la page d'accueil si l'utilisateur n'est pas admin
    }
}
