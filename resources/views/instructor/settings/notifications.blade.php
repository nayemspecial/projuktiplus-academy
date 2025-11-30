@extends('layouts.instructor')

@section('title', 'সেটিংস - নোটিফিকেশন')

@section('instructor-content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">নোটিফিকেশন সেটিংস</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">আপনার ইমেইল নোটিফিকেশন পছন্দগুলো ঠিক করুন</p>
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
        <form action="{{ route('instructor.settings.notifications.update') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">ইমেইল নোটিফিকেশন</h3>

                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-slate-700 rounded-lg">
                    <div>
                        <label for="notify_on_enrollment" class="font-medium text-gray-900 dark:text-white cursor-pointer">নতুন এনরোলমেন্ট</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">যখন কোনো নতুন শিক্ষার্থী আপনার কোর্সে এনরোল করবে।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_on_enrollment" name="notify_on_enrollment" class="sr-only peer" {{ $settings['notify_on_enrollment'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 dark:bg-slate-700 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-slate-700 rounded-lg">
                    <div>
                        <label for="notify_on_review" class="font-medium text-gray-900 dark:text-white cursor-pointer">নতুন রিভিউ</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">যখন আপনার কোর্সে কেউ রেটিং বা রিভিউ দিবে।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_on_review" name="notify_on_review" class="sr-only peer" {{ $settings['notify_on_review'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 dark:bg-slate-700 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>
                
                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-slate-700 rounded-lg">
                    <div>
                        <label for="notify_on_comment" class="font-medium text-gray-900 dark:text-white cursor-pointer">ডিসকাশন / কমেন্ট</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">যখন কোনো ছাত্র লেসনে কমেন্ট করবে বা প্রশ্ন করবে।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_on_comment" name="notify_on_comment" class="sr-only peer" {{ $settings['notify_on_comment'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 dark:bg-slate-700 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-slate-700 rounded-lg">
                    <div>
                        <label for="weekly_report" class="font-medium text-gray-900 dark:text-white cursor-pointer">সাপ্তাহিক রিপোর্ট</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">সপ্তাহের এনরোলমেন্ট এবং আয়ের সারসংক্ষেপ ইমেইলে পাঠান।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="weekly_report" name="weekly_report" class="sr-only peer" {{ $settings['weekly_report'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 dark:bg-slate-700 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        সেটিংস সেভ করুন
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection