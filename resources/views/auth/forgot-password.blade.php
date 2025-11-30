@extends('layouts.auth')

@section('title', 'ProjuktiPlus LMS - Forgot Password')

@section('auth-content')
<div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg overflow-hidden">
    <div class="px-8 py-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">পাসওয়ার্ড রিসেট করুন</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-6">আপনার ইমেইল এড্রেস লিখুন। আমরা আপনাকে পাসওয়ার্ড রিসেট করার জন্য একটি লিঙ্ক পাঠাবো।</p>
        
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
        
        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="forgot-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল</label>
                <input type="email" id="forgot-email" name="email" value="{{ old('email') }}" required class="form-input w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    রিসেট লিঙ্ক পাঠান
                </button>
            </div>
        </form>
        
        <div class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 font-medium">
                লগইন পেজে ফিরে যান
            </a>
        </div>
    </div>
</div>
@endsection