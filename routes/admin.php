<?php

use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin Routes with auth and admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard view
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard data (AJAX)
    Route::get('/dashboard/data', [DashboardController::class, 'getDashboardData'])->name('dashboard.data');
        
    
    // Users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/students', [UserController::class, 'students'])->name('students');
        Route::get('/instructors', [UserController::class, 'instructors'])->name('instructors');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/status', [UserController::class, 'updateStatus'])->name('status');
    });
    
    // Courses Management
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/create', [CourseController::class, 'create'])->name('create');
        Route::post('/', [CourseController::class, 'store'])->name('store');
        Route::get('/{course}', [CourseController::class, 'show'])->name('show');
        Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit');
        Route::put('/{course}', [CourseController::class, 'update'])->name('update');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
        Route::post('/{course}/status', [CourseController::class, 'updateStatus'])->name('status');
        Route::get('/{course}/stats', [CourseController::class, 'stats'])->name('stats');
    });
    
    // Sections Management
    Route::prefix('sections')->name('sections.')->group(function () {
        Route::get('/', [SectionController::class, 'index'])->name('index');
        Route::get('/create', [SectionController::class, 'create'])->name('create');
        Route::post('/', [SectionController::class, 'store'])->name('store');
        Route::get('/{section}', [SectionController::class, 'show'])->name('show');
        Route::get('/{section}/edit', [SectionController::class, 'edit'])->name('edit');
        Route::put('/{section}', [SectionController::class, 'update'])->name('update');
        Route::delete('/{section}', [SectionController::class, 'destroy'])->name('destroy');
        
        // [নতুন] সেকশন রি-অর্ডার রাউট
        Route::post('/reorder', [SectionController::class, 'reorder'])->name('reorder');
    });
    
    // Lessons Management
    Route::prefix('lessons')->name('lessons.')->group(function () {
        Route::get('/', [LessonController::class, 'index'])->name('index');
        Route::get('/create', [LessonController::class, 'create'])->name('create');
        Route::post('/', [LessonController::class, 'store'])->name('store');
        Route::get('/{lesson}', [LessonController::class, 'show'])->name('show');
        Route::get('/{lesson}/edit', [LessonController::class, 'edit'])->name('edit');
        Route::put('/{lesson}', [LessonController::class, 'update'])->name('update');
        Route::delete('/{lesson}', [LessonController::class, 'destroy'])->name('destroy');

        // [নতুন] লেসন রি-অর্ডার রাউট
        Route::post('/reorder', [LessonController::class, 'reorder'])->name('reorder');
    });
    
    // Quizzes & Assignments Management
    Route::prefix('quizzes')->name('quizzes.')->group(function () {
        Route::get('/', [QuizController::class, 'index'])->name('index');
        Route::get('/create', [QuizController::class, 'create'])->name('create');
        Route::post('/', [QuizController::class, 'store'])->name('store');
        Route::get('/{quiz}', [QuizController::class, 'show'])->name('show');
        Route::get('/{quiz}/edit', [QuizController::class, 'edit'])->name('edit');
        Route::put('/{quiz}', [QuizController::class, 'update'])->name('update');
        Route::delete('/{quiz}', [QuizController::class, 'destroy'])->name('destroy');
    });
    
    // Questions Management
    Route::prefix('questions')->name('questions.')->group(function () {
        Route::get('/', [QuestionController::class, 'index'])->name('index');
        Route::get('/create', [QuestionController::class, 'create'])->name('create');
        Route::post('/', [QuestionController::class, 'store'])->name('store');
        Route::get('/{question}', [QuestionController::class, 'show'])->name('show');
        Route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('edit');
        Route::put('/{question}', [QuestionController::class, 'update'])->name('update');
        Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('destroy');
    });
    
    // Answers Management
    Route::prefix('answers')->name('answers.')->group(function () {
        Route::get('/', [AnswerController::class, 'index'])->name('index');
        Route::get('/create', [AnswerController::class, 'create'])->name('create');
        Route::post('/', [AnswerController::class, 'store'])->name('store');
        Route::get('/{answer}', [AnswerController::class, 'show'])->name('show');
        Route::get('/{answer}/edit', [AnswerController::class, 'edit'])->name('edit');
        Route::put('/{answer}', [AnswerController::class, 'update'])->name('update');
        Route::delete('/{answer}', [AnswerController::class, 'destroy'])->name('destroy');
    });
    
    // Enrollments Management
    Route::prefix('enrollments')->name('enrollments.')->group(function () {
        Route::get('/', [EnrollmentController::class, 'index'])->name('index');
        Route::get('/create', [EnrollmentController::class, 'create'])->name('create');
        Route::post('/', [EnrollmentController::class, 'store'])->name('store');
        Route::get('/{enrollment}', [EnrollmentController::class, 'show'])->name('show');
        Route::get('/{enrollment}/edit', [EnrollmentController::class, 'edit'])->name('edit');
        Route::put('/{enrollment}', [EnrollmentController::class, 'update'])->name('update');
        Route::delete('/{enrollment}', [EnrollmentController::class, 'destroy'])->name('destroy');
    });
    
    // Payments Management
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/create', [PaymentController::class, 'create'])->name('create');
        Route::post('/', [PaymentController::class, 'store'])->name('store');

        Route::get('/gateways', [PaymentController::class, 'gateways'])->name('gateways');
        Route::put('/gateways/{gateway}', [PaymentController::class, 'updateGateway'])->name('gateways.update');
        
        Route::get('/{payment}', [PaymentController::class, 'show'])->name('show');
        Route::get('/{payment}/edit', [PaymentController::class, 'edit'])->name('edit');
        Route::put('/{payment}', [PaymentController::class, 'update'])->name('update');
    });
    
    // Certificate Management
    Route::prefix('certificates')->name('certificates.')->group(function () {
        
        // 1. বেসিক রাউটস (সবার উপরে)
        Route::get('/', [CertificateController::class, 'index'])->name('index');
        Route::get('/create', [CertificateController::class, 'create'])->name('create');
        Route::post('/', [CertificateController::class, 'store'])->name('store');
        
        // 2. টেমপ্লেট রাউটস (অবশ্যই ওয়াইল্ডকার্ডের উপরে থাকতে হবে)
        // [গুরুত্বপূর্ণ] এই অংশটি {certificate} এর আগে থাকতে হবে
        Route::get('/templates', [CertificateController::class, 'templates'])->name('templates');
        Route::get('/templates/create', [CertificateController::class, 'createTemplate'])->name('templates.create');
        Route::post('/templates', [CertificateController::class, 'storeTemplate'])->name('templates.store');
        Route::get('/templates/{template}/edit', [CertificateController::class, 'editTemplate'])->name('templates.edit');
        Route::put('/templates/{template}', [CertificateController::class, 'updateTemplate'])->name('templates.update');
        Route::delete('/templates/{template}', [CertificateController::class, 'destroyTemplate'])->name('templates.destroy');

        // 3. স্পেসিফিক সার্টিফিকেট রাউটস (ভেরিফিকেশন ও ডাউনলোড)
        Route::get('/verify', [CertificateController::class, 'verify'])->name('verify');
        Route::get('/verify/{code}', [CertificateController::class, 'verify'])->name('verify.code');
        Route::get('/{certificate}/download', [CertificateController::class, 'download'])->name('download');
        Route::post('/{certificate}/revoke', [CertificateController::class, 'revoke'])->name('revoke');
        Route::post('/{certificate}/restore', [CertificateController::class, 'restore'])->name('restore');
        
        // 4. ওয়াইল্ডকার্ড রাউটস (সবার শেষে থাকবে)
        // এটি উপরে থাকলে /templates লিংকেও এখানে হিট করবে এবং 404 দিবে
        Route::get('/{certificate}', [CertificateController::class, 'show'])->name('show');
        Route::get('/{certificate}/edit', [CertificateController::class, 'edit'])->name('edit');
        Route::put('/{certificate}', [CertificateController::class, 'update'])->name('update');
    });
    
    // Email Templates Management
    Route::prefix('email-templates')->name('email-templates.')->group(function () {
        Route::get('/', [EmailTemplateController::class, 'index'])->name('index');
        Route::get('/create', [EmailTemplateController::class, 'create'])->name('create');
        Route::post('/', [EmailTemplateController::class, 'store'])->name('store');
        Route::get('/{template}', [EmailTemplateController::class, 'show'])->name('show');
        Route::get('/{template}/edit', [EmailTemplateController::class, 'edit'])->name('edit');
        Route::put('/{template}', [EmailTemplateController::class, 'update'])->name('update');
        Route::delete('/{template}', [EmailTemplateController::class, 'destroy'])->name('destroy');
    });
    
    // Analytics
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    
    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        // General
        Route::get('/general', [DashboardController::class, 'generalSettings'])->name('general');
        Route::put('/general', [DashboardController::class, 'updateGeneralSettings'])->name('general.update');
        // Appearance
        Route::get('/appearance', [DashboardController::class, 'appearanceSettings'])->name('appearance');
        Route::put('/appearance', [DashboardController::class, 'updateAppearanceSettings'])->name('appearance.update');
        // SEO
        Route::get('/seo', [DashboardController::class, 'seoSettings'])->name('seo');
        Route::put('/seo', [DashboardController::class, 'updateSeoSettings'])->name('seo.update');
    });
    
    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/revenue', [DashboardController::class, 'revenueReport'])->name('revenue');
        Route::get('/enrollments', [DashboardController::class, 'enrollmentReport'])->name('enrollments');
        Route::get('/courses', [DashboardController::class, 'courseReport'])->name('courses');
        Route::get('/users', [DashboardController::class, 'userReport'])->name('users');
        Route::post('/export', [DashboardController::class, 'exportReport'])->name('export');
    });
    
    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::get('/{notification}', [NotificationController::class, 'show'])->name('show');
        Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('destroy');
    });
    
    // Profile Management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::get('/security', [ProfileController::class, 'security'])->name('security');
        Route::put('/security', [ProfileController::class, 'updateSecurity'])->name('security.update');
    });
});