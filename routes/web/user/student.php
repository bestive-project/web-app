<?php

use App\Http\Controllers\User\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('user/student')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('web.student.index');
    Route::get('/dataTable', [StudentController::class, 'table'])->name('web.student.table');
    Route::get('/{id}', [StudentController::class, 'show'])->name('web.student.show');
    Route::post('/assign-group/{userId}', [StudentController::class, 'assignGroup'])->name('web.student.assign-group');
    Route::put('/{id}', [StudentController::class, 'update'])->name('web.student.update');
});
