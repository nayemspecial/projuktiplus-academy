<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentGateway; // [নতুন] মডেল ইম্পোর্ট
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index()
    {
        $payments = Payment::with(['user', 'course'])
            ->latest()
            ->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        $payment->load(['user', 'course']);
        
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        $users = User::select('id', 'name', 'email')->get();
        $courses = Course::select('id', 'title', 'price')->get();
        
        return view('admin.payments.create', compact('users', 'courses'));
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'transaction_id' => 'required|unique:payments,transaction_id',
            'payment_gateway' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
            'gateway_fee' => 'nullable|numeric|min:0',
            'platform_fee' => 'nullable|numeric|min:0',
            'instructor_earnings' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:3',
            'status' => 'required|in:pending,completed,failed,refunded,disputed',
            'payment_details' => 'nullable|json',
            'refund_details' => 'nullable|json',
            'completed_at' => 'nullable|date',
            'refunded_at' => 'nullable|date',
        ]);

        try {
            DB::beginTransaction();
            
            $payment = Payment::create($validated);
            
            DB::commit();
            
            return redirect()->route('admin.payments.show', $payment)
                ->with('success', 'Payment created successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create payment: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified payment.
     */
    public function edit(Payment $payment)
    {
        $users = User::select('id', 'name', 'email')->get();
        $courses = Course::select('id', 'title')->get();
        
        return view('admin.payments.edit', compact('payment', 'users', 'courses'));
    }

    /**
     * Update the specified payment in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'transaction_id' => 'required|unique:payments,transaction_id,' . $payment->id,
            'payment_gateway' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
            'gateway_fee' => 'nullable|numeric|min:0',
            'platform_fee' => 'nullable|numeric|min:0',
            'instructor_earnings' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:3',
            'status' => 'required|in:pending,completed,failed,refunded,disputed',
            'payment_details' => 'nullable|json',
            'refund_details' => 'nullable|json',
            'completed_at' => 'nullable|date',
            'refunded_at' => 'nullable|date',
        ]);

        try {
            DB::beginTransaction();
            
            $payment->update($validated);
            
            DB::commit();
            
            return redirect()->route('admin.payments.show', $payment)
                ->with('success', 'Payment updated successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update payment: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * [আপডেট] পেমেন্ট গেটওয়ে সেটিংস পেজ (ডাটাবেস থেকে লোড)
     */
    public function gateways()
    {
        // হার্ডকোড অ্যারের বদলে ডাটাবেস থেকে আনা হচ্ছে
        $gateways = PaymentGateway::all();
        
        return view('admin.payments.gateways', compact('gateways'));
    }

    /**
     * [আপডেট] পেমেন্ট গেটওয়ে সেটিংস আপডেট
     */
    public function updateGateway(Request $request, $id)
    {
        $gateway = PaymentGateway::findOrFail($id);

        // ভ্যালিডেশন বা চেকবক্স হ্যান্ডলিং
        $gateway->is_active = $request->has('is_active');
        $gateway->test_mode = $request->has('test_mode');

        // ক্রেডেনশিয়ালস আপডেট (JSON ফিল্ড)
        if ($request->has('credentials')) {
            // আগের ক্রেডেনশিয়ালস এর সাথে নতুন ইনপুট মার্জ করা হচ্ছে
            $currentCredentials = $gateway->credentials ?? [];
            $newCredentials = $request->input('credentials');
            
            $gateway->credentials = array_merge($currentCredentials, $newCredentials);
        }

        $gateway->save();
        
        return back()->with('success', $gateway->title . ' এর সেটিংস সফলভাবে আপডেট করা হয়েছে।');
    }
}