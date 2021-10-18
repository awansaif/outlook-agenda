<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    HomeController
};

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/callback', [AuthController::class, 'callback'])->name('callback');



Route::get('/signout', [AuthController::class, 'signout'])->name('logout');


Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
