<?php

use App\Http\Controllers\User\AdminController;
use Illuminate\Support\Facades\Route;

Route::resource('user/admin', AdminController::class, [
    "as" => "web"
])->middleware('auth');
