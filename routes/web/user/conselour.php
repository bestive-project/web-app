<?php

use App\Http\Controllers\User\ConselourController;
use Illuminate\Support\Facades\Route;

Route::get('user/conselour/dataTable', [ConselourController::class, 'table'])->name('web.conselour.table');
Route::resource('user/conselour', ConselourController::class, [
    "as" => "web"
])->middleware('auth');
