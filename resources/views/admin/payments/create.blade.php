@extends('layouts.admin') 

@section('title', 'নতুন পেমেন্ট তৈরি করুন - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">নতুন পেমেন্ট তৈরি করুন</h3>
        </div>
        
        <form action="{{ route('admin.payments.store') }}" method="POST">
            @csrf
            
            <div class="px-6 py-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- User Selection -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ব্যবহারকারী *</label>
                        <select name="user_id" id="user_id" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">ব্যবহারকারী নির্বাচন করুন</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Course Selection -->
                    <div>
                        <label for="course_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কোর্স *</label>
                        <select name="course_id" id="course_id" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">কোর্স নির্বাচন করুন</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Transaction ID -->
                    <div>
                        <label for="transaction_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ট্রানজেকশন আইডি *</label>
                        <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id') }}" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               required>
                        @error('transaction_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Payment Gateway -->
                    <div>
                        <label for="payment_gateway" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">পেমেন্ট গেটওয়ে *</label>
                        <select name="payment_gateway" id="payment_gateway" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="stripe" {{ old('payment_gateway', 'stripe') == 'stripe' ? 'selected' : '' }}>Stripe</option>
                            <option value="paypal" {{ old('payment_gateway') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                            <option value="bank" {{ old('payment_gateway') == 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="manual" {{ old('payment_gateway') == 'manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                        @error('payment_gateway')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">পরিমাণ *</label>
                        <input type="number" name="amount" id="amount" value="{{ old('amount') }}" step="0.01" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               required>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Currency -->
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কারেন্সি *</label>
                        <select name="currency" id="currency" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="USD" {{ old('currency', 'USD') == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="BDT" {{ old('currency') == 'BDT' ? 'selected' : '' }}>BDT</option>
                            <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                            <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
                        </select>
                        @error('currency')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Gateway Fee -->
                    <div>
                        <label for="gateway_fee" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">গেটওয়ে ফি</label>
                        <input type="number" name="gateway_fee" id="gateway_fee" value="{{ old('gateway_fee', 0) }}" step="0.01" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('gateway_fee')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Platform Fee -->
                    <div>
                        <label for="platform_fee" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">প্ল্যাটফর্ম ফি</label>
                        <input type="number" name="platform_fee" id="platform_fee" value="{{ old('platform_fee', 0) }}" step="0.01" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('platform_fee')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Instructor Earnings -->
                    <div>
                        <label for="instructor_earnings" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ইন্সট্রাক্টর আয়</label>
                        <input type="number" name="instructor_earnings" id="instructor_earnings" value="{{ old('instructor_earnings', 0) }}" step="0.01" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('instructor_earnings')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">স্ট্যাটাস *</label>
                        <select name="status" id="status" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ old('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            <option value="disputed" {{ old('status') == 'disputed' ? 'selected' : '' }}>Disputed</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Completed At -->
                    <div>
                        <label for="completed_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">সম্পন্ন হওয়ার তারিখ</label>
                        <input type="datetime-local" name="completed_at" id="completed_at" value="{{ old('completed_at') }}" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('completed_at')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Refunded At -->
                    <div>
                        <label for="refunded_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">রিফান্ড তারিখ</label>
                        <input type="datetime-local" name="refunded_at" id="refunded_at" value="{{ old('refunded_at') }}" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('refunded_at')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Payment Details -->
                <div>
                    <label for="payment_details" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">পেমেন্ট বিবরণ (JSON)</label>
                    <textarea name="payment_details" id="payment_details" rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white font-mono text-sm">{{ old('payment_details') }}</textarea>
                    @error('payment_details')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Refund Details -->
                <div>
                    <label for="refund_details" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">রিফান্ড বিবরণ (JSON)</label>
                    <textarea name="refund_details" id="refund_details" rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white font-mono text-sm">{{ old('refund_details') }}</textarea>
                    @error('refund_details')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 flex justify-end space-x-3">
                <a href="{{ route('admin.payments.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                    বাতিল
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    তৈরি করুন
                </button>
            </div>
        </form>
    </div>
</div>
@endsection