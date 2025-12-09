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

        $rules = [
            'payment_method' => 'required|string',
        ];

        if ($course->price > 0 && in_array($request->payment_method, ['bkash', 'rocket', 'nagad', 'manual'])) {
            $rules['transaction_id'] = 'required|string|max:255';
            $rules['sender_number'] = 'required|string|max:20';
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            // স্ট্যাটাস নির্ধারণ (ডাটাবেসে 'pending' থাকতে হবে)
            $status = $course->price == 0 ? 'active' : 'pending';
            
            // ১. এনরোলমেন্ট তৈরি
            $enrollment = Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'status' => $status,
                'price_paid' => $course->current_price,
                'progress' => 0,
                'total_lessons' => $course->lessons()->count() ?? 0,
                'enrolled_at' => $status === 'active' ? now() : null, // শুধুমাত্র একটিভ হলে ডেট বসবে
            ]);

            // ২. পেমেন্ট রেকর্ড তৈরি
            if ($course->price > 0) {
                Payment::create([
                    'user_id' => Auth::id(),
                    'course_id' => $course->id,
                    'enrollment_id' => $enrollment->id, // [FIX] আইডি লিংক করা হলো (মাইগ্রেশনে এই কলাম থাকা লাগবে)
                    'transaction_id' => $request->transaction_id ?? strtoupper(Str::random(10)),
                    'payment_gateway' => $request->payment_method,
                    'amount' => $course->current_price,
                    'status' => 'pending',
                    'currency' => 'BDT',
                    'payment_details' => json_encode([
                        'sender_number' => $request->sender_number,
                        'method' => $request->payment_method,
                        'gateway_info' => 'Manual Transaction'
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
            return back()->with('error', 'সমস্যা হয়েছে: ' . $e->getMessage())->withInput();
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