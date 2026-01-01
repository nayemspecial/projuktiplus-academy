@extends('frontend.layouts.master')

@section('title', 'প্রবেশাধিকার সংরক্ষিত - 403')

@section('content')
<section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-red-600/10 rounded-full blur-[120px]"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        
        <div class="mb-6 relative inline-block">
            <div class="absolute inset-0 bg-red-500 blur-2xl opacity-20 animate-pulse rounded-full"></div>
            <i class="fas fa-lock text-8xl text-red-500 relative z-10 drop-shadow-lg animate-bounce-slow"></i>
        </div>

        <h1 class="text-6xl md:text-8xl font-extrabold text-slate-900 dark:text-white mb-2 font-heading tracking-tight">
            403
        </h1>

        <h2 class="text-2xl md:text-3xl font-bold text-red-500 dark:text-red-400 mb-6 uppercase tracking-wider">
            প্রবেশাধিকার সংরক্ষিত
        </h2>

        <p class="text-slate-600 dark:text-slate-300 max-w-lg mx-auto mb-10 text-lg leading-relaxed">
            দুঃখিত, আপনার এই পেজে প্রবেশ করার অনুমতি নেই। আপনি যদি মনে করেন এটি ভুলবশত হচ্ছে, তবে অ্যাডমিনের সাথে যোগাযোগ করুন।
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('login') }}" class="px-8 py-3.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-600/30 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                <i class="fas fa-sign-in-alt"></i> অন্য একাউন্টে লগইন করুন
            </a>
            <a href="{{ url('/') }}" class="px-8 py-3.5 bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-white font-bold rounded-xl hover:bg-slate-300 dark:hover:bg-slate-700 transition flex items-center justify-center gap-2">
                হোম পেজে যান
            </a>
        </div>
    </div>
</section>
@endsection