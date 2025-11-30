@extends('layouts.instructor')

@section('title', 'সেটিংস - সিকিউরিটি')

@section('instructor-content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">সিকিউরিটি সেটিংস</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">আপনার পাসওয়ার্ড পরিবর্তন করুন</p>
    </div>

    <div class="flex border-b border-gray-200 dark:border-slate-700 mb-6 overflow-x-auto">
        <a href="{{ route('instructor.settings.index') }}" 
           class="px-4 py-2 border-b-2 font-medium transition-colors whitespace-nowrap {{ request()->routeIs('instructor.settings.index') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
            সাধারণ তথ্য
        </a>
        <a href="{{ route('instructor.settings.security') }}" 
           class="px-4 py-2 border-b-2 font-medium transition-colors whitespace-nowrap {{ request()->routeIs('instructor.settings.security') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
            সিকিউরিটি
        </a>
        <a href="{{ route('instructor.settings.notifications') }}" 
           class="px-4 py-2 border-b-2 font-medium transition-colors whitespace-nowrap {{ request()->routeIs('instructor.settings.notifications') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
            নোটিফিকেশন
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">পাসওয়ার্ড পরিবর্তন</h3>
            
            <form action="{{ route('instructor.settings.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6 max-w-xl">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">বর্তমান পাসওয়ার্ড</label>
                        <input type="password" name="current_password" id="current_password" required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @error('current_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">নতুন পাসওয়ার্ড</label>
                        <input type="password" name="password" id="password" required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">নতুন পাসওয়ার্ড নিশ্চিত করুন</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="px-6 py-2 bg-gray-800 dark:bg-slate-700 text-white text-sm font-medium rounded-md hover:bg-gray-900 dark:hover:bg-slate-600 transition">
                            পাসওয়ার্ড আপডেট করুন
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection