<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\CompletedLesson;
use App\Models\Notification;
use App\Models\Certificate; // বিদ্যমান মডেল
use App\Models\Wishlist;    // বিদ্যমান মডেল
use App\Models\Course;      // বিদ্যমান মডেল

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ১. সব এনরোলমেন্ট ডাটা (সর্বশেষ এক্সেস করা কোর্স আগে থাকবে)
        $enrollments = Enrollment::with(['course.instructor'])
            ->where('user_id', $user->id)
            ->orderBy('last_accessed_at', 'desc')
            ->get();

        // ২. ড্যাশবোর্ড স্ট্যাটিস্টিক্স
        $totalEnrolled = $enrollments->count();
        $completedCourses = $enrollments->where('status', 'completed')->count();
        $averageProgress = $totalEnrolled > 0 ? round($enrollments->avg('progress')) : 0;

        // ৩. [নতুন] অতিরিক্ত স্ট্যাটস (সার্টিফিকেট, উইসলিষ্ট, পয়েন্ট)
        // উল্লেখ্য: Wishlist মডেল আপনার অ্যাপে থাকলে এটি কাজ করবে, না থাকলে ০ দেখাবে
        $totalCertificates = class_exists(Certificate::class) ? Certificate::where('user_id', $user->id)->count() : 0;
        $totalWishlist = class_exists(Wishlist::class) ? Wishlist::where('user_id', $user->id)->count() : 0;
        
        // XP গণনা: প্রতিটি সম্পন্ন লেসনের জন্য ১০ পয়েন্ট (CompletedLesson মডেল ব্যবহার করে)
        // এটি স্টুডেন্টদের এনগেজমেন্ট বাড়াবে
        $totalCompletedLessonsCount = CompletedLesson::whereHas('enrollment', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();
        $totalXP = $totalCompletedLessonsCount * 10;

        // ৪. [নতুন] সর্বশেষ এক্সেস করা কোর্স (হিরো সেকশনের জন্য)
        // এটি স্টুডেন্টকে লগইন করার সাথে সাথেই পড়া শুরু করতে সাহায্য করবে
        $lastPlayedCourse = $enrollments->first();

        // ৫. অ্যাক্টিভ কোর্স (উইজেটের জন্য)
        $activeCoursesData = $enrollments->where('status', 'active')
            ->take(3)
            ->map(function ($enrollment) {
                return [
                    'id' => $enrollment->course_id,
                    'name' => $enrollment->course->title,
                    'image' => $enrollment->course->thumbnail_url,
                    'progress' => $enrollment->progress,
                    'lastAccessed' => $enrollment->last_accessed_at ? $enrollment->last_accessed_at->diffForHumans() : 'শুরু হয়নি',
                ];
            })->values();

        // ৬. সব কোর্স (My Courses ট্যাবের জন্য)
        $myCoursesData = $enrollments->map(function ($enrollment) {
            return [
                'id' => $enrollment->course_id,
                'name' => $enrollment->course->title,
                'image' => $enrollment->course->thumbnail_url,
                'instructor' => $enrollment->course->instructor->name ?? 'Unknown',
                'progress' => $enrollment->progress,
                'status' => $enrollment->status,
                'completedLessons' => $enrollment->completed_lessons,
                'totalLessons' => $enrollment->course->total_lessons ?? 0, // সেফটি চেক
                'lastAccessed' => $enrollment->last_accessed_at ? $enrollment->last_accessed_at->diffForHumans() : 'N/A',
            ];
        });

        // ৭. সাম্প্রতিক অ্যাক্টিভিটি
        $recentActivitiesData = CompletedLesson::whereHas('enrollment', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with(['lesson', 'enrollment.course'])
            ->latest('completed_at')
            ->take(5)
            ->get()
            ->map(function ($completed) {
                return [
                    'id' => $completed->id,
                    'type' => 'lesson',
                    'message' => $completed->enrollment->course->title . ' কোর্সের "' . \Illuminate\Support\Str::limit($completed->lesson->title, 20) . '" লেসন সম্পন্ন করেছেন',
                    'time' => $completed->completed_at->diffForHumans(),
                ];
            });

        // ৮. [নতুন] রিকমেন্ডেড কোর্স (সাজেশন)
        // স্টুডেন্ট যেসব কোর্সে এনরোল করেনি, সেখান থেকে ৩টি র‍্যান্ডম কোর্স
        $enrolledCourseIds = $enrollments->pluck('course_id');
        $recommendedCourses = Course::whereNotIn('id', $enrolledCourseIds)
            ->where('status', 'published')
            ->with('instructor')
            ->inRandomOrder()
            ->take(2) // ২টি সাজেশন দেখাব
            ->get();

        return view('student.dashboard', compact(
            'user',
            'totalEnrolled',
            'completedCourses',
            'averageProgress',
            'totalCertificates',
            'totalWishlist',
            'totalXP',
            'lastPlayedCourse',
            'activeCoursesData',
            'myCoursesData',
            'recentActivitiesData',
            'recommendedCourses'
        ));
    }

    // ... আপনার বাকি মেথডগুলো (notifications, etc.) অপরিবর্তিত থাকবে ...
    
    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth::id())->latest()->paginate(15);
        return view('student.notifications.index', compact('notifications'));
    }

    public function showNotification(Notification $notification)
    {
        abort_if($notification->user_id !== Auth::id(), 403);
        $notification->markAsRead();
        if (isset($notification->data['url'])) return redirect($notification->data['url']);
        return redirect()->route('student.notifications.index');
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())->unread()->update(['is_read' => true, 'read_at' => now()]);
        return back()->with('success', 'সব নোটিফিকেশন পঠিত হিসেবে মার্ক করা হয়েছে।');
    }

    public function deleteNotification(Notification $notification)
    {
        abort_if($notification->user_id !== Auth::id(), 403);
        $notification->delete();
        return back()->with('success', 'নোটিফিকেশন ডিলিট করা হয়েছে।');
    }
}