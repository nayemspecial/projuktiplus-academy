@extends('layouts.admin') 

@section('title', 'প্রশ্ন এডিট করুন - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">প্রশ্ন এডিট করুন</h3>
        </div>
        
        <form action="{{ route('admin.questions.update', $question) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="px-6 py-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Quiz Selection -->
                    <div class="md:col-span-2">
                        <label for="quiz_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কুইজ নির্বাচন করুন *</label>
                        <select name="quiz_id" id="quiz_id" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">কুইজ নির্বাচন করুন</option>
                            @foreach($quizzes as $id => $title)
                                <option value="{{ $id }}" {{ old('quiz_id', $question->quiz_id) == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('quiz_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Question Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">প্রশ্নের ধরন *</label>
                        <select name="type" id="type" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">ধরন নির্বাচন করুন</option>
                            @foreach($questionTypes as $value => $label)
                                <option value="{{ $value }}" {{ old('type', $question->type) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Points -->
                    <div>
                        <label for="points" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">পয়েন্ট *</label>
                        <input type="number" name="points" id="points" value="{{ old('points', $question->points) }}" min="1" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               required>
                        @error('points')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">অর্ডার</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $question->order) }}" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Question Text -->
                <div>
                    <label for="question" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">প্রশ্ন *</label>
                    <textarea name="question" id="question" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                              required>{{ old('question', $question->question) }}</textarea>
                    @error('question')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Explanation -->
                <div>
                    <label for="explanation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ব্যাখ্যা</label>
                    <textarea name="explanation" id="explanation" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">{{ old('explanation', $question->explanation) }}</textarea>
                    @error('explanation')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 flex justify-end space-x-3">
                <a href="{{ route('admin.questions.index') }}" 
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