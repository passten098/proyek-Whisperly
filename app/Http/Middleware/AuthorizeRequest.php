<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Permission;
use Illuminate\Http\Request;

/**
 * AuthorizeRequest created by @abianbiya on 21 Jun 2022
 */
class AuthorizeRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route()?->getName();
        $path = $request->path();

        $whisperlyRoutes = [
            'login.baru',
            'register.baru',
            'logout.baru',
            'whisperly',
            'whisperly.home',
            'whisperly.chat.index',
            'whisperly.chat.show',
            'whisperly.chat.store',
            'whisperly.bookings.store',
            'selamat',
            'user',
            'talent',
            'admin',
            'pengaduan',
            'booking',
        ];

        if ($route && (preg_match('/^(login\.baru|register\.baru|logout\.baru|whisperly|selamat|user|talent|admin|pengaduan|booking)/', $route) || in_array($route, $whisperlyRoutes, true))) {
            return $next($request);
        }

        if (is_string($path) && str_starts_with($path, 'whisperly')) {
            return $next($request);
        }

        $user = $request->user();

        $can = Permission::can($route);

        if(!$can){
            abort(403);
        }

        return $next($request);
    }
}
