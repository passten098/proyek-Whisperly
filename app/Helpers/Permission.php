<?php

namespace App\Helpers;

use App\Models\User;
use App\Modules\Menu\Models\Menu;
use App\Modules\Role\Models\Role;
use App\Modules\Privilege\Models\Privilege;

class Permission
{
    public static function can($route)
    {
        if (empty($route)) {
            return true;
        }

        $elm = explode('.', $route);

        $menu = reset($elm);
        $action = end($elm);

        $exceptions = config('laralag.module_exception');

        if (in_array($menu, $exceptions)) {
            return true;
        }

        $action = config('laralag.translate_action')[$action] ?? null;

        $privileges = session('privileges', []);

        return $privileges[$menu][$action] ?? true;
    }


    /**
     * Ambil menu berdasarkan role
     */
    public static function getMenu($id_role)
    {
        $role = Role::find($id_role);

        if (!$role) {
            return [];
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil menu parent/group
        |--------------------------------------------------------------------------
        */

        $groups = Menu::where('level', 0)
            ->where('is_tampil', 1)
            ->orderBy('urutan')
            ->get([
                'menu.id',
                'icon',
                'menu',
                'routing',
                'level',
                'urutan',
                'parent_id'
            ])
            ->all();

        /*
        |--------------------------------------------------------------------------
        | Ambil menu yang boleh diakses role
        |--------------------------------------------------------------------------
        */

        $menus = $role->menu()
            ->orderBy('urutan')
            ->get([
                'menu.id',
                'icon',
                'menu',
                'routing',
                'level',
                'urutan',
                'parent_id'
            ])
            ->all();

        return array_merge($groups, $menus);
    }


    /**
     * Ambil role milik user
     */
    public static function getRole($id_user)
    {
        $user = User::with('roleuser')->find($id_user);

        if (!$user) {
            return collect();
        }

        return $user->roleuser()
            ->orderBy('level')
            ->get();
    }


    /**
     * Ambil privilege berdasarkan role
     */
    public static function getPrivilege($id_role)
    {
        return Privilege::leftJoin(
                'menu as m',
                'm.id',
                '=',
                'id_menu'
            )
            ->where('id_role', $id_role)
            ->get([
                'module',
                'create',
                'read',
                'show',
                'update',
                'delete',
                'show_menu'
            ]);
    }
}