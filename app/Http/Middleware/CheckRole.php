<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next, $role)
    {
        $userRole = Session::get('role');

        if (!$userRole) {
            return redirect()->route('login'); // Rediriger vers la page de connexion si le rôle n'est pas défini dans la session
        }

        if ($userRole === $role) {
            return $next($request);
        }

        return redirect()->route('home'); // Rediriger vers une page spécifique si le rôle n'est pas autorisé
    }

}
