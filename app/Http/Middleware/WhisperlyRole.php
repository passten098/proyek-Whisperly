<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WhisperlyRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $currentRole = strtolower((string) ($request->user('whisperly')?->role ?? ''));

        if ($currentRole !== strtolower($role)) {
            abort(403);
        }

        return $next($request);
    }
}