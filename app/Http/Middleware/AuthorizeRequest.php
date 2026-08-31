<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Permission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeRequest
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route()?->getName();
        $path = $request->path();

        /*
        |--------------------------------------------------------------------------
        | ROUTE WHISPERLY
        |--------------------------------------------------------------------------
        */

        $whisperlyRoutes = [
            'login.baru',
            'login.baru.store',
            'login.baru.secret',
            'register.baru',
            'register.baru.store',
            'logout.baru',

            'whisperly',
            'whisperly.home',

            'whisperly.talents.index',
            'whisperly.talents.show',

            'whisperly.chat.index',
            'whisperly.chat.show',
            'whisperly.chat.store',

            'whisperly.bookings.store',
            'whisperly.bookings.rating.store',

            'menfess.index',
            'menfess.store',

            'menfess.admin',
            'menfess.approve',
            'menfess.reject',
            'menfess.destroy',

            'pengaduan',

            'user',

            'talent',
            'talent.edit',
            'talent.update',

            'admin',
        ];

        /*
        |--------------------------------------------------------------------------
        | LEWATI ROUTE WHISPERLY
        |--------------------------------------------------------------------------
        */

        if (
            $route &&
            (
                preg_match(
                    '/^(login\.baru|register\.baru|logout\.baru|whisperly|selamat|user|talent|admin|pengaduan|booking|menfess)/',
                    $route
                )
                ||
                in_array($route, $whisperlyRoutes, true)
            )
        ) {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | LEWATI PATH WHISPERLY
        |--------------------------------------------------------------------------
        */

        if (
            is_string($path) &&
            str_starts_with($path, 'whisperly')
        ) {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | CEK PERMISSION LARALAG
        |--------------------------------------------------------------------------
        */

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | CEK ROUTE
        |--------------------------------------------------------------------------
        */

        $can = Permission::can($route);

        if (!$can) {
            abort(403);
        }

        return $next($request);
    }
}