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
use Illuminate\Support\Facades\Cache; // ক্যাশ ফ্যাসাড যোগ করা হয়েছে
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * চেকআউট পেজ প্রদর্শন
     */
    public function index($slug)
    {
        // ১. অপ্টিমাইজেশন: Eager Loading ব্যবহার করা হয়েছে (with 'instructor')
        // যাতে ভিউ ফাইলে ইনস্ট্রাক্টরের নাম দেখাতে গিয়ে বাড়তি কুয়েরি না হয়।
        $course = Course::with('instructor')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // যদি স্টুডেন্ট ইতিমধ্যে এনরোল করা থাকে
        if (Auth::check() && Enrollment::where('user_id', Auth::id())->where('course_id', $course->id)->exists()) {
            return redirect()->route('student.courses.show', $course->id)
                ->with('info', 'আপনি ইতিমধ্যে এই কোর্সে এনরোল করেছেন।');
        }

        // ২. অপ্টিমাইজেশন: পেমেন্ট গেটওয়ে লিস্ট ক্যাশ করা হয়েছে (১ দিনের জন্য)
        // কারণ গেটওয়ে লিস্ট সচরাচর পরিবর্তন হয় না, তাই বারবার ডাটাবেস হিট করার দরকার নেই।
        $gateways = Cache::remember('active_payment_gateways', 60 * 24, function () {
            return PaymentGateway::where('is_active', true)->get();
        });

        return view('frontend.courses.checkout', compact('course', 'gateways'));
    }

    /**
     * এনরোলমেন্ট প্রসেস (পেমেন্ট সাবমিট)
     */
    public function store(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'payment_method' => 'required|string',
            'transaction_id' => 'nullable|string|max:255',
            'sender_number' => 'nullable|string|max:20',
        ]);

        try {
            DB::beginTransaction();

            // ১. এনরোলমেন্ট তৈরি
            // ফ্রি কোর্স হলে সরাসরি 'active', পেইড হলে 'pending' (অ্যাডমিন অ্যাপ্রুভাল লাগবে)
            $status = $course->price == 0 ? 'active' : 'pending';
            
            $enrollment = Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'status' => $status,
                'price_paid' => $course->current_price, // মডেলের অ্যাক্সেসর ব্যবহার হচ্ছে
                'enrolled_at' => now(),
            ]);

            // ২. পেমেন্ট রেকর্ড তৈরি (শুধুমাত্র পেইড কোর্সের জন্য)
            if ($course->price > 0) {
                Payment::create([
                    'user_id' => Auth::id(),
                    'course_id' => $course->id,
                    'transaction_id' => $request->transaction_id ?? strtoupper(Str::random(10)),
                    'payment_gateway' => $request->payment_method,
                    'amount' => $course->current_price,
                    'status' => 'pending',
                    'currency' => 'BDT',
                    'payment_details' => json_encode([
                        'sender_number' => $request->sender_number,
                        'method' => $request->payment_method,
                        'gateway_info' => $request->payment_method == 'manual' ? 'Manual Transaction' : 'Online Gateway'
                    ]),
                ]);
            }

            DB::commit();

            // সাকসেস মেসেজ এবং রিডাইরেক্ট
            if ($status === 'active') {
                return redirect()->route('student.dashboard')->with('success', 'অভিনন্দন! কোর্সে সফলভাবে এনরোল করা হয়েছে।');
            } else {
                return redirect()->route('student.dashboard')->with('success', 'আপনার পেমেন্ট রিকোয়েস্ট জমা হয়েছে। অ্যাডমিন ভেরিফাই করার পর কোর্সটি চালু হবে।');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            // প্রোডাকশনে $e->getMessage() ইউজারকে না দেখানোই ভালো, লগ ফাইলে রাখা উচিত।
            // তবে ডেভেলপমেন্টের জন্য ঠিক আছে।
            return back()->with('error', 'এনরোলমেন্ট প্রসেসে সমস্যা হয়েছে। দয়া করে আবার চেষ্টা করুন।');
        }
    }
}