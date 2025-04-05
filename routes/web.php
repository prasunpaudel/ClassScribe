<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
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
Route::middleware(['auth'])->group(function () {
    Route::get('/student/display', [StudentController::class, 'index'])->name('student.display');
    Route::post('/student/selectWeek', [StudentController::class, 'selectWeek'])->name('student.selectWeek');
});
Route::post('/student/saveNote/{week_id}', [StudentController::class, 'saveNote'])->name('student.saveNote');
require __DIR__.'/auth.php';
