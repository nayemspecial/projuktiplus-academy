<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF; // ধরে নিচ্ছি আপনি dompdf বা snappy ব্যবহার করবেন

class CertificateController extends Controller
{
    /**
     * স্টুডেন্টের সব সার্টিফিকেটের তালিকা
     */
    public function index()
    {
        $certificates = Certificate::where('user_id', Auth::id())
            ->with('course')
            ->latest('issue_date')
            ->paginate(9);

        return view('student.certificates.index', compact('certificates'));
    }

    /**
     * সার্টিফিকেট জেনারেট এবং ভিউ করা (যদি এখনো জেনারেট না হয়ে থাকে)
     */
    public function show(Request $request, $certificate_id)
    {
        // আমরা এখানে ID অথবা verification_code দুটি দিয়েই সার্টিফিকেট খুঁজতে পারি
        // যাতে পাবলিকলি শেয়ার করা যায়
        $certificate = Certificate::where('id', $certificate_id)
            ->orWhere('verification_code', $certificate_id)
            ->with(['user', 'course.instructor'])
            ->firstOrFail();

        // যদি স্টুডেন্ট নিজে দেখে অথবা পাবলিক ভিউ হয়
        return view('student.certificates.show', compact('certificate'));
    }

    /**
     * নতুন সার্টিফিকেট জেনারেট করা (কোর্স কমপ্লিট হওয়ার পর)
     * এটি সাধারণত অটোমেটিক কল হবে যখন কোর্স ১০০% হবে, তবে ম্যানুয়াল রিকোয়েস্টও রাখা ভালো
     */
    public function generate(Course $course)
    {
        $user = Auth::user();
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('status', 'completed')
            ->firstOrFail();

        // চেক করি ইতিমধ্যে সার্টিফিকেট আছে কিনা
        $existingCertificate = Certificate::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingCertificate) {
            return redirect()->route('student.certificates.show', $existingCertificate->id);
        }

        // নতুন সার্টিফিকেট তৈরি
        $certificateNumber = 'CERT-' . date('Ymd') . '-' . strtoupper(Str::random(8));
        $verificationCode = Str::uuid();

        $certificate = Certificate::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'enrollment_id' => $enrollment->id,
            'certificate_number' => $certificateNumber,
            'certificate_url' => 'certificates/' . $certificateNumber . '.pdf', // ডামি পাথ
            'issue_date' => now(),
            'verification_code' => $verificationCode,
        ]);

        // এখানে PDF জেনারেট করে স্টোরেজে সেভ করার লজিক থাকবে
        // $this->generatePDF($certificate);

        return redirect()->route('student.certificates.show', $certificate->id)
            ->with('success', 'অভিনন্দন! আপনার সার্টিফিকেট তৈরি হয়েছে।');
    }

    /**
     * সার্টিফিকেট ডাউনলোড
     */
    public function download(Certificate $certificate)
    {
        // সিকিউরিটি চেক: নিজের সার্টিফিকেট কিনা (যদি পাবলিক না হয়)
        if (Auth::check() && $certificate->user_id !== Auth::id()) {
            abort(403);
        }

        // ফাইল ডাউনলোড লজিক (বাস্তবে স্টোরেজ থেকে ফাইল রিটার্ন করবে)
        // return Storage::download($certificate->certificate_url);
        
        // আপাতত ডামি ডাউনলোড
        return response()->streamDownload(function () use ($certificate) {
            echo "This is a dummy PDF for certificate: " . $certificate->certificate_number;
        }, $certificate->certificate_number . '.pdf');
    }
}