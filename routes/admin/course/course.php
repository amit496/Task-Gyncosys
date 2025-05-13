<?php

use App\Http\Controllers\Admin\Course\CourseController;
use Illuminate\Support\Facades\Route;

Route::prefix('course')->controller(CourseController::class)->group(function () {
    Route::get('/list', 'index')->name('course.list');
    Route::get('/create/{id?}', 'create')->name('course.create');
    Route::post('/store', 'store')->name('course.store');
    Route::delete('/delete', 'destroy')->name('course.delete');
});
