<?php

namespace App\Listeners;

use App\Helpers\Permission;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfullLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if ($event->guard !== 'web') {
            return;
        }

        $user = $event->user;
        try {
            // get user's role
            $roles = Permission::getRole($user->getAuthIdentifier());
            if($roles->count() == 0) $this->logout();
            $active_role = $roles->first()->only(['id', 'role']);

            // get user's menu
            $menus = Permission::getMenu($active_role['id']);

            // get user's privilege
            $privileges = Permission::getPrivilege($active_role['id']);
            $privileges = $privileges->mapWithKeys(function ($item, $key) {
                                return [$item->module => [
                                    'create' => $item->create,
                                    'read' => $item->read,
                                    'show' => $item->show,
                                    'update' => $item->update,
                                    'delete' => $item->delete,
                                    'show_menu' => $item->show_menu,
                                ]];
                            });

            // store to session
            session(['menus' => $menus]);
            session(['roles' => $roles->pluck('role', 'id')->all()]);
            session(['privileges' => $privileges->all()]);
            session(['active_role' => $active_role]);
        } catch (\Throwable $th) {
            $this->logout();
        }

    }

    public function logout()
    {
        $request = request();
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
