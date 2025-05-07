<?php

use App\Http\Controllers\AirController;
use Illuminate\Support\Facades\Route;

Route::post('/sensor', [AirController::class, 'sensor']);