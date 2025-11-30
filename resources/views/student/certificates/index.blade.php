@extends('layouts.student')

@section('title', 'আমার সার্টিফিকেট - ProjuktiPlus LMS')

@section('student-content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">আমার অর্জনসমূহ</h1>
        <p class="text-gray-600 dark:text-gray-400">আপনার সম্পন্ন করা কোর্সের সার্টিফিকেটগুলো এখানে পাবেন</p>
    </div>

    @if($certificates->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($certificates as $certificate)
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden hover:shadow-md transition flex flex-col">
            <div class="relative h-48 bg-gray-100 dark:bg-slate-900 flex items-center justify-center p-4">
                <img src="{{ asset('images/certificate-placeholder.png') }}" alt="Certificate Preview" class="max-h-full max-w-full object-contain shadow-sm opacity-80">
                
                @if($certificate->is_revoked)
                    <div class="absolute top-2 right-2 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                        বাতিলকৃত
                    </div>
                @endif
            </div>

            <div class="p-5 flex-1 flex flex-col">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 line-clamp-2" title="{{ $certificate->course->title }}">
                    {{ $certificate->course->title }}
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                    ইস্যুর তারিখ: {{ $certificate->issue_date->format('d M, Y') }}
                </p>

                <div class="mt-auto grid grid-cols-2 gap-3">
                    <a href="{{ route('student.certificates.show', $certificate->id) }}" class="flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition">
                        <i class="far fa-eye mr-2"></i> দেখুন
                    </a>
                    <a href="{{ route('student.certificates.download', $certificate->id) }}" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition">
                        <i class="fas fa-download mr-2"></i> ডাউনলোড
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $certificates->links() }}
    </div>

    @else
    <div class="text-center py-16 bg-white dark:bg-slate-800 rounded-lg shadow-sm">
        <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-100 dark:bg-blue-900/30 rounded-full mb-6">
            <i class="fas fa-award text-5xl text-blue-600 dark:text-blue-500"></i>
        </div>
        <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">এখনো কোনো সার্টিফিকেট অর্জন করেননি</h3>
        <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto mb-6">কোর্স সম্পন্ন করার পর আপনার সার্টিফিকেট এখানে দেখতে পাবেন। শেখা চালিয়ে যান!</p>
        <a href="{{ route('student.courses.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
            আমার কোর্সসমূহ দেখুন
        </a>
    </div>
    @endif
</div>
@endsection