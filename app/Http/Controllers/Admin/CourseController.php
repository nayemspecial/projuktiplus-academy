<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * কোর্সের তালিকা প্রদর্শন (ফিল্টার ও সার্চ সহ)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $instructor = $request->input('instructor');

        // কোর্স লোড করার সময় ইনস্ট্রাকটর রিলেশন লোড করা হচ্ছে
        $query = Course::with('instructor'); 

        // ১. সার্চ ফিল্টার (টাইটেল, ক্যাটাগরি অথবা ইনস্ট্রাক্টরের নাম)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhereHas('instructor', function($iq) use ($search) {
                      $iq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // ২. স্ট্যাটাস ফিল্টার
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        // ৩. ইনস্ট্রাকটর ফিল্টার
        if ($instructor && $instructor !== 'all') {
            $query->where('instructor_id', $instructor);
        }

        $courses = $query->latest()->paginate(10)->withQueryString();
        
        // ফিল্টারের জন্য ইনস্ট্রাকটর তালিকা
        $instructors = User::where('role', 'instructor')->get();

        return view('admin.courses.index', compact('courses', 'instructors', 'search', 'status', 'instructor'));
    }

    /**
     * নতুন কোর্স তৈরির ফর্ম
     */
    public function create()
    {
        $instructors = User::where('role', 'instructor')->where('status', 'active')->get();
        
        // এনাম এবং অপশনসমূহ
        $levels = ['beginner', 'intermediate', 'advanced'];
        $categories = ['web-design', 'web-development', 'mobile-development', 'data-science', 'ux-ui', 'digital-marketing', 'business', 'photography'];
        $languages = ['english', 'bengali', 'hindi', 'spanish', 'french'];
        $statuses = ['draft', 'under_review', 'published', 'rejected', 'archived'];
        
        return view('admin.courses.create', compact('instructors', 'levels', 'categories', 'languages', 'statuses'));
    }

    /**
     * নতুন কোর্স স্টোর করা
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instructor_id' => 'required|exists:users,id',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'level' => 'required|string',
            'language' => 'required|string',
            'status' => 'required|in:draft,under_review,published,rejected,archived',
            'thumbnail' => 'nullable|image|max:2048',
            'video_preview' => 'nullable|mimes:mp4,mov,avi|max:51200', // 50MB
            
            // JSON Fields
            'requirements' => 'nullable|array',
            'what_you_will_learn' => 'nullable|array',
            'target_audience' => 'nullable|array',
            
            // Booleans
            'featured' => 'boolean',
            'certificate_included' => 'boolean',
            'lifetime_access' => 'boolean',
        ]);

        // স্লাগ জেনারেশন
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);

        // থাম্বনেইল আপলোড
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        // ভিডিও প্রিভিউ আপলোড
        if ($request->hasFile('video_preview')) {
            $validated['video_preview'] = $request->file('video_preview')->store('courses/previews', 'public');
        }

        // অ্যারে ক্লিনিং (খালি ভ্যালু রিমুভ)
        // মডেলে $casts => 'array' থাকায় json_encode করার প্রয়োজন নেই
        $validated['requirements'] = isset($validated['requirements']) ? array_values(array_filter($validated['requirements'])) : null;
        $validated['what_you_will_learn'] = isset($validated['what_you_will_learn']) ? array_values(array_filter($validated['what_you_will_learn'])) : null;
        $validated['target_audience'] = isset($validated['target_audience']) ? array_values(array_filter($validated['target_audience'])) : null;

        // পাবলিশড ডেট সেট
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'কোর্স সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * কোর্সের বিস্তারিত (এখানেই সেকশন ও লেসন ম্যানেজ করা হবে)
     */
    public function show(Course $course)
    {
        // সেকশন এবং লেসনগুলো অর্ডার অনুযায়ী লোড করা হচ্ছে
        // এটি ড্র্যাগ-এন্ড-ড্রপ বা সাধারণ ভিউ - দুটোর জন্যই জরুরি
        $course->load(['instructor', 'sections' => function($q) {
            $q->orderBy('order', 'asc')->with(['lessons' => function($lq) {
                $lq->orderBy('order', 'asc');
            }]);
        }]);
        
        return view('admin.courses.show', compact('course'));
    }

    /**
     * কোর্স এডিট ফর্ম
     */
    public function edit(Course $course)
    {
        $instructors = User::where('role', 'instructor')->where('status', 'active')->get();
        
        $levels = ['beginner', 'intermediate', 'advanced'];
        $categories = ['web-design', 'web-development', 'mobile-development', 'data-science', 'ux-ui', 'digital-marketing', 'business', 'photography'];
        $languages = ['english', 'bengali', 'hindi', 'spanish', 'french'];
        $statuses = ['draft', 'under_review', 'published', 'rejected', 'archived'];
        
        return view('admin.courses.edit', compact('course', 'instructors', 'levels', 'categories', 'languages', 'statuses'));
    }

    /**
     * কোর্স আপডেট করা
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instructor_id' => 'required|exists:users,id',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'level' => 'required|string',
            'language' => 'required|string',
            'status' => 'required|in:draft,under_review,published,rejected,archived',
            'thumbnail' => 'nullable|image|max:2048',
            'video_preview' => 'nullable|mimes:mp4,mov,avi|max:51200',
            'requirements' => 'nullable|array',
            'what_you_will_learn' => 'nullable|array',
            'target_audience' => 'nullable|array',
            'featured' => 'boolean',
            'certificate_included' => 'boolean',
            'lifetime_access' => 'boolean',
        ]);

        // থাম্বনেইল আপডেট
        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        // ভিডিও আপডেট
        if ($request->hasFile('video_preview')) {
            if ($course->video_preview && Storage::disk('public')->exists($course->video_preview)) {
                Storage::disk('public')->delete($course->video_preview);
            }
            $validated['video_preview'] = $request->file('video_preview')->store('courses/previews', 'public');
        }

        // অ্যারে ক্লিনিং
        $validated['requirements'] = isset($validated['requirements']) ? array_values(array_filter($validated['requirements'])) : null;
        $validated['what_you_will_learn'] = isset($validated['what_you_will_learn']) ? array_values(array_filter($validated['what_you_will_learn'])) : null;
        $validated['target_audience'] = isset($validated['target_audience']) ? array_values(array_filter($validated['target_audience'])) : null;

        // স্ট্যাটাস লজিক
        if ($validated['status'] === 'published' && $course->status !== 'published') {
            $validated['published_at'] = now();
        }

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'কোর্স সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * কোর্স ডিলিট করা
     */
    public function destroy(Course $course)
    {
        // ফাইল ডিলিট
        if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        if ($course->video_preview && Storage::disk('public')->exists($course->video_preview)) {
            Storage::disk('public')->delete($course->video_preview);
        }
        
        // কোর্স এবং সম্পর্কিত সেকশন/লেসন ডিলিট (যদি Cascade সেট করা থাকে ডাটাবেসে তবে অটো ডিলিট হবে, নাহলে ম্যানুয়ালি করতে হবে)
        $course->delete();

        return back()->with('success', 'কোর্স সফলভাবে ডিলিট করা হয়েছে।');
    }

    /**
     * কোর্সের স্ট্যাটাস আপডেট (শর্টকাট)
     */
    public function updateStatus(Request $request, Course $course)
    {
        $request->validate(['status' => 'required']);
        $course->update(['status' => $request->status]);
        
        if ($request->status === 'published' && !$course->published_at) {
            $course->update(['published_at' => now()]);
        }

        return back()->with('success', 'কোর্সের স্ট্যাটাস আপডেট করা হয়েছে।');
    }
    
    /**
     * পরিসংখ্যান (ভবিষ্যতের জন্য)
     */
    public function stats(Course $course)
    {
        return view('admin.courses.stats', compact('course'));
    }
}