<?php

use App\Http\Controllers\DiscussionController;
use Illuminate\Support\Facades\Route;

// Route::get('user/discussion/dataTable', [StudyGroupController::class, 'table'])->name('web.study.group.table');
Route::resource('user/discussion', DiscussionController::class, [
    "as" => "web"
])->middleware('auth');
