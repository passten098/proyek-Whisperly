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
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->registerUser($request);

        return redirect(route('dashboard', absolute: false));
    }

    public function storeWhisperly(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:pengguna,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:pengguna,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = pengguna::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::guard('whisperly')->login($user);
        $request->session()->regenerate();

        return redirect()->route('selamat');
    }

    private function registerUser(Request $request, bool $syncPengguna = false): User
    {
        $usernameRules = ['required', 'string', 'max:255', 'unique:users,username'];
        $emailRules = ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'];

        if ($syncPengguna) {
            $usernameRules[] = 'unique:pengguna,username';
            $emailRules[] = 'unique:pengguna,email';
        }

        $request->validate([
            'username' => $usernameRules,
            'email' => $emailRules,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = DB::transaction(function () use ($request, $syncPengguna) {
            $user = User::create([
                'name' => $request->username,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($syncPengguna) {
                pengguna::create([
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'user',
                ]);
            }

            UserRole::create([
                'id_user' => $user->id,
                'id_role' => Role::where('role', 'Admin')->firstOrFail()->id,
            ]);

            return $user;
        });

        event(new Registered($user));
        Auth::login($user);

        return $user;
    }
}