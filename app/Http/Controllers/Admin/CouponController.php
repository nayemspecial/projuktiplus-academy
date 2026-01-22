<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * কুপন লিস্ট দেখাবে
     */
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * কুপন তৈরির ফর্ম দেখাবে
     */
    public function create()
    {
        // ড্রপডাউনে কোর্স সিলেক্ট করার জন্য কোর্স লিস্ট পাঠানো হচ্ছে
        $courses = Course::select('id', 'title')->where('status', 'published')->get();
        return view('admin.coupons.create', compact('courses'));
    }

    /**
     * নতুন কুপন সেভ করবে
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code|max:50',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'valid_from' => 'nullable|date',
            'valid_to' => 'nullable|date|after_or_equal:valid_from',
            'max_uses' => 'nullable|integer|min:1',
            'min_order_amount' => 'nullable|numeric|min:0',
            'course_id' => 'nullable|exists:courses,id' // যদি নির্দিষ্ট কোর্সের জন্য হয়
        ]);

        $data = $request->all();
        
        // চেকবক্স হ্যান্ডলিং
        $data['is_active'] = $request->has('is_active');

        // যদি স্পেসিফিক কোর্সের জন্য হয়, JSON এ কনভার্ট করে সেভ করা (আপনার মাইগ্রেশন অনুযায়ী)
        if ($request->course_id) {
            $data['applicable_courses'] = [$request->course_id]; // অ্যারে হিসেবে সেভ হবে
        }

        Coupon::create($data);

        return redirect()->route('admin.coupons.index')->with('success', 'কুপন সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * কুপন ডিলিট করবে
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return back()->with('success', 'কুপন ডিলিট করা হয়েছে।');
    }
    
    // স্ট্যাটাস টগল করার জন্য (Active/Inactive)
    public function toggleStatus($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['is_active' => !$coupon->is_active]);
        return back()->with('success', 'কুপন স্ট্যাটাস পরিবর্তন করা হয়েছে।');
    }
}