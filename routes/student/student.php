<?php

use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {
    Route::get('/', [StudentController::class, 'showRegistrationForm'])->name('student.register');
    Route::post('/store', [StudentController::class, 'storeStudentDetails'])->name('student.store');
    Route::get('/course/{course_id}', [StudentController::class, 'showCourseDetails'])->name('student.showCourse');
    Route::get('/change-course', [StudentController::class, 'changeCourse'])->name('student.changeCourse');
    Route::post('/update-course', [StudentController::class, 'updateCourse'])->name('student.updateCourse');
    Route::post('/confirm', [StudentController::class, 'showConfirmation'])->name('student.confirm');
    Route::post('/submit-final', [StudentController::class, 'submitFinal'])->name('student.enroll');
    Route::get('/thankyou', [StudentController::class, 'thankYou'])->name('student.thankyou');
});
