<?php

use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\LessonController;
use App\Http\Controllers\Instructor\SectionController;
use App\Http\Controllers\Instructor\ProfileController; 
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Courses Management
    Route::resource('courses', CourseController::class);
    Route::get('courses/{course}/preview', [CourseController::class, 'preview'])->name('courses.preview');
    Route::post('courses/{course}/publish', [CourseController::class, 'publish'])->name('courses.publish');
    
    // Section Management
    Route::resource('courses.sections', SectionController::class)->except(['index', 'show'])->shallow();
    Route::post('sections/reorder', [SectionController::class, 'reorder'])->name('sections.reorder');

    // Lessons Management
    Route::resource('courses.sections.lessons', LessonController::class)->shallow();
    Route::post('lessons/reorder', [LessonController::class, 'reorder'])->name('lessons.reorder');
    Route::post('lessons/{lesson}/status', [LessonController::class, 'updateStatus'])->name('lessons.status');
    
    // Students & Enrollments
    Route::get('students', [DashboardController::class, 'students'])->name('students.index');
    Route::get('enrollments', [DashboardController::class, 'enrollments'])->name('enrollments.index');
    
    // Earnings & Analytics
    Route::get('earnings', [DashboardController::class, 'earnings'])->name('earnings');
    Route::get('analytics', [DashboardController::class, 'analytics'])->name('analytics');

    // Reviews
    Route::get('reviews', [DashboardController::class, 'reviews'])->name('reviews');

    // Settings & Profile Management 
    Route::prefix('settings')->name('settings.')->group(function () {
        
        // 1. General Info Tab
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
        
        // 2. Security Tab
        Route::get('/security', [ProfileController::class, 'security'])->name('security');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

        // 3. Notifications Tab
        Route::get('/notifications', [ProfileController::class, 'notifications'])->name('notifications');
        Route::put('/notifications', [ProfileController::class, 'updateNotifications'])->name('notifications.update');
    });
});