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
        // নোট: সার্চ বা ফিল্টার রেজাল্ট সাধারণত ক্যাশ করা কঠিন কারণ প্রতিটি কম্বিনেশন আলাদা।
        // তবে আমরা বেসিক কুয়েরি অপ্টিমাইজ করব।

        $query = Course::with(['instructor:id,name,avatar']) // Eager Loading Optimization
            ->withCount(['lessons', 'enrollments', 'reviews']) // Count Optimization
            ->where('status', 'published');

        // ১. সার্চ ফিল্টার
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // ২. ক্যাটাগরি ফিল্টার
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // ৩. লেভেল ফিল্টার
        if ($request->filled('level') && $request->level !== 'all') {
            $query->where('level', $request->level);
        }

        // পেজিনেশন সহ ডাটা আনা
        $courses = $query->latest()->paginate(9)->withQueryString();
        
        // প্রতিটি কোর্সের ডাটা ফরম্যাট করা (Alpine.js এর জন্য)
        // পেজিনেটেড কালেকশন মডিফাই করা একটু ট্রিকি, তাই আমরা ভিউ ফাইলে লুপের মধ্যে অ্যাক্সেসর ব্যবহার করব
        // অথবা এখানে through() মেথড ব্যবহার করতে পারি
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

        // সাইডবার ক্যাটাগরি লিস্ট (ক্যাশ করা হলো ২৪ ঘন্টার জন্য)
        $categories = Cache::remember('course_categories', 1440, function () {
            return Course::where('status', 'published')->distinct()->pluck('category');
        });

        return view('frontend.courses.index', compact('courses', 'categories'));
    }

    /**
     * নির্দিষ্ট কোর্সের বিস্তারিত
     * হাই পারফরমেন্স টিপ: স্লাগ অনুযায়ী ক্যাশ করা।
     */
    public function show($slug)
    {
        // ক্যাশ কী তৈরি করা (যেমন: course_details_laravel-course)
        $cacheKey = 'course_details_' . $slug;

        $course = Cache::remember($cacheKey, 60, function () use ($slug) {
            return Course::with([
                'instructor', 
                'reviews.user', 
                'sections.lessons' => function($q) {
                    // লেসনের শুধু প্রয়োজনীয় ডাটা আনা
                    $q->select('id', 'section_id', 'title', 'duration', 'is_free', 'type');
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