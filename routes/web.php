<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\HomeController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home Route (Controller Based for Caching)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Future Frontend Routes (যখন তৈরি করবেন তখন আনকমেন্ট করবেন)
// কোর্স পেজসমূহ (Course Pages)
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');

// Checkout Routes s
Route::middleware(['auth'])->group(function () {
    // চেকআউট পেজ দেখার জন্য
    Route::get('/courses/{slug}/checkout', [CheckoutController::class, 'index'])->name('courses.checkout');
    
    // পেমেন্ট সাবমিট করার জন্য
    Route::post('/courses/{id}/enroll', [CheckoutController::class, 'store'])->name('courses.enroll');
});
// Route::get('/about', [PageController::class, 'about'])->name('about');
// Route::get('/contact', [PageController::class, 'contact'])->name('contact');


// Require other route files
require __DIR__.'/admin.php';
require __DIR__.'/student.php';
require __DIR__.'/instructor.php';