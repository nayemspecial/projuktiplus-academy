@extends('layouts.admin') 

@section('title', 'উত্তর এডিট করুন - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">উত্তর এডিট করুন</h3>
        </div>
        
        <form action="{{ route('admin.answers.update', $answer) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="px-6 py-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Question Selection -->
                    <div class="md:col-span-2">
                        <label for="question_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">প্রশ্ন নির্বাচন করুন *</label>
                        <select name="question_id" id="question_id" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">প্রশ্ন নির্বাচন করুন</option>
                            @foreach($questions as $id => $title)
                                <option value="{{ $id }}" {{ old('question_id', $answer->question_id) == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('question_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">অর্ডার</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $answer->order) }}" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Is Correct -->
                    <div>
                        <label for="is_correct" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">সঠিক উত্তর</label>
                        <select name="is_correct" id="is_correct" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                            <option value="0" {{ old('is_correct', $answer->is_correct) == 0 ? 'selected' : '' }}>ভুল</option>
                            <option value="1" {{ old('is_correct', $answer->is_correct) == 1 ? 'selected' : '' }}>সঠিক</option>
                        </select>
                        @error('is_correct')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Answer Text -->
                <div>
                    <label for="answer" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">উত্তর *</label>
                    <textarea name="answer" id="answer" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                              required>{{ old('answer', $answer->answer) }}</textarea>
                    @error('answer')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 flex justify-end space-x-3">
                <a href="{{ route('admin.answers.index') }}" 
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