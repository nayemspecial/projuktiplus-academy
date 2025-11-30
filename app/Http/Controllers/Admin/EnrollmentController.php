<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with('user', 'course')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'student')->get()->mapWithKeys(function ($user) {
            return [$user->id => $user->name . ' (' . $user->email . ')'];
        });
        
        $courses = Course::all()->mapWithKeys(function ($course) {
            return [$course->id => $course->title . ' - ৳' . $course->price];
        });
        
        $statuses = [
            'active' => 'Active',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'refunded' => 'Refunded'
        ];
        
        return view('admin.enrollments.create', compact('users', 'courses', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'price_paid' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,cancelled,refunded',
            'progress' => 'nullable|integer|min:0|max:100',
            'completed_lessons' => 'nullable|integer|min:0',
            'total_lessons' => 'nullable|integer|min:0',
            'cancellation_reason' => 'nullable|string',
        ]);

        // Check if enrollment already exists
        $existingEnrollment = Enrollment::where('user_id', $validated['user_id'])
            ->where('course_id', $validated['course_id'])
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'এই ব্যবহারকারী ইতিমধ্যেই এই কোর্সে এনরোল করা আছে।');
        }

        // Set completed_at if status is completed
        if ($validated['status'] === 'completed') {
            $validated['completed_at'] = now();
        }

        // Set last accessed to now
        $validated['last_accessed_at'] = now();

        Enrollment::create($validated);

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'এনরোলমেন্ট সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        $enrollment->load('user', 'course', 'completedLessons.lesson', 'quizAttempts.quiz', 'certificates');
        return view('admin.enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        $users = User::where('role', 'student')->get()->mapWithKeys(function ($user) {
            return [$user->id => $user->name . ' (' . $user->email . ')'];
        });
        
        $courses = Course::all()->mapWithKeys(function ($course) {
            return [$course->id => $course->title . ' - ৳' . $course->price];
        });
        
        $statuses = [
            'active' => 'Active',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'refunded' => 'Refunded'
        ];
        
        return view('admin.enrollments.edit', compact('enrollment', 'users', 'courses', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'price_paid' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,cancelled,refunded',
            'progress' => 'nullable|integer|min:0|max:100',
            'completed_lessons' => 'nullable|integer|min:0',
            'total_lessons' => 'nullable|integer|min:0',
            'cancellation_reason' => 'nullable|string',
        ]);

        // Check if enrollment already exists for another user
        $existingEnrollment = Enrollment::where('user_id', $validated['user_id'])
            ->where('course_id', $validated['course_id'])
            ->where('id', '!=', $enrollment->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'এই ব্যবহারকারী ইতিমধ্যেই এই কোর্সে এনরোল করা আছে।');
        }

        // Set completed_at if status is being changed to completed
        if ($validated['status'] === 'completed' && $enrollment->status !== 'completed') {
            $validated['completed_at'] = now();
        }

        // Remove completed_at if status is changed from completed
        if ($validated['status'] !== 'completed' && $enrollment->status === 'completed') {
            $validated['completed_at'] = null;
        }

        $enrollment->update($validated);

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'এনরোলমেন্ট সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'এনরোলমেন্ট সফলভাবে ডিলিট করা হয়েছে।');
    }
}