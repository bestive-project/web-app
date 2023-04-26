<?php

use App\Http\Controllers\StudyGroupController;
use Illuminate\Support\Facades\Route;

Route::get('user/study-group/dataTable', [StudyGroupController::class, 'table'])->name('web.study.group.table');
Route::resource('user/study-group', StudyGroupController::class, [
    "as" => "web"
])->middleware('auth');
