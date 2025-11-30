<?php

use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\ProgressController;
use App\Http\Controllers\Student\CertificateController;
use App\Http\Controllers\Student\ResourceController;
use App\Http\Controllers\Student\QuizController;
use App\Http\Controllers\Student\LessonController;
use App\Http\Controllers\Student\ProfileController;
use Illuminate\Support\Facades\Route;

// Student Routes with auth and student middleware
Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getDashboardData'])->name('dashboard.data');
    
    // My Courses
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/{course}', [CourseController::class, 'show'])->name('show');
        Route::get('/{course}/enroll', [CourseController::class, 'enroll'])->name('enroll');
        Route::get('/{course}/content', [CourseController::class, 'content'])->name('content');
        Route::post('/{course}/progress', [CourseController::class, 'updateProgress'])->name('progress.update');
        
        // New route for lesson player
        Route::get('/{course}/lessons/{lesson}', [CourseController::class, 'showLesson'])->name('lessons.show');
        Route::get('/{course}/start', [CourseController::class, 'startCourse'])->name('start');
    });
    
    // Course Lessons
    Route::prefix('lessons')->name('lessons.')->group(function () {
        Route::get('/{lesson}', [LessonController::class, 'show'])->name('show');
        Route::post('/{lesson}/complete', [LessonController::class, 'markComplete'])->name('complete');
        Route::post('/{lesson}/note', [LessonController::class, 'addNote'])->name('note.add');
        Route::post('/{lesson}/progress', [LessonController::class, 'updateProgress'])->name('progress.update');
    });
    
    // Quizzes & Assignments
    Route::prefix('quizzes')->name('quizzes.')->group(function () {
        Route::get('/', [QuizController::class, 'index'])->name('index');
        Route::get('/{quiz}', [QuizController::class, 'show'])->name('show');
        Route::post('/{quiz}/start', [QuizController::class, 'start'])->name('start');
        Route::post('/{quiz}/submit', [QuizController::class, 'submit'])->name('submit');
        Route::get('/{quiz}/result', [QuizController::class, 'result'])->name('result');
    });
    
    // Progress Tracking
    Route::prefix('progress')->name('progress.')->group(function () {
        Route::get('/', [ProgressController::class, 'index'])->name('index');
        Route::get('/overview', [ProgressController::class, 'overview'])->name('overview');
        Route::get('/course/{course}', [ProgressController::class, 'courseProgress'])->name('course');
        Route::get('/analytics', [ProgressController::class, 'analytics'])->name('analytics');
    });
    
    // Certificates
    Route::prefix('certificates')->name('certificates.')->group(function () {
        Route::get('/', [CertificateController::class, 'index'])->name('index');
        Route::get('/{certificate}', [CertificateController::class, 'show'])->name('show');
        Route::get('/{certificate}/download', [CertificateController::class, 'download'])->name('download');
        Route::get('/{certificate}/share', [CertificateController::class, 'share'])->name('share');
        Route::get('/verify', [CertificateController::class, 'verify'])->name('verify');
    });
    
    // Resources
    Route::prefix('resources')->name('resources.')->group(function () {
        Route::get('/', [ResourceController::class, 'index'])->name('index');
        Route::get('/download/{resource}', [ResourceController::class, 'download'])->name('download');
        Route::get('/course/{course}', [ResourceController::class, 'courseResources'])->name('course');
    });
    
    // Profile & Settings
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::get('/security', [ProfileController::class, 'security'])->name('security');
        Route::put('/security', [ProfileController::class, 'updateSecurity'])->name('security.update');
        Route::get('/notifications', [ProfileController::class, 'notifications'])->name('notifications');
        Route::put('/notifications', [ProfileController::class, 'updateNotifications'])->name('notifications.update');
    });
    
    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [DashboardController::class, 'notifications'])->name('index');
        Route::post('/mark-all-read', [DashboardController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::get('/{notification}', [DashboardController::class, 'showNotification'])->name('show');
        Route::delete('/{notification}', [DashboardController::class, 'deleteNotification'])->name('destroy');
    });
});