<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\WhisperlyLoginRequest;
use App\Modules\pengguna\Models\pengguna;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(
            route('dashboard', absolute: false)
        );
    }

    /**
     * Login Whisperly.
     */
    public function storeWhisperly(
        WhisperlyLoginRequest $request
    ): RedirectResponse {

        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::guard('whisperly')->user();

        $role = strtolower(
            (string) $user->role
        );

        /*
        |--------------------------------------------------------------------------
        | Pastikan role akun valid
        |--------------------------------------------------------------------------
        */

        if (!in_array(
            $role,
            ['admin', 'talent', 'user'],
            true
        )) {

            Auth::guard('whisperly')->logout();

            throw ValidationException::withMessages([
                'username' =>
                    'Role akun belum dapat mengakses Whisperly.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Setelah login semua role masuk ke halaman utama Whisperly
        |--------------------------------------------------------------------------
        |
        | User   -> /whisperly
        | Talent -> /whisperly
        | Admin  -> /whisperly
        |
        */

        return redirect()->route(
            'whisperly.home'
        );
    }

    /**
     * Login admin menggunakan username + password.
     */
    public function secretWhisperly(
        Request $request
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | VALIDASI INPUT ADMIN
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'secret_username' => [
                'required',
                'string',
            ],

            'secret_password' => [
                'required',
                'string',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI AKUN ADMIN BERDASARKAN USERNAME
        |--------------------------------------------------------------------------
        */

        $admin = pengguna::query()
            ->whereRaw(
                'LOWER(username) = ?',
                [
                    strtolower(
                        trim(
                            $request->input(
                                'secret_username'
                            )
                        )
                    ),
                ]
            )
            ->where('role', 'admin')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | USERNAME ADMIN TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

        if (!$admin) {

            throw ValidationException::withMessages([
                'secret_username' =>
                    'Username admin tidak ditemukan.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CEK PASSWORD ADMIN
        |--------------------------------------------------------------------------
        */

        if (
            !$admin->password ||
            !Hash::check(
                $request->input('secret_password'),
                $admin->password
            )
        ) {

            throw ValidationException::withMessages([
                'secret_password' =>
                    'Password admin salah.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | LOGIN ADMIN KE GUARD WHISPERLY
        |--------------------------------------------------------------------------
        */

        Auth::guard('whisperly')->login(
            $admin
        );


        /*
        |--------------------------------------------------------------------------
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | MASUK KE HOME WHISPERLY
        |--------------------------------------------------------------------------
        */

        return redirect()->route(
            'whisperly.home'
        );
    }

    /**
     * Logout Whisperly.
     */
    public function destroyWhisperly(
        Request $request
    ): RedirectResponse {

        Auth::guard('whisperly')->logout();

        $request->session()->regenerateToken();

        return redirect()->route(
            'login.baru'
        );
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(
        Request $request
    ): RedirectResponse {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}