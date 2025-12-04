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
     * হাই পারফরমেন্স টিপ: ডাটাবেস কোয়েরিগুলো ক্যাশ করা হয়েছে।
     */
    public function index()
    {
        // ১. জনপ্রিয় কোর্স (Cache for 60 minutes)
        $courses = Cache::remember('home_popular_courses', 60, function () {
            return Course::with(['instructor:id,name,avatar']) // শুধুমাত্র প্রয়োজনীয় কলাম সিলেক্ট করা
                ->withCount(['lessons', 'enrollments', 'reviews']) // রিলেশন কাউন্ট
                ->where('status', 'published')
                ->where('featured', true) // অথবা এনরোলমেন্ট কাউন্ট অনুযায়ী সর্ট করতে পারেন
                ->latest()
                ->take(8)
                ->get()
                ->map(function ($course) {
                    return [
                        'id' => $course->id,
                        'title' => $course->title,
                        'slug' => $course->slug,
                        'image' => $course->thumbnail_url,
                        'level' => ucfirst($course->level),
                        'category' => $course->category,
                        'instructor' => $course->instructor->name ?? 'ProjuktiPlus',
                        'instructor_avatar' => $course->instructor->avatar_url,
                        'price' => $course->price,
                        'discount_price' => $course->discount_price,
                        'rating' => number_format($course->rating ?? 5.0, 1),
                        'reviews' => $course->reviews_count ?? 0,
                        'lessons' => $course->lessons_count,
                        'students' => $course->enrollments_count,
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

        // ৩. রিভিউ/টেস্টিমোনিয়াল (Cache for 24 hours)
        $testimonials = Cache::remember('home_testimonials', 1440, function () {
            return Review::with('user:id,name,avatar')
                ->where('rating', '>=', 4)
                ->latest()
                ->take(6)
                ->get();
        });

        return view('frontend.home', compact('courses', 'stats', 'testimonials'));
    }
}