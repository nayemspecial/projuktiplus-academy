@extends('layouts.student')

@section('title', 'সিকিউরিটি সেটিংস')

@section('student-content')
<div class="mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">সিকিউরিটি সেটিংস</h1>
        <p class="text-gray-600 dark:text-gray-400">পাসওয়ার্ড পরিবর্তন ও নিরাপত্তা</p>
    </div>

    <!-- Tabs -->
    <div class="flex border-b border-gray-200 dark:border-slate-700 mb-6 overflow-x-auto">
        <a href="{{ route('student.profile.index') }}" class="px-6 py-3 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors whitespace-nowrap">
           <i class="fas fa-user-circle mr-2"></i> সাধারণ তথ্য
        </a>
        <a href="{{ route('student.profile.security') }}" class="px-6 py-3 border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-medium text-sm transition-colors whitespace-nowrap">
           <i class="fas fa-lock mr-2"></i> সিকিউরিটি
        </a>
        <a href="{{ route('student.profile.notifications') }}" class="px-6 py-3 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors whitespace-nowrap">
           <i class="fas fa-bell mr-2"></i> নোটিফিকেশন
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">পাসওয়ার্ড পরিবর্তন</h3>
        </div>
        
        <form action="{{ route('student.profile.security.update') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="max-w-xl">
                <!-- Current Password -->
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">বর্তমান পাসওয়ার্ড</label>
                    <input type="password" name="current_password" required 
                           class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- New Password -->
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">নতুন পাসওয়ার্ড</label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">পাসওয়ার্ড নিশ্চিত করুন</label>
                    <input type="password" name="password_confirmation" required 
                           class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-sm">
                        পাসওয়ার্ড আপডেট করুন
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection