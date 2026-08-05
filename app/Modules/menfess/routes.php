<?php

use Illuminate\Support\Facades\Route;
use App\Modules\menfess\Controllers\menfessController;

Route::controller(menfessController::class)->middleware(['web','auth'])->name('menfess.')->group(function(){
	Route::get('/menfess', 'index')->name('index');
	Route::get('/menfess/data', 'data')->name('data.index');
	Route::get('/menfess/create', 'create')->name('create');
	Route::post('/menfess', 'store')->name('store');
	Route::get('/menfess/{menfess}', 'show')->name('show');
	Route::get('/menfess/{menfess}/edit', 'edit')->name('edit');
	Route::patch('/menfess/{menfess}', 'update')->name('update');
	Route::get('/menfess/{menfess}/delete', 'destroy')->name('destroy');
});
