<?php

use Illuminate\Support\Facades\Route;
use App\Modules\pengguna\Controllers\penggunaController;

Route::controller(penggunaController::class)->middleware(['web','auth:whisperly'])->name('pengguna.')->group(function(){
	Route::get('/pengguna', 'index')->name('index');
	Route::get('/pengguna/data', 'data')->name('data.index');
	Route::get('/pengguna/create', 'create')->name('create');
	Route::post('/pengguna', 'store')->name('store');
	
	Route::get('/profil', 'profile')->name('profile');
	Route::patch('/profil', 'updateProfile')->name('profile.update');

	Route::get('/pengguna/{pengguna}', 'show')->name('show');
	Route::get('/pengguna/{pengguna}/edit', 'edit')->name('edit');
	Route::patch('/pengguna/{pengguna}', 'update')->name('update');
	Route::get('/pengguna/{pengguna}/delete', 'destroy')->name('destroy');
});
