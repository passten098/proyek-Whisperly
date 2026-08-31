<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WhisperlyTalentController;
use App\Http\Controllers\WhisperlyBookingController;
use App\Http\Controllers\WhisperlyChatController;
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

/*
|--------------------------------------------------------------------------
| LOGIN
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
| Semua user yang login menggunakan guard whisperly
| dapat mengakses halaman umum Whisperly.
|
*/

Route::middleware([
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
    | DAFTAR TALENT
    |--------------------------------------------------------------------------
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
    | RUANG PENGADUAN - USER / TALENT
    |--------------------------------------------------------------------------
    |
    | INI ROUTE YANG SEBELUMNYA BELUM ADA.
    |
    | Route ini memanggil:
    |
    | menfessController@publicIndex
    |
    */

    Route::get('/whisperly/pengaduan', [
        menfessController::class,
        'publicIndex'
    ])->name('pengaduan');


    /*
    |--------------------------------------------------------------------------
    | KIRIM PENGADUAN / MENFESS
    |--------------------------------------------------------------------------
    */

    Route::post('/whisperly/pengaduan', [
        menfessController::class,
        'store'
    ])->name('pengaduan.store');


    /*
    |--------------------------------------------------------------------------
    | DETAIL MENFESS
    |--------------------------------------------------------------------------
    */

    Route::get('/whisperly/pengaduan/{menfess}', [
        menfessController::class,
        'show'
    ])->name('pengaduan.show');


    /*
    |--------------------------------------------------------------------------
    | KOMENTAR MENFESS
    |--------------------------------------------------------------------------
    */

    Route::post('/whisperly/pengaduan/{menfess}/comment', [
        menfessController::class,
        'addComment'
    ])->name('pengaduan.comment');


    /*
    |--------------------------------------------------------------------------
    | CHAT
    |--------------------------------------------------------------------------
    */

    Route::get('/whisperly/chat', [
        WhisperlyChatController::class,
        'index'
    ])->name('whisperly.chat.index');


    Route::get('/whisperly/chat/{booking}', [
        WhisperlyChatController::class,
        'show'
    ])->name('whisperly.chat.show');


    Route::post('/whisperly/chat/{booking}', [
        WhisperlyChatController::class,
        'store'
    ])->name('whisperly.chat.store');

});


/*
|--------------------------------------------------------------------------
| WHISPERLY USER
|--------------------------------------------------------------------------
|
| Khusus role USER.
|
*/

Route::middleware([
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
| Khusus role ADMIN.
|
*/

Route::middleware([
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
    | MENFESS ADMIN
    |--------------------------------------------------------------------------
    |
    | Halaman ini khusus admin.
    |
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


    /*
    |--------------------------------------------------------------------------
    | HAPUS MENFESS
    |--------------------------------------------------------------------------
    */

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
| Khusus role TALENT.
|
*/

Route::middleware([
    'auth:whisperly',
    'whisperly.role:talent'
])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | PROFIL TALENT SENDIRI
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
| Bagian ini menggunakan guard "web".
|
*/

Route::middleware([
    'auth'
])->group(function () {


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

require __DIR__ . '/auth.php';