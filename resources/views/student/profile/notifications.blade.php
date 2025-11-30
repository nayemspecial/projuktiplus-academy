@extends('layouts.student')

@section('title', 'নোটিফিকেশন সেটিংস - ProjuktiPlus LMS')

@push('styles')
<style>
    /* কাস্টম টগল বাটন স্টাইল */
    .toggle-checkbox:checked {
        @apply: bg-blue-600 border-blue-600;
        right: 0;
    }
    .toggle-checkbox:checked + .toggle-label {
        @apply: bg-blue-600;
    }
    .toggle-checkbox:checked + .toggle-label::after {
        transform: translateX(1.25rem);
    }
</style>
@endpush

@section('student-content')
<div class="mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">প্রোফাইল সেটিংস</h1>
        <p class="text-gray-600 dark:text-gray-400">আপনি কিভাবে নোটিফিকেশন পেতে চান তা ঠিক করুন</p>
    </div>

    <div class="flex border-b border-gray-200 dark:border-slate-700 mb-6">
        <a href="{{ route('student.profile.index') }}" class="px-4 py-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 font-medium">
            সাধারণ তথ্য
        </a>
        <a href="{{ route('student.profile.security') }}" class="px-4 py-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 font-medium">
            সিকিউরিটি
        </a>
        <a href="{{ route('student.profile.notifications') }}" class="px-4 py-2 border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-medium">
            নোটিফিকেশন
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <form action="{{ route('student.profile.notifications.update') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            @if(session('success'))
                <div class="mb-6 bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-400 p-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="space-y-6">
                
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">ইমেইল নোটিফিকেশন</h3>

                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-slate-700 rounded-lg">
                    <div>
                        <label for="notify_on_enrollment" class="font-medium text-gray-900 dark:text-white">কোর্সে এনরোলমেন্ট</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">যখন আপনি নতুন কোর্সে সফলভাবে এনরোল করবেন।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_on_enrollment" name="notify_on_enrollment" class="sr-only peer" 
                               {{ $settings['notify_on_enrollment'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 dark:bg-slate-700 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-slate-700 rounded-lg">
                    <div>
                        <label for="notify_on_quiz_result" class="font-medium text-gray-900 dark:text-white">কুইজের ফলাফল</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">যখন আপনার কুইজের ফলাফল প্রকাশ হবে।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_on_quiz_result" name="notify_on_quiz_result" class="sr-only peer" 
                               {{ $settings['notify_on_quiz_result'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 dark:bg-slate-700 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-slate-700 rounded-lg">
                    <div>
                        <label for="notify_on_announcement" class="font-medium text-gray-900 dark:text-white">কোর্সের ঘোষণা</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">যখন আপনার ইন্সট্রাক্টর কোনো নতুন ঘোষণা দেবেন।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_on_announcement" name="notify_on_announcement" class="sr-only peer" 
                               {{ $settings['notify_on_announcement'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 dark:bg-slate-700 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-slate-700 rounded-lg">
                    <div>
                        <label for="notify_promotions" class="font-medium text-gray-900 dark:text-white">প্রমোশনাল অফার</label>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Projukti Plus থেকে নতুন কোর্স এবং ডিসকাউন্ট অফার।</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="notify_promotions" name="notify_promotions" class="sr-only peer" 
                               {{ $settings['notify_promotions'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 dark:bg-slate-700 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        সেটিংস সেভ করুন
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection