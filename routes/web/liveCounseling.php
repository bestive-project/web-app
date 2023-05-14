<?php

use App\Http\Controllers\LiveCounselingController;
use Illuminate\Support\Facades\Route;

Route::resource('live-counseling', LiveCounselingController::class, [
    "as" => "web"
])->middleware('auth');
