<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role != 'admin') {
            return abort(403, "Kamu ga boleh kesini!");
        }
        return $next($request);
    }
}
