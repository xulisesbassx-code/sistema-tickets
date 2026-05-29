<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $rol): Response
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        if ($request->user()->rol !== $rol) {
            abort(403, 'No autorizado');
        }

        return $next($request);
    }
}