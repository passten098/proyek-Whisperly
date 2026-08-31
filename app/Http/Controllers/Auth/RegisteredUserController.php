<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Role\Models\Role;
use App\Modules\UserRole\Models\UserRole;
use App\Modules\pengguna\Models\pengguna;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        return view('auth.register');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER LARALAG
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $this->registerUser($request);

        return redirect(route('dashboard', absolute: false));
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER WHISPERLY
    |--------------------------------------------------------------------------
    |
    | Setelah berhasil daftar:
    |
    | 1. Data pengguna dibuat
    | 2. User langsung login
    | 3. Session diregenerate
    | 4. Langsung diarahkan ke /whisperly
    |
    */

    public function storeWhisperly(Request $request): RedirectResponse
    {
        /*
        |----------------------------------------------------------------------
        | VALIDASI
        |----------------------------------------------------------------------
        */

        $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:pengguna,username'
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:pengguna,email'
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ],
        ]);


        /*
        |----------------------------------------------------------------------
        | BUAT AKUN WHISPERLY
        |----------------------------------------------------------------------
        */

        $user = pengguna::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);


        /*
        |----------------------------------------------------------------------
        | LOGIN OTOMATIS
        |----------------------------------------------------------------------
        */

        Auth::guard('whisperly')->login($user);

        $request->session()->regenerate();


        /*
        |----------------------------------------------------------------------
        | REDIRECT KE HOME WHISPERLY
        |----------------------------------------------------------------------
        |
        | Sebelumnya:
        |
        | return redirect()->route('selamat');
        |
        | Sekarang langsung:
        |
        | /whisperly
        |
        */

        return redirect()->route('whisperly.home');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER LARALAG + SYNCHRONIZE PENGGUNA
    |--------------------------------------------------------------------------
    */

    private function registerUser(
        Request $request,
        bool $syncPengguna = false
    ): User {

        /*
        |----------------------------------------------------------------------
        | VALIDATION RULES
        |----------------------------------------------------------------------
        */

        $usernameRules = [
            'required',
            'string',
            'max:255',
            'unique:users,username'
        ];

        $emailRules = [
            'required',
            'string',
            'lowercase',
            'email',
            'max:255',
            'unique:users,email'
        ];


        /*
        |----------------------------------------------------------------------
        | JIKA SYNCHRONIZE KE TABEL PENGGUNA
        |----------------------------------------------------------------------
        */

        if ($syncPengguna) {

            $usernameRules[] =
                'unique:pengguna,username';

            $emailRules[] =
                'unique:pengguna,email';
        }


        /*
        |----------------------------------------------------------------------
        | VALIDATE REQUEST
        |----------------------------------------------------------------------
        */

        $request->validate([

            'username' => $usernameRules,

            'email' => $emailRules,

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ],

        ]);


        /*
        |----------------------------------------------------------------------
        | CREATE USER
        |----------------------------------------------------------------------
        */

        $user = DB::transaction(
            function () use ($request, $syncPengguna) {

                /*
                |--------------------------------------------------------------
                | USER
                |--------------------------------------------------------------
                */

                $user = User::create([
                    'name' => $request->username,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);


                /*
                |--------------------------------------------------------------
                | PENGGUNA
                |--------------------------------------------------------------
                */

                if ($syncPengguna) {

                    pengguna::create([
                        'username' => $request->username,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'role' => 'user',
                    ]);
                }


                /*
                |--------------------------------------------------------------
                | USER ROLE
                |--------------------------------------------------------------
                */

                UserRole::create([
                    'id_user' => $user->id,

                    'id_role' => Role::where(
                        'role',
                        'Admin'
                    )->firstOrFail()->id,
                ]);


                return $user;
            }
        );


        /*
        |----------------------------------------------------------------------
        | REGISTERED EVENT
        |----------------------------------------------------------------------
        */

        event(new Registered($user));


        /*
        |----------------------------------------------------------------------
        | LOGIN LARALAG
        |----------------------------------------------------------------------
        */

        Auth::login($user);


        return $user;
    }
}