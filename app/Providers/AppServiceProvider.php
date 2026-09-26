<?php

namespace App\Providers;

use App\Listeners\LogSuccessfullLogin;
use App\Modules\bookings\Models\WhisperlyBooking;
use App\Modules\talents\Models\talents;
use Illuminate\Auth\Events\Login;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {

            $user = auth('whisperly')->user();

            $notifications = collect();
            $adminNotifications = collect();
            $adminNotificationCount = 0;

            if ($user) {
                $role = strtolower(trim((string) ($user->role ?? '')));

                if ($role === 'admin') {
                    $adminNotifications = $user
                        ->notifications()
                        ->latest()
                        ->get();

                    $adminNotificationCount = $user
                        ->unreadNotifications()
                        ->count();
                }

                $query = WhisperlyBooking::query()
                    ->with([
                        'pengguna',
                        'talent.pengguna',
                        'schedule',
                    ])
                    ->whereNull('deleted_at')
                    ->whereHas('schedule', function ($query) {
                        $query->whereDate(
                            'schedule_date',
                            today(config('app.timezone'))
                        );
                    });

                /*
                |--------------------------------------------------------------------------
                | PENGGUNA
                |--------------------------------------------------------------------------
                */

                if ($role === 'user') {

                    $query->where(
                        'pengguna_id',
                        $user->id
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | TALENT
                |--------------------------------------------------------------------------
                */

                elseif ($role === 'talent') {

                    $talent = talents::query()
                        ->where(
                            'pengguna_id',
                            $user->id
                        )
                        ->first();

                    if ($talent) {

                        $query->where(
                            'talent_id',
                            $talent->id
                        );
                    } else {

                        $query->whereRaw('0 = 1');
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | SINKRON STATUS + BUANG YANG SUDAH SELESAI
                |--------------------------------------------------------------------------
                */

                $notifications = $query
                    ->orderByDesc('created_at')
                    ->get()
                    ->map(function ($booking) {

                        $booking->syncChatStatus();

                        return $booking;
                    })
                    ->filter(function ($booking) {

                        return $booking->chatStatus() !== 'completed';
                    })
                    ->values();
            }

            $view->with([
                'notifications' => $notifications,
                'notificationCount' => $notifications->count(),
                'adminNotifications' => $adminNotifications,
                'adminNotificationCount' => $adminNotificationCount,
            ]);
        });

        Event::listen(Login::class, LogSuccessfullLogin::class);

        Paginator::useBootstrapFive();
    }
}