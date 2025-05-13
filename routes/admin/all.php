<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Student\StudentController;
Route::middleware('auth')->group(function () {
    require __DIR__.'/course/course.php';

    Route::prefix('admin')->group(function() {
        Route::get('students', [StudentController::class, 'index'])->name('student.list');
        Route::get('students/export', [StudentController::class, 'export'])->name('student.export'); // <- Updated
    });

});

