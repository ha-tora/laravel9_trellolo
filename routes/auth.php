<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login', [LoginController::class, 'create'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::get('/register', [RegisterController::class, 'create'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store')    
    ->middleware('guest');

Route::post('/logout', [LogoutController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');