<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectWhisperlyGuest
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('whisperly')->guest()) {
            return redirect()->route('login.baru');
        }

        return $next($request);
    }
}