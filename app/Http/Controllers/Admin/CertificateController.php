<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\CertificateTemplate;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CertificateController extends Controller
{
    /**
     * Display a listing of the certificates.
     */
    public function index(Request $request)
    {
        $query = Certificate::with(['user', 'course', 'enrollment'])
            ->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('certificate_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('course', function($q) use ($search) {
                      $q->where('title', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            switch ($request->status) {
                case 'valid':
                    $query->valid();
                    break;
                case 'revoked':
                    $query->revoked();
                    break;
                case 'expired':
                    $query->expired();
                    break;
            }
        }

        $certificates = $query->paginate(10);

        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new certificate.
     */
    public function create()
    {
        $users = User::where('status', 'active')->get();
        $courses = Course::where('status', 'published')->get();
        
        $enrollments = Enrollment::with(['user', 'course'])
            ->whereIn('status', ['active', 'completed'])
            ->get();
        
        return view('admin.certificates.create', compact('users', 'courses', 'enrollments'));
    }

    /**
     * Store a newly created certificate in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_id' => 'required|exists:enrollments,id',
            'issue_date' => 'required|date',
            'validity_period' => 'nullable|integer|min:0',
        ]);

        // ডুপ্লিকেট চেক
        $existingCertificate = Certificate::where('user_id', $request->user_id)
            ->where('course_id', $request->course_id)
            ->where('is_revoked', false)
            ->first();

        if ($existingCertificate) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'এই শিক্ষার্থী এবং কোর্সের জন্য ইতিমধ্যে একটি অ্যাক্টিভ সার্টিফিকেট আছে।');
        }

        // ডাটা জেনারেশন
        $certificateNumber = 'CERT-' . strtoupper(Str::random(8)) . '-' . time();
        $verificationCode = Str::random(32);

        $certificateData = [
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'enrollment_id' => $request->enrollment_id,
            'certificate_number' => $certificateNumber,
            'issue_date' => $request->issue_date,
            'validity_period' => $request->validity_period,
            'expiry_date' => $request->validity_period ? now()->parse($request->issue_date)->addMonths($request->validity_period) : null,
            'verification_code' => $verificationCode,
        ];

        // PDF জেনারেশন
        try {
            $filename = $this->generateCertificatePdf($certificateData);
            $certificateData['certificate_url'] = $filename; // এখানে রিলেটিভ পাথ সেভ হবে (যেমন: certificates/abc.pdf)
        } catch (\Exception $e) {
            // PDF ফেইল করলে ডিফল্ট পাথ এবং এরর লগ করা যেতে পারে
            // এখানে আমরা ফাইলের নাম দিয়ে রাখছি যাতে পরে জেনারেট করা যায়
            $certificateData['certificate_url'] = 'certificates/' . $certificateNumber . '.pdf';
        }

        Certificate::create($certificateData);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'সার্টিফিকেট সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * Download certificate PDF (FIXED)
     * এখানে Accessor বাইপাস করে আসল পাথ নেওয়া হয়েছে।
     */
    public function download(Certificate $certificate)
    {
        // [FIX] Accessor (getCertificateUrlAttribute) বাইপাস করে ডাটাবেসের আসল ভ্যালু নেওয়া হচ্ছে
        $relativePath = $certificate->getRawOriginal('certificate_url');
        
        // যদি পাথ না থাকে বা ভুল থাকে, ম্যানুয়ালি তৈরি করা
        if (!$relativePath) {
            $relativePath = 'certificates/' . $certificate->certificate_number . '.pdf';
        }

        // স্টোরেজ পাথ চেক করা
        // 'public' ডিস্কের রুট হলো storage/app/public
        if (!Storage::disk('public')->exists($relativePath)) {
            // ফাইল না থাকলে পুনরায় জেনারেট করার চেষ্টা
            try {
                $data = $certificate->toArray();
                // ডেট অবজেক্টগুলো নিশ্চিত করা
                $data['issue_date'] = $certificate->issue_date;
                $data['expiry_date'] = $certificate->expiry_date;
                
                // নতুন করে জেনারেট
                $newPath = $this->generateCertificatePdf($data);
                
                // ডাটাবেস আপডেট (যদি পাথ ভিন্ন হয়)
                if ($newPath !== $relativePath) {
                    $certificate->update(['certificate_url' => $newPath]);
                    $relativePath = $newPath;
                }

            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'PDF ফাইলটি পাওয়া যায়নি এবং নতুন করে তৈরি করা সম্ভব হয়নি। Error: ' . $e->getMessage());
            }
        }

        // ডাউনলোড রিটার্ন (Storage Facade সঠিক পাথ হ্যান্ডেল করবে)
        return Storage::disk('public')->download($relativePath);
    }

    /**
     * Display the specified certificate.
     */
    public function show(Certificate $certificate)
    {
        $certificate->load(['user', 'course', 'enrollment']);
        return view('admin.certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified certificate.
     */
    public function edit(Certificate $certificate)
    {
        $users = User::where('status', 'active')->get();
        $courses = Course::where('status', 'published')->get();
        $enrollments = Enrollment::with(['user', 'course'])->get();
        
        return view('admin.certificates.edit', compact('certificate', 'users', 'courses', 'enrollments'));
    }

    /**
     * Update the specified certificate in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_id' => 'required|exists:enrollments,id',
            'issue_date' => 'required|date',
            'validity_period' => 'nullable|integer|min:0',
        ]);

        $certificate->update([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'enrollment_id' => $request->enrollment_id,
            'issue_date' => $request->issue_date,
            'validity_period' => $request->validity_period,
            'expiry_date' => $request->validity_period ? now()->parse($request->issue_date)->addMonths($request->validity_period) : null,
        ]);

        return redirect()->route('admin.certificates.show', $certificate)
            ->with('success', 'সার্টিফিকেট আপডেট করা হয়েছে।');
    }

    /**
     * Revoke the specified certificate.
     */
    public function revoke(Request $request, Certificate $certificate)
    {
        $request->validate(['revocation_reason' => 'required|string|max:500']);
        $certificate->revoke($request->revocation_reason);
        return back()->with('success', 'সার্টিফিকেট সফলভাবে বাতিল করা হয়েছে।');
    }

    /**
     * Restore the specified certificate.
     */
    public function restore(Certificate $certificate)
    {
        $certificate->update([
            'is_revoked' => false,
            'revocation_reason' => null,
            'revoked_at' => null,
        ]);
        return back()->with('success', 'সার্টিফিকেট সফলভাবে পুনরুদ্ধার করা হয়েছে।');
    }

    /**
     * Verify certificate via Code
     */
    public function verify(Request $request, $code = null)
    {
        $searchCode = $code ?? $request->input('code') ?? $request->input('certificate_number');
        $certificate = null;
        if ($searchCode) {
            $certificate = Certificate::where('verification_code', $searchCode)
                ->orWhere('certificate_number', $searchCode)
                ->with(['user', 'course'])
                ->first();
        }
        return view('admin.certificates.verify', compact('certificate'));
    }

    // ---------------------------------------------------
    // Template Management
    // ---------------------------------------------------

    public function templates() {
        $templates = CertificateTemplate::orderBy('is_default', 'desc')->latest()->get();
        return view('admin.certificates.templates.index', compact('templates'));
    }
    public function createTemplate() { return view('admin.certificates.templates.create'); }
    public function storeTemplate(Request $request) {
        $request->validate(['name' => 'required', 'background_image' => 'required|image']);
        $path = $request->file('background_image')->store('certificate-templates', 'public');
        CertificateTemplate::create([
            'name' => $request->name, 'background_image' => $path, 
            'is_default' => $request->has('is_default'), 'is_active' => true
        ]);
        return redirect()->route('admin.certificates.templates')->with('success', 'টেমপ্লেট তৈরি হয়েছে।');
    }
    public function editTemplate(CertificateTemplate $template) { return view('admin.certificates.templates.edit', compact('template')); }
    public function updateTemplate(Request $request, CertificateTemplate $template) {
        if ($request->hasFile('background_image')) {
            $template->background_image = $request->file('background_image')->store('certificate-templates', 'public');
        }
        $template->name = $request->name;
        if ($request->boolean('is_default')) { 
            CertificateTemplate::where('id', '!=', $template->id)->update(['is_default' => false]); 
            $template->is_default = true; 
        }
        $template->is_active = $request->boolean('is_active');
        $template->save();
        return redirect()->route('admin.certificates.templates')->with('success', 'টেমপ্লেট আপডেট হয়েছে।');
    }
    public function destroyTemplate(CertificateTemplate $template) { 
        if(!$template->is_default) $template->delete(); 
        return back(); 
    }

    // Helper: Generate PDF
    private function generateCertificatePdf($data)
    {
        $user = User::find($data['user_id']);
        $course = Course::find($data['course_id']);
        
        // অ্যাক্টিভ এবং ডিফল্ট টেমপ্লেট খোঁজা
        $template = CertificateTemplate::where('is_active', true)->where('is_default', true)->first() 
                 ?? CertificateTemplate::where('is_active', true)->first();

        $bgImage = $template ? public_path('storage/' . $template->background_image) : null;
        
        $html = view('admin.certificates.pdf_template', [
            'user' => $user, 'course' => $course, 'data' => $data, 'bgImage' => $bgImage
        ])->render();

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');
        $filename = 'certificates/' . $data['certificate_number'] . '.pdf';
        
        Storage::disk('public')->put($filename, $pdf->output());
        
        return $filename;
    }
}