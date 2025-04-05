<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('teacher.form');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/teacher/form', [TeacherController::class, 'index'])->name('teacher.form');
    Route::post('/teacher/selectSubject', [TeacherController::class, 'selectSubject'])->name('teacher.selectSubject');
    Route::post('/teacher/selectWeek', [TeacherController::class, 'selectWeek'])->name('teacher.selectWeek');
    Route::post('/teacher/store/{week_id}', [TeacherController::class, 'store'])->name('teacher.store');
});
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/student/form', [TeacherController::class, 'index'])->name('student.form');
    Route::post('/student/selectSubject', [TeacherController::class, 'selectSubject'])->name('student.selectSubject');
    Route::post('/student/selectWeek', [TeacherController::class, 'selectWeek'])->name('student.selectWeek');
    Route::post('/student/store/{week_id}', [TeacherController::class, 'store'])->name('student.store');
});
require __DIR__.'/auth.php';
