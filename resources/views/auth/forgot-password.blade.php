@extends('layouts.auth')

@section('title', 'পাসওয়ার্ড রিসেট রিকোয়েস্ট')

@section('auth-content')
<div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl shadow-2xl rounded-2xl overflow-hidden border border-white/50 dark:border-slate-700/50">
    <div class="px-8 py-8">
        
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-blue-50/80 dark:bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-100 dark:border-slate-600 shadow-inner">
                <i class="fas fa-key text-2xl text-blue-600 dark:text-blue-400"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white mb-2 font-heading">পাসওয়ার্ড ভুলে গেছেন?</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                চিন্তা নেই! আপনার ইমেইল এড্রেসটি নিচে দিন, আমরা আপনাকে পাসওয়ার্ড রিসেট করার একটি লিঙ্ক পাঠিয়ে দিব।
            </p>
        </div>
        
        @if (session('status'))
            <div class="mb-6 p-4 rounded-lg bg-green-50/50 dark:bg-green-900/20 text-green-700 dark:text-green-400 border border-green-200/50 dark:border-green-800/50 flex items-start gap-3 backdrop-blur-sm">
                <i class="fas fa-check-circle mt-1"></i>
                <span class="text-sm font-medium">{{ session('status') }}</span>
            </div>
        @endif
        
        <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="forgot-email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">ইমেইল</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="forgot-email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('email') border-red-500 @enderror"
                           placeholder="name@example.com">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-triangle"></i> {{ $message }}
                    </p>
                @enderror
            </div>
            
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                রিসেট লিঙ্ক পাঠান <i class="fas fa-paper-plane ml-2 mt-1"></i>
            </button>
        </form>
        
        <div class="mt-8 text-center border-t border-slate-100 dark:border-slate-700 pt-6">
            <a href="{{ route('login') }}" class="inline-flex items-center text-sm font-bold text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> লগইন পেজে ফিরে যান
            </a>
        </div>
    </div>
</div>
@endsection