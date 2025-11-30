<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // ==========================================
    // DASHBOARD METHODS
    // ==========================================

    public function index()
    {
        // ১. মৌলিক পরিসংখ্যান (Basic Stats)
        $totalStudents = User::where('role', 'student')->count();
        $totalInstructors = User::where('role', 'instructor')->count();
        $totalCourses = Course::count();
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');

        // ২. চার্ট ডেটা (গত ৬ মাসের আয়)
        $revenueData = Payment::where('status', 'completed')
            ->where('created_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw('SUM(amount) as total'),
                DB::raw("DATE_FORMAT(created_at, '%M') as month_name"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month_key")
            )
            ->groupBy('month_key', 'month_name')
            ->orderBy('month_key')
            ->get();
            
        $chartLabels = $revenueData->pluck('month_name');
        $chartValues = $revenueData->pluck('total');

        // ৩. জনপ্রিয় ৫টি কোর্স (এনরোলমেন্ট অনুযায়ী)
        $popularCourses = Course::withCount('enrollments')
            ->with('instructor')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();

        // ৪. সাম্প্রতিক অ্যাক্টিভিটি
        $recentUsers = User::latest()->take(5)->get();
        $recentEnrollments = Enrollment::with(['user', 'course'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalStudents', 
            'totalInstructors', 
            'totalCourses', 
            'totalRevenue', 
            'recentUsers', 
            'recentEnrollments',
            'chartLabels',
            'chartValues',
            'popularCourses'
        ));
    }

    public function getDashboardData()
    {
        return response()->json(['message' => 'Data loaded successfully']);
    }

    public function analytics()
    {
        return view('admin.analytics.index');
    }

    // ==========================================
    // SETTINGS METHODS
    // ==========================================

    /**
     * ১. সাধারণ সেটিংস (General Settings)
     */
    public function generalSettings()
    {
        return view('admin.settings.general');
    }

    public function updateGeneralSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email',
            'site_phone' => 'nullable|string',
            'site_logo' => 'nullable|image|max:2048', // 2MB
            'site_favicon' => 'nullable|image|max:1024', // 1MB
        ]);

        // টেক্সট ডাটা সেভ
        $keys = ['site_name', 'site_email', 'site_phone', 'site_address', 'footer_text'];
        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        // ফাইল আপলোড (লোগো)
        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $path);
        }

        // ফাইল আপলোড (ফেভিকন)
        if ($request->hasFile('site_favicon')) {
            $oldFav = Setting::get('site_favicon');
            if ($oldFav && Storage::disk('public')->exists($oldFav)) {
                Storage::disk('public')->delete($oldFav);
            }

            $path = $request->file('site_favicon')->store('settings', 'public');
            Setting::set('site_favicon', $path);
        }

        return back()->with('success', 'সাধারণ সেটিংস আপডেট করা হয়েছে।');
    }

    /**
     * ২. এসইও সেটিংস (SEO Settings)
     */
    public function seoSettings()
    {
        return view('admin.settings.seo');
    }

    public function updateSeoSettings(Request $request)
    {
        $request->validate([
            'meta_title' => 'required|string|max:70',
            'meta_description' => 'required|string|max:160',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
        ]);

        $keys = ['meta_title', 'meta_description', 'meta_keywords', 'meta_author'];
        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        // সোশ্যাল শেয়ার ইমেজ
        if ($request->hasFile('og_image')) {
            $oldImage = Setting::get('og_image');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            $path = $request->file('og_image')->store('settings/seo', 'public');
            Setting::set('og_image', $path);
        }

        return back()->with('success', 'SEO কনফিগারেশন আপডেট করা হয়েছে।');
    }

    /**
     * ৩. অ্যাপিয়ারেন্স সেটিংস (Appearance Settings)
     */
    public function appearanceSettings()
    {
        return view('admin.settings.appearance');
    }

    public function updateAppearanceSettings(Request $request)
    {
        $request->validate([
            'primary_color' => 'required|string',
            'accent_color' => 'required|string',
            'font_family' => 'nullable|string',
        ]);

        Setting::set('primary_color', $request->primary_color);
        Setting::set('accent_color', $request->accent_color);
        
        if($request->has('font_family')) {
            Setting::set('font_family', $request->font_family);
        }

        return back()->with('success', 'থিম সেটিংস আপডেট করা হয়েছে।');
    }

    // ==========================================
    // REPORTS METHODS
    // ==========================================
    
    public function revenueReport() 
    { 
        return view('admin.reports.revenue'); 
    }
    
    public function enrollmentReport() 
    { 
        return view('admin.reports.enrollments'); 
    }
    
    public function courseReport() 
    { 
        return view('admin.reports.courses'); 
    }
    
    public function userReport() 
    { 
        return view('admin.reports.users'); 
    }
    
    public function exportReport(Request $request) 
    { 
        // এক্সপোর্ট লজিক ভবিষ্যতে এখানে যুক্ত হবে (যেমন: CSV/Excel)
        return back()->with('success', 'রিপোর্ট এক্সপোর্ট প্রসেস শুরু হয়েছে...'); 
    }
}