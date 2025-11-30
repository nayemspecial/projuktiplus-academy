@extends('layouts.admin') 

@section('title', 'এনরোলমেন্ট এডিট করুন - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">এনরোলমেন্ট এডিট করুন</h3>
        </div>
        
        <form action="{{ route('admin.enrollments.update', $enrollment) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="px-6 py-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- User Selection -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ছাত্র নির্বাচন করুন *</label>
                        <select name="user_id" id="user_id" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">ছাত্র নির্বাচন করুন</option>
                            @foreach($users as $id => $name)
                                <option value="{{ $id }}" {{ old('user_id', $enrollment->user_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Course Selection -->
                    <div>
                        <label for="course_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কোর্স নির্বাচন করুন *</label>
                        <select name="course_id" id="course_id" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">কোর্স নির্বাচন করুন</option>
                            @foreach($courses as $id => $title)
                                <option value="{{ $id }}" {{ old('course_id', $enrollment->course_id) == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Price Paid -->
                    <div>
                        <label for="price_paid" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">প্রদত্ত মূল্য *</label>
                        <input type="number" name="price_paid" id="price_paid" value="{{ old('price_paid', $enrollment->price_paid) }}" min="0" step="0.01" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               required>
                        @error('price_paid')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">স্ট্যাটাস *</label>
                        <select name="status" id="status" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">স্ট্যাটাস নির্বাচন করুন</option>
                            @foreach($statuses as $value => $label)
                                <option value="{{ $value }}" {{ old('status', $enrollment->status) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Progress -->
                    <div>
                        <label for="progress" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">প্রোগ্রেস (%)</label>
                        <input type="number" name="progress" id="progress" value="{{ old('progress', $enrollment->progress) }}" min="0" max="100" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('progress')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Completed Lessons -->
                    <div>
                        <label for="completed_lessons" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">সম্পূর্ণ লেসন</label>
                        <input type="number" name="completed_lessons" id="completed_lessons" value="{{ old('completed_lessons', $enrollment->completed_lessons) }}" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('completed_lessons')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Total Lessons -->
                    <div>
                        <label for="total_lessons" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">মোট লেসন</label>
                        <input type="number" name="total_lessons" id="total_lessons" value="{{ old('total_lessons', $enrollment->total_lessons) }}" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('total_lessons')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Cancellation Reason -->
                <div>
                    <label for="cancellation_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">বাতিলের কারণ</label>
                    <textarea name="cancellation_reason" id="cancellation_reason" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">{{ old('cancellation_reason', $enrollment->cancellation_reason) }}</textarea>
                    @error('cancellation_reason')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 flex justify-end space-x-3">
                <a href="{{ route('admin.enrollments.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                    বাতিল
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    আপডেট করুন
                </button>
            </div>
        </form>
    </div>
</div>
@endsection