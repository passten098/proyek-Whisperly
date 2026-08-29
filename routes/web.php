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

Route::view('/', 'welcome')
    ->name('frontend.index');


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
|
| Semua user yang sudah login bisa mengakses bagian umum.
|
*/

Route::middleware([
    'whisperly.guest.redirect',
    'auth:whisperly'
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HOME WHISPERLY
    |--------------------------------------------------------------------------
    */

    Route::view('/whisperly', 'whisperly.home')
        ->name('whisperly.home');


    /*
    |--------------------------------------------------------------------------
    | SELAMAT / REDIRECT SESUAI ROLE
    |--------------------------------------------------------------------------
    |
    | PENTING:
    |
    | User   -> /user
    | Talent -> /talent/edit
    | Admin  -> /admin
    |
    */

    Route::get('/selamat', [
        WhisperlyTalentController::class,
        'landing'
    ])->name('selamat');


    /*
    |--------------------------------------------------------------------------
    | BOOKING
    |--------------------------------------------------------------------------
    */

    Route::view('/booking', 'whisperly.booking')
        ->name('booking');


    /*
    |--------------------------------------------------------------------------
    | DAFTAR TALENT
    |--------------------------------------------------------------------------
    |
    | Ini digunakan oleh USER untuk melihat talent.
    |
    */

    Route::get('/whisperly/talents', [
        WhisperlyTalentController::class,
        'index'
    ])->name('whisperly.talents.index');


    /*
    |--------------------------------------------------------------------------
    | DETAIL TALENT
    |--------------------------------------------------------------------------
    */

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
|
| Hanya role USER yang bisa melakukan booking dan rating.
|
*/

Route::middleware([
    'whisperly.guest.redirect',
    'auth:whisperly',
    'whisperly.role:user'
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | BOOKING TALENT
    |--------------------------------------------------------------------------
    */

    Route::post('/whisperly/talents/{username}/booking', [
        WhisperlyBookingController::class,
        'store'
    ])->name('whisperly.bookings.store');


    /*
    |--------------------------------------------------------------------------
    | RATING
    |--------------------------------------------------------------------------
    */

    Route::post('/whisperly/bookings/{booking}/rating', [
        WhisperlyBookingController::class,
        'storeRating'
    ])->name('whisperly.bookings.rating.store');


    /*
    |--------------------------------------------------------------------------
    | HALAMAN USER
    |--------------------------------------------------------------------------
    */

    Route::view('/user', 'user')
        ->name('user');
});


/*
|--------------------------------------------------------------------------
| WHISPERLY ADMIN
|--------------------------------------------------------------------------
|
| Hanya role ADMIN yang bisa masuk.
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
    */

    Route::get('/admin/menfess', [
        menfessController::class,
        'adminIndex'
    ])->name('menfess.admin');


    /*
    |--------------------------------------------------------------------------
    | APPROVE MENFESS
    |--------------------------------------------------------------------------
    */

    Route::patch('/admin/menfess/{menfess}/approve', [
        menfessController::class,
        'approve'
    ])->name('menfess.approve');


    /*
    |--------------------------------------------------------------------------
    | REJECT MENFESS
    |--------------------------------------------------------------------------
    */

    Route::patch('/admin/menfess/{menfess}/reject', [
        menfessController::class,
        'reject'
    ])->name('menfess.reject');

    Route::delete('/admin/menfess/{id}', [
        menfessController::class,
        'destroy'
    ])->name('menfess.destroy');
});


/*
|--------------------------------------------------------------------------
| WHISPERLY TALENT
|--------------------------------------------------------------------------
|
| Hanya role TALENT yang bisa mengakses bagian ini.
|
*/

Route::middleware([
    'whisperly.guest.redirect',
    'auth:whisperly',
    'whisperly.role:talent'
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HALAMAN PROFIL TALENT SENDIRI
    |--------------------------------------------------------------------------
    */

    Route::get('/talent', [
        WhisperlyTalentController::class,
        'own'
    ])->name('talent');


    /*
    |--------------------------------------------------------------------------
    | EDIT PROFIL TALENT
    |--------------------------------------------------------------------------
    |
    | Talent hanya bisa mengedit profilnya sendiri.
    |
    */

    Route::get('/talent/edit', [
        WhisperlyTalentController::class,
        'edit'
    ])->name('talent.edit');


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFIL + JADWAL
    |--------------------------------------------------------------------------
    */

    Route::put('/talent', [
        WhisperlyTalentController::class,
        'update'
    ])->name('talent.update');
});


/*
|--------------------------------------------------------------------------
| LARALAG DASHBOARD
|--------------------------------------------------------------------------
|
| Dashboard Laralag menggunakan guard "web".
|
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | GANTI ROLE
    |--------------------------------------------------------------------------
    */

    Route::get('/role/set/{id_role}', [
        DashboardController::class,
        'changeRole'
    ])->name('dashboard.change.role');


    /*
    |--------------------------------------------------------------------------
    | FORCE LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::get('/forcelogout', [
        DashboardController::class,
        'forceLogout'
    ])->name('dashboard.force.logout');


    /*
    |--------------------------------------------------------------------------
    | PROFILE LARALAG
    |--------------------------------------------------------------------------
    */

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
| AUTH ROUTES LARALAG
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';