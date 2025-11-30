@extends('layouts.student')

@section('title', 'সার্টিফিকেট - ' . $certificate->course->title)

@section('student-content')
<div class="max-w-5xl mx-auto">
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4 no-print">
        <div>
            <a href="{{ route('student.certificates.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="fas fa-arrow-left mr-2"></i> সব সার্টিফিকেটে ফিরে যান
            </a>
        </div>
        <div class="flex gap-3">
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition">
                <i class="fas fa-print mr-2"></i> প্রিন্ট
            </button>
            <a href="{{ route('student.certificates.download', $certificate->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition">
                <i class="fas fa-download mr-2"></i> ডাউনলোড PDF
            </a>
            
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.away="open = false" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition">
                    <i class="fas fa-share-alt mr-2"></i> শেয়ার
                </button>
                <div x-show="open" class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-md shadow-lg z-10 border border-gray-200 dark:border-slate-700 p-2" style="display: none;">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2 px-2">পাবলিক ভেরিফিকেশন লিংক:</p>
                    <div class="flex">
                        <input type="text" readonly value="{{ route('student.certificates.show', $certificate->verification_code) }}" class="flex-1 text-xs p-2 border rounded-l-md bg-gray-50 dark:bg-slate-900 dark:border-slate-700 dark:text-gray-300 focus:outline-none">
                        <button onclick="copyLink(this)" data-link="{{ route('student.certificates.show', $certificate->verification_code) }}" class="px-3 bg-blue-50 text-blue-600 rounded-r-md hover:bg-blue-100 transition">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-3 gap-2 mt-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('student.certificates.show', $certificate->verification_code)) }}" target="_blank" class="flex items-center justify-center p-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('student.certificates.show', $certificate->verification_code)) }}" target="_blank" class="flex items-center justify-center p-2 bg-blue-800 text-white rounded hover:bg-blue-900">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('student.certificates.show', $certificate->verification_code)) }}&text=I just earned a certificate!" target="_blank" class="flex items-center justify-center p-2 bg-sky-500 text-white rounded hover:bg-sky-600">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 p-8 rounded-xl shadow-lg border border-gray-200 dark:border-slate-700 text-center relative overflow-hidden certificate-frame">
        
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05] pointer-events-none flex items-center justify-center">
            <img src="{{ asset('images/logo-icon.png') }}" class="w-2/3 h-auto" alt="Watermark">
        </div>

        @if($certificate->is_revoked)
            <div class="absolute inset-0 bg-white/80 dark:bg-slate-900/80 flex items-center justify-center z-10 backdrop-blur-sm">
                <div class="bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 px-8 py-6 rounded-lg shadow-lg max-w-md text-center border border-red-200 dark:border-red-800">
                    <i class="fas fa-ban text-5xl mb-4 text-red-500"></i>
                    <h2 class="text-2xl font-bold mb-2">এই সার্টিফিকেটটি বাতিল করা হয়েছে</h2>
                    <p class="text-sm opacity-80">কারণ: {{ $certificate->revocation_reason ?? 'অজানা কারণ' }}</p>
                </div>
            </div>
        @endif

        <div class="relative z-0 py-12 px-8 md:px-16 border-8 border-double border-gray-100 dark:border-slate-700/50 m-4">
            <img src="{{ asset('images/logo.png') }}" alt="ProjuktiPlus LMS" class="h-16 mx-auto mb-8">

            <h1 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 dark:text-white mb-4 uppercase tracking-widest">Certificate</h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-2">OF COMPLETION</p>
            
            <div class="w-32 h-1 bg-blue-600 mx-auto mb-8"></div>

            <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">This is to certify that</p>
            <h2 class="text-3xl md:text-4xl font-bold text-blue-700 dark:text-blue-400 mb-4 font-serif italic">{{ $certificate->user->name }}</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">has successfully completed the course</p>
            
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-12">{{ $certificate->course->title }}</h3>

            <div class="grid grid-cols-2 gap-8 mt-16 pt-8 border-t border-gray-200 dark:border-slate-700">
                <div class="text-center">
                    <div class="mb-2">
                        <img src="{{ asset('images/signatures/ceo-sig.png') }}" alt="Signature" class="h-12 mx-auto opacity-80">
                    </div>
                    <div class="w-40 h-px bg-gray-400 mx-auto mb-2"></div>
                    <p class="font-bold text-gray-800 dark:text-gray-200">CEO Name</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Chief Executive Officer</p>
                </div>
                <div class="text-center">
                     <div class="mb-2 pt-4"> <p class="font-serif italic text-lg text-gray-700 dark:text-gray-300">{{ $certificate->course->instructor->name }}</p>
                    </div>
                    <div class="w-40 h-px bg-gray-400 mx-auto mb-2"></div>
                    <p class="font-bold text-gray-800 dark:text-gray-200">Instructor</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $certificate->course->instructor->name }}</p>
                </div>
            </div>

            <div class="mt-16 text-xs text-gray-400 dark:text-gray-500 flex justify-between items-end">
                <div class="text-left">
                    <p>Certificate ID: <span class="font-mono">{{ $certificate->certificate_number }}</span></p>
                    <p>Issue Date: {{ $certificate->issue_date->format('F d, Y') }}</p>
                </div>
                <div class="text-right">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ route('student.certificates.show', $certificate->verification_code) }}" alt="Verification QR" class="w-16 h-16 opacity-80 ml-auto">
                    <p class="mt-1">Verify at: {{ url('/') }}/verify</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @media print {
        .no-print { display: none !important; }
        body { background: white !important; color: black !important; }
        .certificate-frame { box-shadow: none !important; border: none !important; }
        .dark { color-scheme: light; } /* Force light mode for print */
    }
</style>
@endpush

@push('scripts')
<script>
    function copyLink(button) {
        const link = button.getAttribute('data-link');
        navigator.clipboard.writeText(link).then(() => {
            const originalHtml = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check"></i>';
            setTimeout(() => {
                button.innerHTML = originalHtml;
            }, 2000);
        });
    }
</script>
@endpush
@endsection