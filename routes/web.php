<?php

use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\Column\ColumnController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\UserController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get(RouteServiceProvider::HOME, HomeController::class)->name('home');

require __DIR__.'/auth.php';

Route::resource('users', UserController::class)->except(['create', 'store'])->middleware('auth');

Route::resource('users.columns', ColumnController::class)->shallow()->middleware('auth');

Route::resource('columns.cards', CardController::class)->shallow()->middleware('auth');

Route::resource('cards.comments', CommentController::class)->shallow()->middleware('auth'); 