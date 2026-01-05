<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * হোম পেজ দেখানোর মেথড
     */
    public function index()
    {
        // ১. জনপ্রিয় কোর্স (Cache for 60 minutes)
        $courses = Cache::remember('home_popular_courses', 60, function () {
            return Course::with(['instructor:id,name,avatar']) 
                ->withCount(['lessons', 'enrollments', 'reviews']) 
                ->where('status', 'published')
                ->latest() // অথবা ->inRandomOrder() দিতে পারেন
                ->take(8)
                ->get()
                ->map(function ($course) {
                    return [
                        'id' => $course->id,
                        'title' => $course->title,
                        'slug' => $course->slug,
                        // নিশ্চিত করবেন মডেলে getThumbnailUrlAttribute আছে
                        'image' => $course->thumbnail_url ?? asset('images/default-course.png'),
                        'level' => $this->translateLevel($course->level),
                        'category' => $course->category ?? 'web-development', // ডিফল্ট ক্যাটাগরি
                        'instructor' => $course->instructor->name ?? 'ProjuktiPlus',
                        'instructor_avatar' => $course->instructor->avatar_url,
                        'price' => (int) $course->price, // ইন্টিজার করা হয়েছে ডিজাইনের জন্য
                        'discount_price' => $course->discount_price ? (int) $course->discount_price : null,
                        'rating' => number_format($course->rating ?? 0.0, 1),
                        'reviews' => $course->reviews_count ?? 0,
                        'lessons' => $course->lessons_count ?? 0,
                        'students' => $course->enrollments_count ?? 0,
                    ];
                });
        });

        // ২. সাইট স্ট্যাটস (Cache for 6 hours)
        $stats = Cache::remember('home_stats', 360, function () {
            return [
                'students' => User::where('role', 'student')->count(),
                'instructors' => User::where('role', 'instructor')->count(),
                'courses' => Course::where('status', 'published')->count(),
                'enrollments' => DB::table('enrollments')->count(),
            ];
        });

        // ৩. রিভিউ/টেস্টিমোনিয়াল (Cache for 24 hours)
        $testimonials = Cache::remember('home_testimonials', 1440, function () {
            return Review::with('user:id,name,avatar')
                ->where('rating', '>=', 4)
                ->latest()
                ->take(6)
                ->get();
        });

        return view('frontend.home', compact('courses', 'stats', 'testimonials'));
    }

    // লেভেল ট্রান্সলেটর
    private function translateLevel($level)
    {
        return match (strtolower($level)) {
            'beginner' => 'বিগিনার',
            'intermediate' => 'ইন্টারমিডিয়েট',
            'advanced' => 'এডভান্সড',
            default => 'বিগিনার',
        };
    }
}