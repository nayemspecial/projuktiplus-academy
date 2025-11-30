@extends('layouts.admin')

@section('title', 'পেমেন্ট বিবরণ - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="max-w-6xl mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
        <!-- Header Section -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
            <div class="flex flex-col md:flex-row justify-between items-center gap-3">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">পেমেন্ট বিবরণ</h3>
                <div class="flex gap-2">
                    <a href="{{ route('admin.payments.edit', $payment) }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 transition-colors">
                        <i class="fas fa-edit mr-2"></i> এডিট
                    </a>
                    <a href="{{ route('admin.payments.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> পেছনে
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Payment Details -->
        <div class="px-6 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Basic Info Card -->
                <div class="bg-gray-50 dark:bg-slate-700 rounded-lg p-4">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">মূল তথ্য</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">ট্রানজেকশন আইডি:</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $payment->transaction_id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">স্ট্যাটাস:</span>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                    'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                    'failed' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                    'refunded' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                    'disputed' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$payment->status] }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">গেটওয়ে:</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ ucfirst($payment->payment_gateway) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">তারিখ:</span>
                            <span class="text-gray-900 dark:text-white">{{ $payment->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                        @if($payment->completed_at)
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">সম্পন্ন তারিখ:</span>
                            <span class="text-gray-900 dark:text-white">{{ $payment->completed_at->format('M d, Y h:i A') }}</span>
                        </div>
                        @endif
                        @if($payment->refunded_at)
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">রিফান্ড তারিখ:</span>
                            <span class="text-gray-900 dark:text-white">{{ $payment->refunded_at->format('M d, Y h:i A') }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Financial Info Card -->
                <div class="bg-gray-50 dark:bg-slate-700 rounded-lg p-4">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">আর্থিক তথ্য</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">মোট পরিমাণ:</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">প্ল্যাটফর্ম ফি:</span>
                            <span class="text-gray-900 dark:text-white">{{ number_format($payment->platform_fee, 2) }} {{ $payment->currency }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">গেটওয়ে ফি:</span>
                            <span class="text-gray-900 dark:text-white">{{ number_format($payment->gateway_fee, 2) }} {{ $payment->currency }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-300">ইন্সট্রাক্টর আয়:</span>
                            <span class="text-gray-900 dark:text-white">{{ number_format($payment->instructor_earnings, 2) }} {{ $payment->currency }}</span>
                        </div>
                        <div class="flex justify-between border-t border-gray-200 dark:border-slate-600 pt-2 mt-2">
                            <span class="text-gray-800 dark:text-white font-medium">নিট আয়:</span>
                            <span class="text-gray-900 dark:text-white font-medium">
                                {{ number_format($payment->amount - $payment->platform_fee - $payment->gateway_fee - $payment->instructor_earnings, 2) }} {{ $payment->currency }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- User and Course Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- User Info Card -->
                <div class="bg-gray-50 dark:bg-slate-700 rounded-lg p-4">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">ব্যবহারকারী তথ্য</h4>
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 h-12 w-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->user->name }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $payment->user->email }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                User ID: {{ $payment->user_id }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Course Info Card -->
                <div class="bg-gray-50 dark:bg-slate-700 rounded-lg p-4">
                    <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4">কোর্স তথ্য</h4>
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 h-12 w-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                            <i class="fas fa-book text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->course->title }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Course ID: {{ $payment->course_id }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Payment Details JSON -->
            @if($payment->payment_details)
            <div class="mb-6">
                <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-3">পেমেন্ট বিবরণ (JSON)</h4>
                <div class="bg-gray-100 dark:bg-slate-700 rounded-lg p-4 overflow-x-auto">
                    <pre class="text-sm text-gray-800 dark:text-gray-200"><code>{{ json_encode($payment->payment_details, JSON_PRETTY_PRINT) }}</code></pre>
                </div>
            </div>
            @endif
            
            <!-- Refund Details JSON -->
            @if($payment->refund_details)
            <div>
                <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-3">রিফান্ড বিবরণ (JSON)</h4>
                <div class="bg-gray-100 dark:bg-slate-700 rounded-lg p-4 overflow-x-auto">
                    <pre class="text-sm text-gray-800 dark:text-gray-200"><code>{{ json_encode($payment->refund_details, JSON_PRETTY_PRINT) }}</code></pre>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection