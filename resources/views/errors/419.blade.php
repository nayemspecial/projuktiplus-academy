@extends('frontend.layouts.master')

@section('title', 'সেশনের মেয়াদ শেষ - 419')

@section('content')
<section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-yellow-500/10 rounded-full blur-[80px]"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        
        <div class="w-24 h-24 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
            <i class="fas fa-hourglass-half text-4xl text-yellow-600 dark:text-yellow-500"></i>
        </div>

        <h1 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4 font-heading">
            সেশনের মেয়াদ শেষ
        </h1>
        
        <p class="text-slate-600 dark:text-slate-300 max-w-md mx-auto mb-8 text-lg">
            নিরাপত্তার স্বার্থে দীর্ঘক্ষণ নিষ্ক্রিয় থাকার কারণে আপনার সেশনটি এক্সপায়ার হয়েছে। অনুগ্রহ করে পেজটি রিফ্রেশ করুন।
        </p>

        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 max-w-md mx-auto mb-8 flex items-start gap-3 text-left">
            <i class="fas fa-info-circle text-yellow-600 mt-1"></i>
            <p class="text-sm text-yellow-800 dark:text-yellow-200">
                আপনি যদি কোনো ফর্ম ফিলাপ করে থাকেন, তবে রিফ্রেশ করার আগে ডাটাগুলো কপি করে রাখতে পারেন।
            </p>
        </div>

        <a href="{{ url()->current() }}" class="px-8 py-3.5 bg-yellow-500 hover:bg-yellow-600 text-slate-900 font-bold rounded-xl shadow-lg shadow-yellow-500/30 transition transform hover:-translate-y-1 inline-flex items-center gap-2">
            <i class="fas fa-sync-alt"></i> পেজ রিলোড করুন
        </a>
    </div>
</section>
@endsection