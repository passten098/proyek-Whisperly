<?php

namespace App\Providers;

use App\Listeners\LogSuccessfullLogin;
use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\talents\Models\talents;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    Event::listen(Login::class, LogSuccessfullLogin::class);

    Paginator::useBootstrapFive();

    View::composer('whisperly.navbar', function ($view) {

        $notifications = collect();
        $notificationCount = 0;

        if (Auth::guard('whisperly')->check()) {

            $user = Auth::guard('whisperly')->user();

            if ($user->role === 'talent') {

                $talent = talents::where('pengguna_id', $user->id)->first();

                if ($talent) {

                    $notifications = WhisperlyBooking::with([
                        'pengguna',
                        'talent.pengguna',
                        'schedule',
                    ])
                    ->where('talent_id', $talent->id)
                    ->latest()
                    ->get();
                }

            } else {

                $notifications = WhisperlyBooking::with([
                    'pengguna',
                    'talent.pengguna',
                    'schedule',
                ])
                ->where('pengguna_id', $user->id)
                ->latest()
                ->get();
            }

            $notificationCount = $notifications->count();
        }

        $view->with([
            'notifications' => $notifications,
            'notificationCount' => $notificationCount,
        ]);

    });
}
}