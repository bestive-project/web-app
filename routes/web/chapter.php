<?php

use App\Http\Controllers\ChapterController;
use Illuminate\Support\Facades\Route;

Route::get('course/{id}/chapter/dataTable', [ChapterController::class, 'table'])->name('web.chapter.table');
Route::get('course/p/{courseSlug}/chapter/{chapterSlug}', [ChapterController::class, 'showBySlug'])->name('web.chapter.show.slug');
Route::resource('course/{id}/chapter', ChapterController::class, [
    "as" => "web"
])->middleware('auth');
