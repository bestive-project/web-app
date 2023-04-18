<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('web.login.index');
    Route::post('/', [LoginController::class, 'process'])->name('web.login.process');
});

Route::get('logout', LogoutController::class)->name('web.login.logout');
