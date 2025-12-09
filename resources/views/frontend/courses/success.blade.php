@extends('frontend.layouts.master')

@section('title', 'এনরোলমেন্ট স্ট্যাটাস')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center bg-slate-50 dark:bg-slate-900 py-16 relative overflow-hidden">
    
    <!-- Background Effects -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-green-500/10 rounded-full blur-[80px]"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-blue-500/10 rounded-full blur-[80px]"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-xl mx-auto bg-white/80 dark:bg-slate-800/80 backdrop-blur-md rounded-3xl shadow-2xl p-8 md:p-12 text-center border border-slate-200 dark:border-slate-700">
            
            @if($status == 'active')
                <!-- Success State -->
                <div class="w-24 h-24 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-slow shadow-lg shadow-green-500/20">
                    <i class="fas fa-check-circle text-5xl text-green-600 dark:text-green-500"></i>
                </div>
                
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-3 font-heading">অভিনন্দন! 🎉</h2>
                <p class="text-lg text-slate-600 dark:text-slate-300 mb-8">
                    আপনি সফলভাবে <strong>"{{ $course->title }}"</strong> কোর্সে এনরোল করেছেন।
                </p>

                <a href="{{ route('student.courses.show', $course->id) }}" class="inline-flex items-center justify-center w-full px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold text-lg rounded-xl transition shadow-lg shadow-green-600/30 transform hover:-translate-y-1">
                    <i class="fas fa-play-circle mr-2"></i> ক্লাস শুরু করুন
                </a>

            @else
                <!-- Pending State -->
                <div class="w-24 h-24 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-yellow-500/20">
                    <i class="fas fa-clock text-5xl text-yellow-600 dark:text-yellow-500 animate-pulse"></i>
                </div>
                
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-3 font-heading">রিকোয়েস্ট জমা হয়েছে</h2>
                
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 rounded-xl p-5 mb-8 text-left">
                    <h4 class="font-bold text-blue-800 dark:text-blue-300 mb-2 flex items-center gap-2">
                        <i class="fas fa-info-circle"></i> পরবর্তী ধাপ:
                    </h4>
                    <ul class="text-sm text-blue-700 dark:text-blue-200 space-y-2 list-disc list-inside">
                        <li>আপনার পেমেন্ট তথ্য আমাদের কাছে পৌঁছেছে।</li>
                        <li>অ্যাডমিন আপনার পেমেন্ট ভেরিফাই করবেন (৩০-৬০ মিনিট)।</li>
                        <li>ভেরিফিকেশন হলে আপনি ড্যাশবোর্ডে কোর্সটি দেখতে পাবেন।</li>
                    </ul>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('student.dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 bg-slate-800 dark:bg-white dark:text-slate-900 text-white font-bold rounded-xl transition hover:opacity-90 shadow-md">
                        ড্যাশবোর্ডে যান
                    </a>
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-bold rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                        হোম পেজ
                    </a>
                </div>
            @endif

        </div>
    </div>
</section>
@endsection