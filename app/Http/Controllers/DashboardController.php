<?php

namespace App\Http\Controllers;

use App\Helpers\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function changeRole($id_role)
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil user yang sedang login
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.baru');
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil semua role milik user
        |--------------------------------------------------------------------------
        */

        $roles = Permission::getRole($user->id);

        if ($roles->count() == 0) {
            abort(403, 'User belum memiliki role.');
        }

        /*
        |--------------------------------------------------------------------------
        | Cari role yang dipilih
        |--------------------------------------------------------------------------
        */

        $active_role = $roles->where('id', $id_role)->first();

        if (!$active_role) {
            abort(403, 'Role tidak dimiliki oleh user ini.');
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil menu berdasarkan ROLE ID
        |--------------------------------------------------------------------------
        */

        $menus = Permission::getMenu($active_role->id);

        /*
        |--------------------------------------------------------------------------
        | Ambil privilege berdasarkan ROLE ID
        |--------------------------------------------------------------------------
        */

        $privileges = Permission::getPrivilege($active_role->id);

        $privileges = $privileges->mapWithKeys(function ($item) {
            return [
                $item->module => [
                    'create'   => $item->create,
                    'read'     => $item->read,
                    'update'   => $item->update,
                    'delete'   => $item->delete,
                    'show_menu' => $item->show_menu,
                ]
            ];
        });

        /*
        |--------------------------------------------------------------------------
        | Simpan semuanya ke session
        |--------------------------------------------------------------------------
        */

        session([
            'menus'       => $menus,
            'roles'       => $roles->pluck('role', 'id')->all(),
            'privileges'  => $privileges->all(),
            'active_role' => [
                'id'   => $active_role->id,
                'role' => $active_role->role,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Kembali ke dashboard
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('dashboard')
            ->with(
                'message_success',
                'Berhasil menggunakan role ' . $active_role->role
            );
    }

    public function forceLogout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Logout dari guard yang sedang digunakan Laralag
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.baru');
    }
}