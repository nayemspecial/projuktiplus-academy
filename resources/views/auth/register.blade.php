@extends('layouts.auth')

@section('title', 'ProjuktiPlus LMS - Register')

@section('auth-content')
<div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg overflow-hidden">
    <div class="px-8 py-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">নতুন একাউন্ট তৈরি করুন</h2>
        
        <!-- Social Registration Buttons -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <button onclick="socialLogin('google')" class="social-btn flex items-center justify-center py-2 px-4 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700">
                <i class="fab fa-google text-red-500 mr-2"></i> Google
            </button>
            <button onclick="socialLogin('facebook')" class="social-btn flex items-center justify-center py-2 px-4 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700">
                <i class="fab fa-facebook-f text-blue-600 mr-2"></i> Facebook
            </button>
        </div>
        
        <!-- Divider -->
        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300 dark:border-slate-700"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white dark:bg-slate-800 text-gray-500 dark:text-gray-400">অথবা</span>
            </div>
        </div>
        
        <!-- Registration Form -->
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="register-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পূর্ণ নাম</label>
                <input type="text" id="register-name" name="name" required class="form-input w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="register-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল</label>
                <input type="email" id="register-email" name="email" required class="form-input w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="register-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পাসওয়ার্ড</label>
                <div class="relative">
                    <input type="password" id="register-password" name="password" required class="form-input w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                    <button type="button" onclick="togglePasswordVisibility('register-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">পাসওয়ার্ড কমপক্ষে ৮ ক্যারেক্টার লম্বা হতে হবে</p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="register-confirm-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পাসওয়ার্ড নিশ্চিত করুন</label>
                <div class="relative">
                    <input type="password" id="register-confirm-password" name="password_confirmation" required class="form-input w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                    <button type="button" onclick="togglePasswordVisibility('register-confirm-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="flex items-center">
                <input id="terms" type="checkbox" name="agreeTerms" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-700 rounded dark:bg-slate-800">
                <label for="terms" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                    আমি <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">শর্তাবলী</a> এবং <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">গোপনীয়তা নীতি</a> মেনে নিচ্ছি
                </label>
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    রেজিস্ট্রেশন করুন
                </button>
            </div>
        </form>
        
        <div class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
            ইতিমধ্যে একাউন্ট আছে? 
            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 font-medium">
                লগইন করুন
            </a>
        </div>
    </div>
</div>
@endsection