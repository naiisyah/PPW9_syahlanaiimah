<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegistrasiController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginRegistrasiController::class, 'login'])->name('login');
    Route::get('/register', [LoginRegistrasiController::class, 'register'])->name('register');
    Route::post('/store', [LoginRegistrasiController::class, 'store'])->name('store');
    Route::post('/authenticate', [LoginRegistrasiController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginRegistrasiController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginRegistrasiController::class, 'logout'])->name('logout');
});
