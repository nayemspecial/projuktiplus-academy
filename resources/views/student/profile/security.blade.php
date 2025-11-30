@extends('layouts.student')

@section('title', 'সিকিউরিটি সেটিংস - ProjuktiPlus LMS')

@section('student-content')
<div class="mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">সিকিউরিটি সেটিংস</h1>
        <p class="text-gray-600 dark:text-gray-400">আপনার পাসওয়ার্ড এবং নিরাপত্তা নিশ্চিত করুন</p>
    </div>

    <div class="flex border-b border-gray-200 dark:border-slate-700 mb-6">
        <a href="{{ route('student.profile.index') }}" class="px-4 py-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 font-medium">
            সাধারণ তথ্য
        </a>
        <a href="{{ route('student.profile.security') }}" class="px-4 py-2 border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-medium">
            সিকিউরিটি
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">পাসওয়ার্ড পরিবর্তন</h3>
            
            <form action="{{ route('student.profile.security.update') }}" method="POST">
                @csrf
                @method('PUT')

                @if(session('success'))
                    <div class="mb-6 bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-400 p-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

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

                    <div class="pt-4">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            পাসওয়ার্ড পরিবর্তন করুন
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection