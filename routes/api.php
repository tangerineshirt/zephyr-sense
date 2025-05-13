<?php

use App\Http\Controllers\AirController;
use Illuminate\Support\Facades\Route;

Route::post('/sensor', [AirController::class, 'sensor']);
Route::get('/test', function(){
    return response()->json([
        "hello" => "test",
        "world" => "hello",
    ]);
});