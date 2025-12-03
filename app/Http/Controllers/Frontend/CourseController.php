<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * সকল কোর্সের তালিকা প্রদর্শন
     */
    public function index(Request $request)
    {
        $query = Course::with(['instructor', 'reviews']) // ইনস্ট্রাক্টর ও রিভিউ লোড করা হচ্ছে
            ->where('status', 'published') // শুধু পাবলিশড কোর্স
            ->latest();

        // ১. সার্চ ফিল্টার
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        // ২. ক্যাটাগরি ফিল্টার
        if ($request->has('category') && !empty($request->category) && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // ৩. লেভেল ফিল্টার
        if ($request->has('level') && !empty($request->level) && $request->level !== 'all') {
            $query->where('level', $request->level);
        }

        $courses = $query->paginate(9)->withQueryString();
        
        // সাইডবার ফিল্টারের জন্য ইউনিক ক্যাটাগরিগুলো নেওয়া হচ্ছে
        $categories = Course::where('status', 'published')->distinct()->pluck('category');

        return view('frontend.courses.index', compact('courses', 'categories'));
    }

    /**
     * নির্দিষ্ট কোর্সের বিস্তারিত (পরের ধাপে ডিজাইন করব)
     */
    public function show($slug)
    {
        $course = Course::with(['instructor', 'reviews.user', 'sections.lessons'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
            
        return view('frontend.courses.show', compact('course'));
    }
}