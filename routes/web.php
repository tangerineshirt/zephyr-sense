<?php

use App\Http\Controllers\AirController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AirController::class, 'showLogin'])->name('show.login');
Route::post('/', [AirController::class, 'login'])->name('login');
Route::get('/home', [AirController::class, 'home'])->name('home');
Route::get('/history', [AirController::class, 'history'])->name('history');
Route::get('/setting', [AirController::class, 'setting'])->name('setting');