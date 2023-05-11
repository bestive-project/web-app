<?php

use App\Http\Controllers\LogRecordingController;
use Illuminate\Support\Facades\Route;

Route::resource('log-recording', LogRecordingController::class, [
    "as" => "web"
])->middleware('auth');
