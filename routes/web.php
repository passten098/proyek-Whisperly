<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WhisperlyTalentController;
use App\Http\Controllers\WhisperlyBookingController;
use App\Modules\menfess\Controllers\menfessController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('frontend.index');


/*
|--------------------------------------------------------------------------
| WHISPERLY AUTH
|--------------------------------------------------------------------------
*/

Route::view('/login-baru', 'login')
    ->name('login.baru');

Route::post('/login-baru', [
    AuthenticatedSessionController::class,
    'storeWhisperly'
])->name('login.baru.store');

Route::post('/login-baru/secret', [
    AuthenticatedSessionController::class,
    'secretWhisperly'
])
    ->middleware('throttle:5,1')
    ->name('login.baru.secret');

Route::post('/logout-baru', [
    AuthenticatedSessionController::class,
    'destroyWhisperly'
])->name('logout.baru');


/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::view('/register-baru', 'register-baru')
    ->name('register.baru');

Route::post('/register-baru', [
    RegisteredUserController::class,
    'storeWhisperly'
])->name('register.baru.store');


/*
|--------------------------------------------------------------------------
| WHISPERLY UMUM
|--------------------------------------------------------------------------
*/

Route::middleware([
    'whisperly.guest.redirect',
    'auth:whisperly'
])->group(function () {

    Route::view('/whisperly', 'whisperly.home')
        ->name('whisperly.home');

    Route::view('/selamat', 'whisperly.home')
        ->name('selamat');

    Route::view('/booking', 'whisperly.booking')
        ->name('booking');


    /*
    |--------------------------------------------------------------------------
    | TALENTS
    |--------------------------------------------------------------------------
    */

    Route::get('/whisperly/talents', [
        WhisperlyTalentController::class,
        'index'
    ])->name('whisperly.talents.index');

    Route::get('/whisperly/talents/{username}', [
        WhisperlyTalentController::class,
        'show'
    ])->name('whisperly.talents.show');


    /*
    |--------------------------------------------------------------------------
    | CHAT
    |--------------------------------------------------------------------------
    */

    Route::get('/whisperly/chat', [
        \App\Http\Controllers\WhisperlyChatController::class,
        'index'
    ])->name('whisperly.chat.index');

    Route::get('/whisperly/chat/{booking}', [
        \App\Http\Controllers\WhisperlyChatController::class,
        'show'
    ])->name('whisperly.chat.show');

    Route::post('/whisperly/chat/{booking}', [
        \App\Http\Controllers\WhisperlyChatController::class,
        'store'
    ])->name('whisperly.chat.store');
});


/*
|--------------------------------------------------------------------------
| WHISPERLY USER
|--------------------------------------------------------------------------
*/

Route::middleware([
    'whisperly.guest.redirect',
    'auth:whisperly',
    'whisperly.role:user'
])->group(function () {

    Route::post('/whisperly/talents/{username}/booking', [
        WhisperlyBookingController::class,
        'store'
    ])->name('whisperly.bookings.store');

    Route::post('/whisperly/bookings/{booking}/rating', [
        WhisperlyBookingController::class,
        'storeRating'
    ])->name('whisperly.bookings.rating.store');


    Route::view('/user', 'user')
        ->name('user');
});


/*
|--------------------------------------------------------------------------
| WHISPERLY ADMIN
|--------------------------------------------------------------------------
|
| /admin
|       = Dashboard Admin
|
| /admin/menfess
|       = Halaman ACC / Tolak Menfess
|
*/

Route::middleware([
    'whisperly.guest.redirect',
    'auth:whisperly',
    'whisperly.role:admin'
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin', [
        WhisperlyTalentController::class,
        'admin'
    ])->name('admin');


    /*
    |--------------------------------------------------------------------------
    | MODERASI MENFESS
    |--------------------------------------------------------------------------
    |
    | PENTING:
    | Gunakan adminIndex(), BUKAN index().
    |
    */

    Route::get('/admin/menfess', [
        menfessController::class,
        'adminIndex'
    ])->name('admin.menfess.index');


    /*
    |--------------------------------------------------------------------------
    | ACC MENFESS
    |--------------------------------------------------------------------------
    */

    Route::post('/admin/menfess/{menfess}/approve', [
        menfessController::class,
        'approve'
    ])->name('pengaduan.approve');


    /*
    |--------------------------------------------------------------------------
    | TOLAK MENFESS
    |--------------------------------------------------------------------------
    */

    Route::post('/admin/menfess/{menfess}/reject', [
        menfessController::class,
        'reject'
    ])->name('pengaduan.reject');
});


/*
|--------------------------------------------------------------------------
| WHISPERLY TALENT
|--------------------------------------------------------------------------
*/

Route::middleware([
    'whisperly.guest.redirect',
    'auth:whisperly',
    'whisperly.role:talent'
])->group(function () {

    Route::get('/talent', [
        WhisperlyTalentController::class,
        'own'
    ])->name('talent');

    Route::put('/talent', [
        WhisperlyTalentController::class,
        'update'
    ])->name('talent.update');

    Route::get('/talent/edit', [
        WhisperlyTalentController::class,
        'edit'
    ])->name('talent.edit');
});


/*
|--------------------------------------------------------------------------
| LARALAG DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');

    Route::get('/role/set/{id_role}', [
        DashboardController::class,
        'changeRole'
    ])->name('dashboard.change.role');

    Route::get('/forcelogout', [
        DashboardController::class,
        'forceLogout'
    ])->name('dashboard.force.logout');

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';