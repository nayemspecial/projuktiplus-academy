<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // এই লাইনটি জরুরি
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    /**
     * এনরোলমেন্ট তালিকা
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('search');

        // পেমেন্ট রিলেশন সহ লোড করা হচ্ছে
        $query = Enrollment::with(['user', 'course', 'payment'])
            ->latest();

        // স্ট্যাটাস ফিল্টার
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        // সার্চ (ইউজার, কোর্স বা ট্রানজেকশন আইডি দিয়ে)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($u) use ($search) {
                    $u->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('course', function($c) use ($search) {
                    $c->where('title', 'like', "%{$search}%");
                })
                ->orWhereHas('payment', function($p) use ($search) {
                    $p->where('transaction_id', 'like', "%{$search}%");
                });
            });
        }

        $enrollments = $query->paginate(15)->withQueryString();
            
        return view('admin.enrollments.index', compact('enrollments', 'status', 'search'));
    }

    /**
     * ম্যানুয়াল এনরোলমেন্ট ফর্ম
     */
    public function create()
    {
        $users = User::where('role', 'student')->select('id', 'name', 'email')->get()->mapWithKeys(function ($user) {
            return [$user->id => $user->name . ' (' . $user->email . ')'];
        });
        
        $courses = Course::select('id', 'title', 'price')->get()->mapWithKeys(function ($course) {
            return [$course->id => $course->title . ' - ৳' . $course->price];
        });
        
        $statuses = [
            'active' => 'Active',
            'pending' => 'Pending',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'refunded' => 'Refunded'
        ];
        
        return view('admin.enrollments.create', compact('users', 'courses', 'statuses'));
    }

    /**
     * ম্যানুয়াল এনরোলমেন্ট স্টোর
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required',
            'price_paid' => 'nullable|numeric'
        ]);
        
        // ডুপ্লিকেট চেক
        $exists = Enrollment::where('user_id', $request->user_id)->where('course_id', $request->course_id)->exists();
        if($exists){
             return back()->with('error', 'এই ব্যবহারকারী ইতিমধ্যেই এনরোল করা আছে।')->withInput();
        }

        // কোর্স তথ্য আনা
        $course = Course::find($request->course_id);

        try {
            DB::beginTransaction();

            $enrollment = Enrollment::create([
                'user_id' => $validated['user_id'],
                'course_id' => $validated['course_id'],
                'status' => $validated['status'],
                'price_paid' => $validated['price_paid'] ?? 0,
                'progress' => 0,
                'total_lessons' => $course->lessons()->count() ?? 0,
                'enrolled_at' => ($validated['status'] == 'active') ? now() : null,
            ]);

            // যদি ম্যানুয়ালি টাকা পেইড দেখানো হয়, তবে পেমেন্ট রেকর্ডও তৈরি করা ভালো
            if (($validated['price_paid'] ?? 0) > 0) {
                Payment::create([
                    'user_id' => $validated['user_id'],
                    'course_id' => $validated['course_id'],
                    'enrollment_id' => $enrollment->id,
                    'transaction_id' => 'MANUAL-' . strtoupper(uniqid()),
                    'payment_gateway' => 'manual_admin',
                    'amount' => $validated['price_paid'],
                    'status' => ($validated['status'] == 'active') ? 'completed' : 'pending',
                    'currency' => 'BDT',
                    'payment_details' => json_encode(['note' => 'Created manually by admin']),
                    'completed_at' => ($validated['status'] == 'active') ? now() : null,
                ]);
            }

            DB::commit();
            return redirect()->route('admin.enrollments.index')->with('success', 'এনরোলমেন্ট সফলভাবে তৈরি হয়েছে।');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'সমস্যা হয়েছে: ' . $e->getMessage());
        }
    }

    /**
     * এনরোলমেন্ট বিস্তারিত
     */
    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['user', 'course', 'payment', 'completedLessons', 'quizAttempts', 'certificates']);
        return view('admin.enrollments.show', compact('enrollment'));
    }

    /**
     * এডিট ফর্ম
     */
    public function edit(Enrollment $enrollment)
    {
        $users = User::where('id', $enrollment->user_id)->get()->mapWithKeys(fn($u) => [$u->id => $u->name]);
        $courses = Course::where('id', $enrollment->course_id)->get()->mapWithKeys(fn($c) => [$c->id => $c->title]);
        
        $statuses = [
            'active' => 'Active',
            'pending' => 'Pending',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'refunded' => 'Refunded'
        ];
        
        return view('admin.enrollments.edit', compact('enrollment', 'users', 'courses', 'statuses'));
    }

    /**
     * আপডেট (জেনারেল)
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'status' => 'required|in:active,pending,completed,cancelled,refunded',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        // স্ট্যাটাস আপডেটের জন্য আমরা updateStatus মেথডটিই রিইউজ করতে পারি অথবা আলাদা লজিক লিখতে পারি।
        // এখানে সিম্পল আপডেট রাখা হলো।
        $enrollment->update($validated);
        
        return redirect()->route('admin.enrollments.index')->with('success', 'আপডেট সম্পন্ন হয়েছে।');
    }

    /**
     * [MISSING METHOD FIXED]
     * এনরোলমেন্ট স্ট্যাটাস আপডেট (Approve/Reject বাটন থেকে কল হয়)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,cancelled',
        ]);

        try {
            DB::beginTransaction();

            $enrollment = Enrollment::with('payment')->findOrFail($id);
            $newStatus = $request->status;

            // ১. এনরোলমেন্ট আপডেট
            $enrollment->update([
                'status' => $newStatus,
                // যদি active করা হয়, এবং আগে ডেট না থাকে, তবে আজকের তারিখ বসবে
                'enrolled_at' => ($newStatus == 'active' && !$enrollment->enrolled_at) ? now() : $enrollment->enrolled_at
            ]);

            // ২. পেমেন্ট স্ট্যাটাস আপডেট (যদি পেমেন্ট থাকে)
            if ($enrollment->payment) {
                if ($newStatus == 'active') {
                    $enrollment->payment->update([
                        'status' => 'completed',
                        'completed_at' => now()
                    ]);
                } elseif ($newStatus == 'cancelled') {
                    $enrollment->payment->update(['status' => 'failed']);
                }
            }

            DB::commit();

            $msg = $newStatus == 'active' ? 'এনরোলমেন্ট অ্যাপ্রুভ করা হয়েছে!' : 'এনরোলমেন্ট বাতিল করা হয়েছে।';
            return back()->with('success', $msg);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'সমস্যা হয়েছে: ' . $e->getMessage());
        }
    }

    /**
     * ডিলিট
     */
    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        if($enrollment->payment) {
            $enrollment->payment->delete();
        }
        $enrollment->delete();
        return back()->with('success', 'রেকর্ড ডিলিট করা হয়েছে।');
    }
}