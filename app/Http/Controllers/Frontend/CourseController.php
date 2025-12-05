<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{
    /**
     * সকল কোর্সের তালিকা প্রদর্শন (Filtering & Searching)
     */
    public function index(Request $request)
    {
        // 1. Query Optimization: with() এবং withCount() ব্যবহার করা হয়েছে
        // এটি N+1 কুয়েরি প্রবলেম সমাধান করবে এবং পেজ লোড ফাস্ট করবে
        $query = Course::with(['instructor']) // ইনস্ট্রাক্টর ডাটা একসাথে আনবে
            ->withCount(['lessons', 'enrollments', 'reviews']) // আলাদা কুয়েরি না করে কাউন্ট আনবে
            ->where('status', 'published');

        // ২. সার্চ ফিল্টার
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // ৩. ক্যাটাগরি ফিল্টার
        if ($request->has('category') && !empty($request->category) && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // ৪. লেভেল ফিল্টার
        if ($request->has('level') && !empty($request->level) && $request->level !== 'all') {
            $query->where('level', $request->level);
        }

        // ৫. পেজিনেশন (লেটেস্ট আগে)
        $courses = $query->latest()->paginate(9)->withQueryString();
        
        // প্রতিটি কোর্সের ডাটা ফরম্যাট করা (Alpine.js এর জন্য)
        $courses->through(function ($course) {
            $course->formatted_data = [
                'id' => $course->id,
                'title' => $course->title,
                'slug' => $course->slug,
                'image' => $course->thumbnail_url,
                'level' => ucfirst($course->level),
                'category' => $course->category,
                'instructor' => $course->instructor->name ?? 'Unknown',
                'instructor_avatar' => $course->instructor->avatar_url,
                'price' => $course->price,
                'discount_price' => $course->discount_price,
                'rating' => number_format($course->rating ?? 0, 1),
                'reviews' => $course->reviews_count,
                'lessons' => $course->lessons_count,
                'students' => $course->enrollments_count,
            ];
            return $course;
        });

        // ৬. সাইডবার ক্যাটাগরি লিস্ট (Caching)
        // ক্যাটাগরি লিস্ট বারবার ডাটাবেস থেকে না এনে ক্যাশ থেকে আনা হবে (২৪ ঘন্টার জন্য)
        $categories = Cache::remember('course_categories', 60 * 24, function () {
            return Course::where('status', 'published')->distinct()->pluck('category');
        });

        return view('frontend.courses.index', compact('courses', 'categories'));
    }

    /**
     * নির্দিষ্ট কোর্সের বিস্তারিত
     */
    public function show($slug)
    {
        // ৭. সিঙ্গেল কোর্স ক্যাশিং (Caching)
        // প্রতিটি কোর্সের ডিটেইলস ১ ঘন্টার জন্য ক্যাশ করা হবে
        $cacheKey = 'course_details_' . $slug;

        // Cache::remember ব্যবহার করা হচ্ছে যাতে বারবার কুয়েরি না হয়
        $course = Cache::remember($cacheKey, 60, function () use ($slug) {
            return Course::with([
                'instructor', 
                'reviews.user', 
                // [IMPORTANT] স্টুডেন্টদের ছবি দেখানোর জন্য এই রিলেশনটি জরুরি
                'enrollments.user', 
                'sections.lessons' => function($q) {
                    // [FIXED] লেসনের কলাম নাম ঠিক করা হয়েছে এবং alias করা হয়েছে
                    $q->select(
                        'id', 
                        'section_id', 
                        'title', 
                        'video_duration as duration', // video_duration কে duration হিসেবে নেওয়া হচ্ছে
                        'is_free', 
                        'video_type as type' // video_type কে type হিসেবে নেওয়া হচ্ছে
                    );
                }
            ])
            ->withCount(['enrollments', 'reviews', 'lessons'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        });
            
        return view('frontend.courses.show', compact('course'));
    }
}