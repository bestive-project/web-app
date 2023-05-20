<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

includeRouteFiles(__DIR__ . "/web/");

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('web.profile.index');
});

Route::get('/', DashboardController::class)->name('web.dashboard.index')->middleware('auth');

Route::get('/laravel-version', function () {
    return view('welcome');
});
