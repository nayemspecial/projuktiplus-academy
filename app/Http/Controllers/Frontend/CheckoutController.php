<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Models\Coupon;        // [NEW]
use App\Models\CouponUsage;   // [NEW]
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index($slug)
    {
        $course = Course::with('instructor')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // ইউজার ইতিমধ্যে এনরোল করা আছে কিনা চেক করা
        if (Auth::check() && Enrollment::where('user_id', Auth::id())->where('course_id', $course->id)->exists()) {
            return redirect()->route('student.courses.show', $course->id)
                ->with('info', 'আপনি ইতিমধ্যে এই কোর্সে এনরোল করেছেন।');
        }

        $gateways = Cache::remember('active_payment_gateways', 60 * 24, function () {
            return PaymentGateway::where('is_active', true)->get();
        });

        // [NEW] সেশন থেকে কুপন ডাটা রিট্রিভ করা (যদি আগে অ্যাপ্লাই করা থাকে)
        // কিন্তু কোর্স আইডি চেক করা দরকার, অন্য কোর্সের কুপন যেন এখানে না আসে
        if (session()->has('coupon')) {
            $couponSession = session()->get('coupon');
            // যদি সেশনের কুপন এই কোর্সের না হয়, তাহলে রিমুভ করে দাও
            if ($couponSession['course_id'] != $course->id) {
                session()->forget('coupon');
            }
        }

        return view('frontend.courses.checkout', compact('course', 'gateways'));
    }

    /**
     * [NEW] কুপন অ্যাপ্লাই করার ফাংশন
     */
    public function applyCoupon(Request $request, $courseId)
    {
        $request->validate(['coupon_code' => 'required|string']);

        $course = Course::findOrFail($courseId);
        $code = $request->coupon_code;

        // ১. কুপন খোঁজা
        $coupon = Coupon::where('code', $code)->first();

        // ২. সাধারণ ভ্যালিডেশন
        if (!$coupon) {
            return back()->with('error', 'কুপন কোডটি সঠিক নয়।');
        }

        if (!$coupon->is_active) {
            return back()->with('error', 'এই কুপনটি বর্তমানে নিষ্ক্রিয়।');
        }

        // ৩. মডেলের স্কোপ এবং মেথড দিয়ে ভ্যালিডেশন
        if (!$coupon->isValid()) {
            return back()->with('error', 'কুপনটির মেয়াদ শেষ বা ব্যবহারের সীমা অতিক্রম করেছে।');
        }

        // ৪. কোর্স এবং ইউজারের জন্য প্রযোজ্য কিনা
        if (!$coupon->canBeUsed(Auth::id(), $course->id)) {
            return back()->with('error', 'এই কুপনটি আপনার বা এই কোর্সের জন্য প্রযোজ্য নয়।');
        }

        // ৫. ডিসকাউন্ট ক্যালকুলেশন
        $originalPrice = $course->current_price;
        $discountAmount = $coupon->calculateDiscount($originalPrice);
        $newTotal = $originalPrice - $discountAmount;

        // ৬. সেশনে সংরক্ষণ
        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount' => $discountAmount,
            'new_total' => max(0, $newTotal), // নেগেটিভ যেন না হয়
            'course_id' => $course->id
        ]);

        return back()->with('success', 'কুপন অ্যাপ্লাই করা হয়েছে! আপনি ৳' . $discountAmount . ' ছাড় পেয়েছেন।');
    }

    /**
     * [NEW] কুপন রিমুভ করার ফাংশন
     */
    public function removeCoupon()
    {
        session()->forget('coupon');
        return back()->with('success', 'কুপন রিমুভ করা হয়েছে।');
    }

    public function store(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // [NEW] প্রাইস ক্যালকুলেশন (কুপন সহ)
        $payableAmount = $course->current_price;
        $couponData = null;

        if (session()->has('coupon')) {
            $sessionCoupon = session()->get('coupon');
            // ডাবল চেক: কুপনটি কি এই কোর্সের জন্যই ছিল?
            if ($sessionCoupon['course_id'] == $course->id) {
                $payableAmount = $sessionCoupon['new_total'];
                $couponData = $sessionCoupon;
            }
        }

        // ১. বেসিক ভ্যালিডেশন
        $rules = [
            'payment_method' => 'required|string',
        ];

        // ২. পেইড কোর্স হলে ভ্যালিডেশন
        // [UPDATED] $course->price এর বদলে $payableAmount চেক করা হচ্ছে (কারণ ডিসকাউন্টের পর ০ হতে পারে)
        if ($payableAmount > 0 && in_array($request->payment_method, ['bkash', 'rocket', 'nagad', 'manual'])) {
            $rules['transaction_id'] = 'required|string|max:255|unique:payments,transaction_id'; 
            $rules['sender_number'] = 'required|string|max:20';
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            // ৩. স্ট্যাটাস নির্ধারণ (টাকা ০ হলে active, নাহলে pending)
            $status = $payableAmount == 0 ? 'active' : 'pending';
            
            // ৪. এনরোলমেন্ট তৈরি
            $enrollment = Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'status' => $status,
                'price_paid' => $payableAmount, // [UPDATED] কুপন অ্যাপ্লাই করা প্রাইস
                'progress' => 0,
                'total_lessons' => $course->lessons()->count() ?? 0, 
                'enrolled_at' => $status === 'active' ? now() : null,
            ]);

            // [NEW] কুপন ইউসেজ রেকর্ড করা (যদি কুপন ব্যবহার হয়)
            if ($couponData) {
                // Usage টেবিলে এন্ট্রি
                CouponUsage::create([
                    'coupon_id' => $couponData['id'],
                    'user_id' => Auth::id(),
                    'course_id' => $course->id,
                    'discount_amount' => $couponData['discount'],
                ]);

                // কুপন কাউন্ট বাড়ানো
                Coupon::where('id', $couponData['id'])->increment('used_count');
                
                // সেশন ক্লিয়ার
                session()->forget('coupon');
            }

            // ৫. পেমেন্ট রেকর্ড তৈরি (টাকা ০ এর বেশি হলে)
            if ($payableAmount > 0) {
                Payment::create([
                    'user_id' => Auth::id(),
                    'course_id' => $course->id,
                    'enrollment_id' => $enrollment->id,
                    'transaction_id' => $request->transaction_id ?? strtoupper(Str::random(10)),
                    'payment_gateway' => $request->payment_method,
                    'amount' => $payableAmount, // [UPDATED]
                    'status' => 'pending',
                    'currency' => 'BDT',
                    'payment_details' => json_encode([
                        'sender_number' => $request->sender_number,
                        'method' => $request->payment_method,
                        'gateway_info' => 'Manual Transaction',
                        'coupon_applied' => $couponData ? $couponData['code'] : null // [OPTIONAL] মেটাডাটা
                    ]),
                ]);
            }

            DB::commit();

            return redirect()->route('courses.enroll.success', [
                'course_id' => $course->id, 
                'status' => $status
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'সমস্যা হয়েছে: ' . $e->getMessage())->withInput();
        }
    }

    public function success(Request $request)
    {
        if (!$request->has('course_id')) {
            return redirect()->route('home');
        }

        $course = Course::findOrFail($request->course_id);
        $status = $request->status ?? 'pending';
        
        return view('frontend.courses.success', compact('course', 'status'));
    }
}