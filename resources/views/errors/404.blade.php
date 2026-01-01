@extends('frontend.layouts.master')

@section('title', 'পেজ পাওয়া যায়নি - 404')

@section('content')
<section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-600/20 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-[100px] animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        
        <h1 class="text-9xl md:text-[12rem] font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 drop-shadow-2xl font-heading tracking-tighter animate-float">
            404
        </h1>

        <div class="bg-white/10 dark:bg-slate-800/50 backdrop-blur-md border border-slate-200 dark:border-slate-700 p-8 rounded-3xl max-w-2xl mx-auto shadow-2xl -mt-10 relative">
            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto -mt-16 mb-6 border-4 border-white dark:border-slate-800 shadow-lg">
                <i class="fas fa-search text-3xl text-slate-400 dark:text-slate-300"></i>
            </div>

            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">
                সরি, পেজটি খুঁজে পাওয়া যাচ্ছে না।
            </h2>
            
            <p class="text-slate-600 dark:text-slate-300 mb-8 text-lg">
                আপনি যে লিংকটি খুঁজছেন তা হয়তো সঠিক নয়, অথবা পেজটি রিমুভ করা হয়েছে। আপনি হোম পেজে ফিরে যেতে পারেন।
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/') }}" class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    <i class="fas fa-home"></i> হোম পেজ
                </a>
                <button onclick="history.back()" class="px-8 py-3.5 bg-transparent border-2 border-slate-300 dark:border-slate-600 text-slate-700 dark:text-white font-bold rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition flex items-center justify-center gap-2">
                    <i class="fas fa-arrow-left"></i> ফিরে যান
                </button>
            </div>
        </div>
    </div>
</section>
@endsection