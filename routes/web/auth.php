<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('web.login.index');
    Route::post('/', [LoginController::class, 'process'])->name('web.login.process');
});

Route::prefix('register')->middleware('guest')->group(function () {
    Route::get('/', [RegisterController::class, 'index'])->name('web.register.index');
    Route::post('/', [RegisterController::class, 'process'])->name('web.register.process');
});

Route::post('logout', LogoutController::class)->name('web.logout');
