<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('web.login.index');
});
