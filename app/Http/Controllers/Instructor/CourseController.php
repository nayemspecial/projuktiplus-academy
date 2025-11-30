<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // <-- এই লাইনটি যোগ করা হয়েছে
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * ইন্সট্রাকটরের সব কোর্স প্রদর্শন করুন (আমার কোর্সসমূহ পেজ)
     */
    public function index(Request $request)
    {
        $instructorId = Auth::id();
        $search = $request->input('search');

        $query = Course::where('instructor_id', $instructorId);

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        $courses = $query->withCount('enrollments')
            ->withAvg('reviews', 'rating')
            ->withSum('payments as earnings', 'instructor_earnings')
            ->latest()
            ->paginate(10);

        return view('instructor.courses.index', compact('courses', 'search'));
    }

    /**
     * নতুন কোর্স তৈরির ফর্ম দেখান
     */
    public function create()
    {
        return view('instructor.courses.create');
    }

    /**
     * ডাটাবেসে নতুন কোর্স স্টোর করুন
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'level' => 'required|string',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $validated['instructor_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . strtolower(Str::random(6));
        $validated['status'] = 'draft'; 

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        $course = Course::create($validated);

        return redirect()->route('instructor.courses.edit', $course->id)->with('success', 'কোর্স সফলভাবে তৈরি হয়েছে! এখন লেসন যোগ করুন।');
    }

    /**
     * নির্দিষ্ট কোর্স দেখুন (Preview)
     */
    public function show(Course $course)
    {
        $this->authorizeOwnership($course);
        return view('instructor.courses.show', compact('course'));
    }

    /**
     * কোর্স এডিট করার ফর্ম দেখান
     */
    public function edit(Course $course)
    {
        $this->authorizeOwnership($course);
        return view('instructor.courses.edit', compact('course'));
    }

    /**
     * ডাটাবেসে কোর্স আপডেট করুন
     */
    public function update(Request $request, Course $course)
    {
        $this->authorizeOwnership($course);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'level' => 'required|string',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
        ]);
        
        if ($request->hasFile('thumbnail')) {
            // পুরনো থাম্বনেইল ডিলিট (যদি থাকে)
            if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        $course->update($validated);

        return back()->with('success', 'কোর্স সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * কোর্স ডিলিট করুন
     */
    public function destroy(Course $course)
    {
        $this->authorizeOwnership($course);

        // থাম্বনেইল ফাইল ডিলিট
        if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        
        $course->delete();

        return redirect()->route('instructor.courses.index')->with('success', 'কোর্স সফলভাবে ডিলিট করা হয়েছে!');
    }

    // --- হেল্পার মেথড ---

    /**
     * এই ইন্সট্রাকটর কোর্সের মালিক কিনা তা চেক করে
     */
    private function authorizeOwnership(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            abort(403, 'আপনি এই কোর্সের মালিক নন।');
        }
    }
}