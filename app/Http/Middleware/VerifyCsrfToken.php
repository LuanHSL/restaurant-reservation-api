<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Session;

class VerifyCsrfToken extends Middleware
{
    public function handle($request, Closure $next)
    {
        if ($this->isReading($request)) {
            return $next($request);
        }

        $token = Session::token();
        $request->request->set('_token', $token);

        return parent::handle($request, $next);
    }
}

