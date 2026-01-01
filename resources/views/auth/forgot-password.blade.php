@extends('layouts.auth')

@section('title', 'পাসওয়ার্ড রিসেট রিকোয়েস্ট')

@section('auth-content')
<div class="bg-white dark:bg-slate-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-slate-700">
    <div class="px-8 py-8">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-blue-50 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-key text-2xl text-blue-600 dark:text-blue-400"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">পাসওয়ার্ড ভুলে গেছেন?</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                চিন্তা নেই! আপনার ইমেইল এড্রেসটি নিচে দিন, আমরা আপনাকে পাসওয়ার্ড রিসেট করার একটি লিঙ্ক পাঠিয়ে দিব।
            </p>
        </div>
        
        @if (session('status'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800 flex items-start gap-3">
                <i class="fas fa-check-circle mt-1"></i>
                <span class="text-sm font-medium">{{ session('status') }}</span>
            </div>
        @endif
        
        <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="forgot-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">ইমেইল</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="forgot-email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                           placeholder="name@example.com">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                রিসেট লিঙ্ক পাঠান <i class="fas fa-paper-plane ml-2 mt-1"></i>
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> লগইন পেজে ফিরে যান
            </a>
        </div>
    </div>
</div>
@endsection