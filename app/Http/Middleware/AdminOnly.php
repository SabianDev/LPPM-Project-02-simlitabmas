<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || ! $request->user()->hasRole('admin')) {
            abort(403, 'Unauthorized.');
        }
        return $next($request);
    }
}