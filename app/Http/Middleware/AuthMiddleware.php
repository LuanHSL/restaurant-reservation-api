<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('web')->check()) {
            return response()->json(["messages" => "Você precisa estar logado para acessar esta página"], 401);
        }

        return $next($request);
    }
}
