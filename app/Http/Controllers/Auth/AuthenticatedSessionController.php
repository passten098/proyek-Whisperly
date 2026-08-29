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

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Login Whisperly
     */
    public function storeWhisperly(WhisperlyLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::guard('whisperly')->user();

        $role = strtolower((string) $user->role);

        /*
        |--------------------------------------------------------------------------
        | Pastikan role akun valid
        |--------------------------------------------------------------------------
        */

        if (!in_array($role, ['admin', 'talent', 'user'], true)) {

            Auth::guard('whisperly')->logout();

            throw ValidationException::withMessages([
                'username' => 'Role akun belum dapat mengakses Whisperly.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Setelah login SEMUA role masuk ke halaman utama Whisperly
        |--------------------------------------------------------------------------
        |
        | User  -> /whisperly
        | Talent -> /whisperly
        | Admin -> /whisperly
        |
        */

        return redirect()->route('whisperly.home');
    }

    /**
     * Login admin menggunakan password rahasia.
     */
    public function secretWhisperly(Request $request): RedirectResponse
    {
        $request->validate([
            'secret_password' => ['required', 'string'],
        ]);

        $admin = pengguna::query()
            ->where('role', 'admin')
            ->get()
            ->first(
                fn (pengguna $user) =>
                    Hash::check(
                        $request->input('secret_password'),
                        $user->password
                    )
            );

        if (!$admin) {
            throw ValidationException::withMessages([
                'secret_password' => 'Password rahasia salah.',
            ]);
        }

        Auth::guard('whisperly')->login($admin);

        $request->session()->regenerate();

        return redirect()->route('whisperly.home');
    }

    /**
     * Logout Whisperly.
     */
    public function destroyWhisperly(Request $request): RedirectResponse
    {
        Auth::guard('whisperly')->logout();

        $request->session()->regenerateToken();

        return redirect()->route('login.baru');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}