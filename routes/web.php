<?php

use App\Http\Controllers\AirController;
use Illuminate\Support\Facades\Route;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Notifications\AirQualityNotification;


Route::get('/send-test-email', function () {
    $user = User::find(2);  // Ganti dengan ID pengguna yang valid

    $message = 'This is a test email from Laravel using Mailable';  // Pesan uji

    // Kirimkan email menggunakan Mailable
    $user->notify(new AirQualityNotification('Good', $message));

    return 'Email sent successfully!';
});

Route::post('/air/add', [AirController::class, 'addAirQuality']);
Route::post('/air/update/{id}', [AirController::class, 'updateAirQuality']);






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

