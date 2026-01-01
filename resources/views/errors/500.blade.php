@extends('frontend.layouts.master')

@section('title', 'সার্ভার এরর - 500')

@section('content')
<section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-pink-600/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-rose-600/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        
        <div class="relative h-32 w-32 mx-auto mb-8">
            <i class="fas fa-cog text-7xl text-slate-300 dark:text-slate-600 absolute top-0 left-0 animate-spin-slow"></i>
            <i class="fas fa-cog text-5xl text-pink-500 absolute bottom-0 right-0 animate-spin-reverse"></i>
        </div>

        <h1 class="text-5xl md:text-7xl font-bold text-slate-900 dark:text-white mb-4 font-heading">
            সাময়িক সমস্যা হচ্ছে
        </h1>

        <p class="text-xl text-pink-600 dark:text-pink-400 font-semibold mb-6">Error 500: Internal Server Error</p>

        <p class="text-slate-600 dark:text-slate-300 max-w-lg mx-auto mb-10">
            আমাদের সার্ভারে ছোট একটি সমস্যা হয়েছে। আমরা এটি ঠিক করার জন্য কাজ করছি। অনুগ্রহ করে কিছুক্ষণ পর আবার চেষ্টা করুন।
        </p>

        <button onclick="location.reload()" class="px-10 py-4 bg-gradient-to-r from-pink-600 to-rose-600 hover:from-pink-700 hover:to-rose-700 text-white font-bold rounded-xl shadow-xl shadow-pink-600/30 transition transform hover:scale-105 flex items-center justify-center gap-2 mx-auto">
            <i class="fas fa-redo-alt animate-spin-once"></i> রিফ্রেশ করুন
        </button>
    </div>
</section>

<style>
    .animate-spin-slow { animation: spin 8s linear infinite; }
    .animate-spin-reverse { animation: spin 6s linear infinite reverse; }
    @keyframes spin { 100% { transform: rotate(360deg); } }
</style>
@endsection