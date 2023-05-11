<?php

use App\Http\Controllers\LiveClassController;
use Illuminate\Support\Facades\Route;

Route::get('live-class/dataTable', [LiveClassController::class, 'table'])->name('web.live-class.table');
Route::resource('live-class', LiveClassController::class, [
    "as" => "web"
])->middleware('auth');
