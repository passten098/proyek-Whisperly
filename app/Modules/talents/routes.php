<?php

use Illuminate\Support\Facades\Route;
use App\Modules\talents\Controllers\talentsController;

Route::controller(talentsController::class)->middleware(['web','auth'])->name('talents.')->group(function(){
	Route::get('/talents', 'index')->name('index');
	Route::get('/talents/data', 'data')->name('data.index');
	Route::get('/talents/create', 'create')->name('create');
	Route::post('/talents', 'store')->name('store');
	Route::get('/talents/{talents}', 'show')->name('show');
	Route::get('/talents/{talents}/edit', 'edit')->name('edit');
	Route::patch('/talents/{talents}', 'update')->name('update');
	Route::get('/talents/{talents}/delete', 'destroy')->name('destroy');
});
