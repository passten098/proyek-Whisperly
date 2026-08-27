<?php

use App\Modules\menfess\Controllers\menfessController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth:whisperly'])->group(function () {
    Route::get('/pengaduan', [menfessController::class, 'publicIndex'])->name('pengaduan');
    Route::post('/pengaduan', [menfessController::class, 'store'])->name('pengaduan.store');
    Route::post('/pengaduan/{menfess}/comments', [menfessController::class, 'addComment'])->name('pengaduan.comments.store');
});

Route::middleware(['web', 'auth:whisperly', 'whisperly.role:admin'])->group(function () {
    Route::get('/admin/menfess', [menfessController::class, 'adminIndex'])->name('admin.menfess.index');
    Route::post('/pengaduan/{menfess}/approve', [menfessController::class, 'approve'])->name('pengaduan.approve');
    Route::post('/pengaduan/{menfess}/reject', [menfessController::class, 'reject'])->name('pengaduan.reject');
});

Route::controller(menfessController::class)->middleware(['web', 'auth'])->name('menfess.')->group(function () {
    Route::get('/menfess', 'index')->name('index');
    Route::get('/menfess/data', 'data')->name('data.index');
    Route::get('/menfess/create', 'create')->name('create');
    Route::post('/menfess', 'store')->name('store');
    Route::get('/menfess/{menfess}', 'show')->name('show');
    Route::get('/menfess/{menfess}/edit', 'edit')->name('edit');
    Route::patch('/menfess/{menfess}', 'update')->name('update');
    Route::get('/menfess/{menfess}/delete', 'destroy')->name('destroy');
});
