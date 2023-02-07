<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\UserController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get(RouteServiceProvider::HOME, HomeController::class)->name('home');

require __DIR__.'/auth.php';