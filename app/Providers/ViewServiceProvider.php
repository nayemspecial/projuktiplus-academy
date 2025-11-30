<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification; // <-- নিশ্চিত করুন এই লাইনটি আছে

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.student-header', function ($view) {
            
            // এখানে Auth::user()->isStudent() এর পরিবর্তে Auth::user()->role === 'student' ব্যবহার করা হয়েছে
            if (Auth::check() && Auth::user()->role === 'student') {
                
                $user = Auth::user();
                
                // আন-রিড নোটিফিকেশনের সংখ্যা
                $unreadCount = Notification::where('user_id', $user->id)
                                    ->unread() 
                                    ->count();
                
                // ড্রপডাউনের জন্য সর্বশেষ ৫টি আন-রিড নোটিফিকেশন
                $recentNotifications = Notification::where('user_id', $user->id)
                                    ->unread()
                                    ->latest()
                                    ->take(5)
                                    ->get();
                
                $view->with([
                    'unreadNotificationsCount' => $unreadCount,
                    'recentNotifications' => $recentNotifications
                ]);
            } else {
                $view->with([
                    'unreadNotificationsCount' => 0,
                    'recentNotifications' => collect()
                ]);
            }
        });
    }
}