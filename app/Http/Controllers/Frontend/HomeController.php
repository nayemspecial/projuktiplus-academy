<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // ১. জনপ্রিয় কোর্স (সরাসরি মডেল পাঠানো হচ্ছে)
        $courses = Cache::remember('home_latest_courses', 60, function () {
            return Course::with('instructor') // রিলেশন
                ->withCount(['lessons', 'enrollments']) // কাউন্ট (lessons_count, enrollments_count)
                ->where('status', 'published')
                ->latest()
                ->take(4)
                ->get(); 
        });

        // ২. অন্যান্য ডাটা (Stats & Testimonials) - আগের মতই
        $stats = Cache::remember('home_stats', 360, function () {
            return [
                'students' => User::where('role', 'student')->count(),
                'instructors' => User::where('role', 'instructor')->count(),
                'courses' => Course::where('status', 'published')->count(),
                'enrollments' => DB::table('enrollments')->count(),
            ];
        });

        $testimonials = Cache::remember('home_testimonials', 1440, function () {
            return Review::with('user')->where('rating', '>=', 4)->latest()->take(6)->get();
        });

        return view('frontend.home', compact('courses', 'stats', 'testimonials'));
    }
}