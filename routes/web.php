<?php

use App\Http\Controllers\AirController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', [AirController::class, 'logout'])->name('logout');

Route::middleware('guest')->controller(AirController::class)->group(function(){
    Route::get('/register', 'showRegister')->name('show.register');
    Route::post('/register', 'register')->name('register');
    Route::get('/', 'showLogin')->name('show.login');
    Route::post('/', 'login')->name('login');
});

Route::middleware('auth')->controller(AirController::class)->group(function(){
    Route::get('/home', 'home')->name('home');
    Route::get('/history', 'history')->name('history');
    Route::get('/setting', 'setting')->name('setting');
});

