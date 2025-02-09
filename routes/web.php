<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\EventController;
use App\Http\Controllers\front\FrontController;

// Route::get('/', function () {
//     return view('front.index');
// });

Route::controller(FrontController::class)->group(function () {
    Route::get('/','index');
});

Route::controller(EventController::class)->group(function () {
    Route::get('events/{slug}', 'event');
});
