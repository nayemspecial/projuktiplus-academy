<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\PaymentGateway;
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

        return view('frontend.courses.checkout', compact('course', 'gateways'));
    }

    public function store(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // ১. বেসিক ভ্যালিডেশন
        $rules = [
            'payment_method' => 'required|string',
        ];

        // ২. পেইড কোর্স এবং ম্যানুয়াল পেমেন্টের জন্য অতিরিক্ত ভ্যালিডেশন
        if ($course->price > 0 && in_array($request->payment_method, ['bkash', 'rocket', 'nagad', 'manual'])) {
            // [নিরাপত্তা] transaction_id অবশ্যই ইউনিক হতে হবে payments টেবিলে
            $rules['transaction_id'] = 'required|string|max:255|unique:payments,transaction_id'; 
            $rules['sender_number'] = 'required|string|max:20';
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            // ৩. স্ট্যাটাস নির্ধারণ (ফ্রি হলে active, পেইড হলে pending)
            // আপনার ডাটাবেসে এখন 'pending' স্ট্যাটাস সাপোর্ট করবে।
            $status = $course->price == 0 ? 'active' : 'pending';
            
            // ৪. এনরোলমেন্ট তৈরি
            $enrollment = Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'status' => $status,
                'price_paid' => $course->current_price,
                'progress' => 0,
                // রিলেশনশিপ এরর এড়াতে সরাসরি চেক করা ভালো
                'total_lessons' => $course->lessons()->count() ?? 0, 
                'enrolled_at' => $status === 'active' ? now() : null, // শুধুমাত্র একটিভ হলে ডেট বসবে
            ]);

            // ৫. পেমেন্ট রেকর্ড তৈরি (শুধুমাত্র পেইড কোর্সের জন্য)
            if ($course->price > 0) {
                Payment::create([
                    'user_id' => Auth::id(),
                    'course_id' => $course->id,
                    'enrollment_id' => $enrollment->id, // এনরোলমেন্ট আইডি লিংক করা হলো
                    'transaction_id' => $request->transaction_id ?? strtoupper(Str::random(10)),
                    'payment_gateway' => $request->payment_method,
                    'amount' => $course->current_price,
                    'status' => 'pending', // পেমেন্ট ডিফল্টভাবে পেন্ডিং থাকবে
                    'currency' => 'BDT',
                    'payment_details' => json_encode([
                        'sender_number' => $request->sender_number,
                        'method' => $request->payment_method,
                        'gateway_info' => 'Manual Transaction'
                    ]),
                ]);
            }

            DB::commit();

            // ৬. সাকসেস পেজে রিডাইরেক্ট
            return redirect()->route('courses.enroll.success', [
                'course_id' => $course->id, 
                'status' => $status
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            // এরর লগ বা ডিবাগিংয়ের জন্য মেসেজ দেখালে সুবিধা হবে
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