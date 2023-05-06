<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('course/dataTable', [CourseController::class, 'table'])->name('web.course.table');
Route::get('course/update-status/{id}', [CourseController::class, 'updateStatus'])->name('web.course.update.status');
Route::resource('course', CourseController::class, [
    "as" => "web"
])->middleware('auth');
