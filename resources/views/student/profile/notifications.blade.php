@extends('layouts.student')

@section('title', 'নোটিফিকেশন সেটিংস - ProjuktiPlus LMS')

@section('student-content')
<div class="mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">নোটিফিকেশন সেটিংস</h1>
        <p class="text-gray-600 dark:text-gray-400">কখন এবং কিসের নোটিফিকেশন পাবেন তা ঠিক করুন</p>
    </div>

    <!-- Tabs Navigation -->
    <div class="flex border-b border-gray-200 dark:border-slate-700 mb-6 overflow-x-auto">
        <a href="{{ route('student.profile.index') }}" 
           class="px-6 py-3 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors whitespace-nowrap">
           <i class="fas fa-user-circle mr-2"></i> সাধারণ তথ্য
        </a>
        <a href="{{ route('student.profile.security') }}" 
           class="px-6 py-3 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors whitespace-nowrap">
           <i class="fas fa-lock mr-2"></i> সিকিউরিটি
        </a>
        <!-- Active Tab -->
        <a href="{{ route('student.profile.notifications') }}" 
           class="px-6 py-3 border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-medium text-sm transition-colors whitespace-nowrap">
           <i class="fas fa-bell mr-2"></i> নোটিফিকেশন
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">ইমেইল ও সিস্টেম নোটিফিকেশন</h3>
        </div>
        
        <form action="{{ route('student.profile.notifications.update') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <!-- Option 1: Course Enrollment -->
                <div class="flex items-center justify-between p-4 border border-gray-100 dark:border-slate-700 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                    <div>
                        <label for="notify_on_enrollment" class="font-medium text-gray-900 dark:text-white cursor-pointer select-none">কোর্সে এনরোলমেন্ট</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">নতুন কোর্সে এনরোল করলে কনফার্মেশন ইমেইল পান।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_on_enrollment" name="notify_on_enrollment" class="sr-only peer" 
                               {{ ($settings['notify_on_enrollment'] ?? false) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <!-- Option 2: Quiz Result -->
                <div class="flex items-center justify-between p-4 border border-gray-100 dark:border-slate-700 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                    <div>
                        <label for="notify_on_quiz_result" class="font-medium text-gray-900 dark:text-white cursor-pointer select-none">কুইজের ফলাফল</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">কুইজ সাবমিট করার পর ফলাফলের নোটিফিকেশন পান।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_on_quiz_result" name="notify_on_quiz_result" class="sr-only peer" 
                               {{ ($settings['notify_on_quiz_result'] ?? false) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <!-- Option 3: Announcements -->
                <div class="flex items-center justify-between p-4 border border-gray-100 dark:border-slate-700 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                    <div>
                        <label for="notify_on_announcement" class="font-medium text-gray-900 dark:text-white cursor-pointer select-none">কোর্সের ঘোষণা</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">ইন্সট্রাক্টরের গুরুত্বপূর্ণ ঘোষণা মিস করবেন না।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_on_announcement" name="notify_on_announcement" class="sr-only peer" 
                               {{ ($settings['notify_on_announcement'] ?? false) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <!-- Option 4: Promotional Offers -->
                <div class="flex items-center justify-between p-4 border border-gray-100 dark:border-slate-700 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                    <div>
                        <label for="notify_promotions" class="font-medium text-gray-900 dark:text-white cursor-pointer select-none">প্রমোশনাল অফার</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">ProjuktiPlus থেকে নতুন কোর্স এবং ডিসকাউন্ট অফার।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_promotions" name="notify_promotions" class="sr-only peer" 
                               {{ ($settings['notify_promotions'] ?? false) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 dark:border-slate-700 flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-sm">
                    সেটিংস সেভ করুন
                </button>
            </div>
        </form>
    </div>
</div>
@endsection