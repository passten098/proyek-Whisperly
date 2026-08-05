<?php

use Illuminate\Support\Facades\Route;
use App\Modules\bookings\Controllers\bookingsController;

Route::controller(bookingsController::class)->middleware(['web','auth'])->name('bookings.')->group(function(){
	Route::get('/bookings', 'index')->name('index');
	Route::get('/bookings/data', 'data')->name('data.index');
	Route::get('/bookings/create', 'create')->name('create');
	Route::post('/bookings', 'store')->name('store');
	Route::get('/bookings/{bookings}', 'show')->name('show');
	Route::get('/bookings/{bookings}/edit', 'edit')->name('edit');
	Route::patch('/bookings/{bookings}', 'update')->name('update');
	Route::get('/bookings/{bookings}/delete', 'destroy')->name('destroy');
});
