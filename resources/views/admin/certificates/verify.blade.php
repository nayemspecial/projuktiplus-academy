@extends('layouts.admin')

@section('title', 'সার্টিফিকেট যাচাইকরণ')

@section('header', 'সার্টিফিকেট ভেরিফিকেশন')

@section('admin-content')
<div class="max-w-2xl mx-auto">
    <!-- Search Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-8 text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full mb-6">
            <i class="fas fa-shield-alt text-3xl text-blue-600 dark:text-blue-400"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">সার্টিফিকেট যাচাই করুন</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-8">সার্টিফিকেট আইডি অথবা ভেরিফিকেশন কোড দিয়ে সত্যতা যাচাই করুন।</p>
        
        <form action="{{ route('admin.certificates.verify') }}" method="GET" class="max-w-md mx-auto">
            <div class="relative">
                <input type="text" name="code" value="{{ request('code') }}" placeholder="সার্টিফিকেট আইডি / কোড..." required
                       class="w-full pl-4 pr-12 py-3 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white shadow-sm">
                <button type="submit" class="absolute right-2 top-2 bottom-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Result Section -->
    @if(request()->has('code'))
        @if(isset($certificate) && $certificate)
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border-l-4 border-green-500 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                            <h3 class="text-xl font-bold text-green-600 dark:text-green-400">ভ্যালিড সার্টিফিকেট</h3>
                        </div>
                        <a href="{{ route('admin.certificates.show', $certificate->id) }}" class="text-sm text-blue-600 hover:underline">বিস্তারিত দেখুন</a>
                    </div>
                    
                    <div class="space-y-4 border-t border-gray-100 dark:border-slate-700 pt-4">
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">শিক্ষার্থী:</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $certificate->user->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">কোর্স:</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $certificate->course->title }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">ইস্যু তারিখ:</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $certificate->issue_date->format('d M, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">আইডি:</span>
                            <span class="font-mono text-gray-900 dark:text-white bg-gray-100 dark:bg-slate-700 px-2 py-0.5 rounded">{{ $certificate->certificate_number }}</span>
                        </div>
                    </div>
                </div>
                @if($certificate->is_revoked)
                <div class="bg-red-50 dark:bg-red-900/20 p-4 border-t border-red-100 dark:border-red-800">
                    <p class="text-red-600 text-sm text-center font-medium"><i class="fas fa-exclamation-triangle mr-1"></i> সতর্কতা: এই সার্টিফিকেটটি বাতিল (Revoked) করা হয়েছে।</p>
                </div>
                @endif
            </div>
        @else
            <div class="bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-800 p-8 text-center">
                <i class="fas fa-times-circle text-red-500 text-4xl mb-3"></i>
                <h3 class="text-lg font-bold text-red-700 dark:text-red-400">সার্টিফিকেট পাওয়া যায়নি</h3>
                <p class="text-red-600 dark:text-red-300 mt-1">প্রদত্ত কোডটি সঠিক নয় অথবা আমাদের ডাটাবেসে নেই।</p>
            </div>
        @endif
    @endif
</div>
@endsection