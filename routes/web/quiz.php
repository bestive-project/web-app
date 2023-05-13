<?php

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::resource('quiz', QuizController::class, [
    "as" => "web"
])->middleware('auth');
