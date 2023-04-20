<?php

use App\Http\Controllers\User\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('user/admin/dataTable', [AdminController::class, 'table'])->name('web.admin.table');
Route::resource('user/admin', AdminController::class, [
    "as" => "web"
])->middleware('auth');
