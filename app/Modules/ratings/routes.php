<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ratings\Controllers\ratingsController;

Route::controller(ratingsController::class)->middleware(['web','auth'])->name('ratings.')->group(function(){
	Route::get('/ratings', 'index')->name('index');
	Route::get('/ratings/data', 'data')->name('data.index');
	Route::get('/ratings/create', 'create')->name('create');
	Route::post('/ratings', 'store')->name('store');
	Route::get('/ratings/{ratings}', 'show')->name('show');
	Route::get('/ratings/{ratings}/edit', 'edit')->name('edit');
	Route::patch('/ratings/{ratings}', 'update')->name('update');
	Route::get('/ratings/{ratings}/delete', 'destroy')->name('destroy');
});
