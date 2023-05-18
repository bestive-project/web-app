<?php

use App\Http\Controllers\HelpCenterController;
use Illuminate\Support\Facades\Route;

Route::get('help-center/dataTable', [HelpCenterController::class, 'table'])->name('web.help-center.table');
Route::resource('help-center', HelpCenterController::class, [
    "as" => "web"
])->middleware('auth');
