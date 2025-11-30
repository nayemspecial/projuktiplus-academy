<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Payment;
use App\Models\Review; // <-- Review মডেল ইম্পোর্ট করা হয়েছে
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * ইন্সট্রাকটর ড্যাশবোর্ড দেখান
     */
    public function index()
    {
        $instructor = Auth::user();
        $instructorId = $instructor->id;

        // --- ড্যাশবোর্ড পরিসংখ্যান ---
        $totalCourses = Course::where('instructor_id', $instructorId)->count();

        $totalStudents = Enrollment::whereHas('course', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->distinct('user_id')->count();
        
        $totalEarnings = Payment::whereHas('course', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->where('status', 'completed')->sum('instructor_earnings');
        
        // গড় রেটিং বের করা
        $averageRating = Review::whereHas('course', function ($q) use ($instructorId) {
            $q->where('instructor_id', $instructorId);
        })->avg('rating') ?? 0;

        $stats = [
            'totalCourses' => $totalCourses,
            'totalStudents' => $totalStudents,
            'totalEarnings' => $totalEarnings,
            'averageRating' => round($averageRating, 1),
            'courseGrowth' => 15, // ডামি ডাটা
            'studentGrowth' => 10, // ডামি ডাটা
            'earningsGrowth' => 5, // ডামি ডাটা
            'ratingGrowth' => 2, // ডামি ডাটা
        ];

        // সাম্প্রতিক এনরোলমেন্ট
        $recentEnrollments = Enrollment::whereHas('course', function ($query) use ($instructorId) {
                $query->where('instructor_id', $instructorId);
            })
            ->with(['user', 'course']) 
            ->latest()
            ->take(5)
            ->get();
            
        // কোর্স পারফরম্যান্স
        $coursePerformance = Course::where('instructor_id', $instructorId)
            ->withCount('enrollments')
            ->orderByDesc('enrollments_count')
            ->take(5)
            ->get();

        // ড্যাশবোর্ড চার্টের ডাটা (গত ৬ মাস)
        $earningsChartData = Payment::whereHas('course', function ($q) use ($instructorId) {
                $q->where('instructor_id', $instructorId);
            })
            ->where('status', 'completed')
            ->select(
                DB::raw('YEAR(completed_at) as year'),
                DB::raw('MONTH(completed_at) as month'),
                DB::raw('MONTHNAME(completed_at) as month_name'),
                DB::raw('SUM(instructor_earnings) as total'),
                DB::raw('MIN(completed_at) as sort_date')
            )
            ->where('completed_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month', 'month_name')
            ->orderBy('sort_date', 'ASC')
            ->get();

        $dashboardChart = [
            'labels' => $earningsChartData->pluck('month_name'),
            'data' => $earningsChartData->pluck('total'),
        ];
        
        return view('instructor.dashboard', compact(
            'instructor',
            'stats',
            'recentEnrollments',
            'coursePerformance',
            'dashboardChart'
        ));
    }
    
    /**
     * ইন্সট্রাকটরের সব শিক্ষার্থী দেখান
     */
    public function students(Request $request)
    {
        $instructorId = Auth::id();
        $search = $request->input('search');

        $query = User::whereHas('enrollments.course', function ($q) use ($instructorId) {
            $q->where('instructor_id', $instructorId);
        });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $students = $query->with(['enrollments' => function($q) use ($instructorId) {
            $q->whereHas('course', function ($courseQuery) use ($instructorId) {
                $courseQuery->where('instructor_id', $instructorId);
            });
        }])
        ->latest('created_at')
        ->paginate(15);

        return view('instructor.students.index', compact('students', 'search'));
    }

    /**
     * ইন্সট্রাকটরের আয় (Earnings) পেজ
     */
    public function earnings(Request $request)
    {
        $instructorId = Auth::id();

        $query = Payment::whereHas('course', function ($q) use ($instructorId) {
            $q->where('instructor_id', $instructorId);
        })
        ->where('status', 'completed')
        ->with(['user', 'course']);

        $totalEarnings = $query->sum('instructor_earnings');
        
        $thisMonthEarnings = $query->clone()->whereMonth('completed_at', now()->month)
                                 ->whereYear('completed_at', now()->year)
                                 ->sum('instructor_earnings');
        
        $totalCoursesSold = $query->clone()->count();

        $transactions = $query->clone()->latest('completed_at')->paginate(20);

        return view('instructor.earnings.index', compact(
            'totalEarnings',
            'thisMonthEarnings',
            'totalCoursesSold',
            'transactions'
        ));
    }

    /**
     * অ্যানালিটিক্স পেজ (Analytics)
     */
    public function analytics(Request $request)
    {
        $instructorId = Auth::id();

        // আয়ের ডাটা
        $earningsData = Payment::whereHas('course', function ($q) use ($instructorId) {
                $q->where('instructor_id', $instructorId);
            })
            ->where('status', 'completed')
            ->select(
                DB::raw('YEAR(completed_at) as year'),
                DB::raw('MONTH(completed_at) as month'),
                DB::raw('MONTHNAME(completed_at) as month_name'),
                DB::raw('SUM(instructor_earnings) as total'),
                DB::raw('MIN(completed_at) as sort_date')
            )
            ->where('completed_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month', 'month_name')
            ->orderBy('sort_date', 'ASC')
            ->get();

        // এনরোলমেন্ট ডাটা
        $enrollmentsData = Enrollment::whereHas('course', function ($q) use ($instructorId) {
                $q->where('instructor_id', $instructorId);
            })
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('MONTHNAME(created_at) as month_name'),
                DB::raw('COUNT(*) as total'),
                DB::raw('MIN(created_at) as sort_date')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month', 'month_name')
            ->orderBy('sort_date', 'ASC')
            ->get();
            
        $topCourses = Course::where('instructor_id', $instructorId)
            ->withCount('enrollments')
            ->withSum(['payments' => function($q) {
                $q->where('status', 'completed');
            }], 'instructor_earnings')
            ->orderByDesc('payments_sum_instructor_earnings')
            ->take(5)
            ->get();

        $chartData = [
            'earnings' => [
                'labels' => $earningsData->pluck('month_name'),
                'data' => $earningsData->pluck('total'),
            ],
            'enrollments' => [
                'labels' => $enrollmentsData->pluck('month_name'),
                'data' => $enrollmentsData->pluck('total'),
            ],
        ];

        return view('instructor.analytics.index', compact('chartData', 'topCourses'));
    }

    /**
     * [নতুন] রিভিউ পেজ (Reviews)
     */
    public function reviews(Request $request)
    {
        $instructorId = Auth::id();
        $search = $request->input('search');

        // ইন্সট্রাকটরের কোর্সে আসা রিভিউগুলো খুঁজে বের করা
        $query = Review::whereHas('course', function ($q) use ($instructorId) {
            $q->where('instructor_id', $instructorId);
        })->with(['user', 'course']);

        // ফিল্টার: রেটিং অনুযায়ী
        if ($request->has('rating') && $request->rating != 'all') {
            $query->where('rating', $request->rating);
        }

        // সার্চ: কোর্স বা স্টুডেন্টের নাম দিয়ে
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('course', function($cq) use ($search) {
                    $cq->where('title', 'like', "%{$search}%");
                })->orWhereHas('user', function($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%");
                });
            });
        }

        $reviews = $query->latest()->paginate(10);

        // গড় রেটিং এবং মোট রিভিউ সংখ্যা
        $stats = [
            'total_reviews' => Review::whereHas('course', function ($q) use ($instructorId) {
                $q->where('instructor_id', $instructorId);
            })->count(),
            
            'avg_rating' => Review::whereHas('course', function ($q) use ($instructorId) {
                $q->where('instructor_id', $instructorId);
            })->avg('rating') ?? 0,
        ];

        return view('instructor.reviews.index', compact('reviews', 'stats', 'search'));
    }
}