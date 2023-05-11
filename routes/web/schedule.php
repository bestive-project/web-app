<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::prefix("schedule")->middleware("auth")->group(function () {
    Route::get('/live-class', [ScheduleController::class, 'liveClass'])->name('web.schedule.live-class');
});
