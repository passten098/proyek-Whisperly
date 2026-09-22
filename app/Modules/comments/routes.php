<?php

use Illuminate\Support\Facades\Route;
use App\Modules\comments\Controllers\commentsController;

Route::controller(commentsController::class)
    ->middleware(['web', 'auth:whisperly'])
    ->name('comments.')
    ->group(function () {

        Route::get('/comments', 'index')
            ->name('index');

        Route::get('/comments/data', 'data')
            ->name('data.index');

        Route::get('/comments/create', 'create')
            ->name('create');

        Route::post('/comments', 'store')
            ->name('store');

        Route::get('/comments/{comments}', 'show')
            ->name('show');

        Route::get('/comments/{comments}/edit', 'edit')
            ->name('edit');

        Route::patch('/comments/{comments}', 'update')
            ->name('update');

        Route::delete('/comments/{comments}', 'destroy')
            ->name('destroy');
    });