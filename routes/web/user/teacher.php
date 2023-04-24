<?php

use App\Http\Controllers\User\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('user/teacher/dataTable', [TeacherController::class, 'table'])->name('web.teacher.table');
Route::resource('user/teacher', TeacherController::class, [
    "as" => "web"
])->middleware('auth');
