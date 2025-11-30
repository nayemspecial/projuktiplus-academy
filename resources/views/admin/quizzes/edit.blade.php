@extends('layouts.admin') 

@section('title', 'কুইজ এডিট করুন - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">কুইজ এডিট করুন</h3>
        </div>
        
        <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="px-6 py-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Lesson Selection -->
                    <div class="md:col-span-2">
                        <label for="lesson_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">লেসন নির্বাচন করুন *</label>
                        <select name="lesson_id" id="lesson_id" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">লেসন নির্বাচন করুন</option>
                            @foreach($lessons as $id => $title)
                                <option value="{{ $id }}" {{ old('lesson_id', $quiz->lesson_id) == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('lesson_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কুইজ টাইটেল *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Time Limit -->
                    <div>
                        <label for="time_limit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">সময় সীমা (মিনিট)</label>
                        <input type="number" name="time_limit" id="time_limit" value="{{ old('time_limit', $quiz->time_limit) }}" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               placeholder="0 = সময় সীমা নেই">
                        @error('time_limit')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Passing Score -->
                    <div>
                        <label for="passing_score" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">পাসিং স্কোর (%) *</label>
                        <input type="number" name="passing_score" id="passing_score" value="{{ old('passing_score', $quiz->passing_score) }}" min="0" max="100" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               required>
                        @error('passing_score')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Max Attempts -->
                    <div>
                        <label for="max_attempts" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">সর্বোচ্চ প্রচেষ্টা *</label>
                        <input type="number" name="max_attempts" id="max_attempts" value="{{ old('max_attempts', $quiz->max_attempts) }}" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               required>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">0 = অসীম প্রচেষ্টা</p>
                        @error('max_attempts')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="is_published" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">স্ট্যাটাস</label>
                        <select name="is_published" id="is_published" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                            <option value="0" {{ old('is_published', $quiz->is_published) == 0 ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ old('is_published', $quiz->is_published) == 1 ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('is_published')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Checkboxes -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="shuffle_questions" id="shuffle_questions" value="1" {{ old('shuffle_questions', $quiz->shuffle_questions) ? 'checked' : '' }} 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 rounded dark:bg-slate-700">
                        <label for="shuffle_questions" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">প্রশ্ন শাফল করুন</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="shuffle_answers" id="shuffle_answers" value="1" {{ old('shuffle_answers', $quiz->shuffle_answers) ? 'checked' : '' }} 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 rounded dark:bg-slate-700">
                        <label for="shuffle_answers" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">উত্তর শাফল করুন</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="show_correct_answers" id="show_correct_answers" value="1" {{ old('show_correct_answers', $quiz->show_correct_answers) ? 'checked' : '' }} 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 rounded dark:bg-slate-700">
                        <label for="show_correct_answers" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">সঠিক উত্তর দেখান</label>
                    </div>
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">বিবরণ</label>
                    <textarea name="description" id="description" rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">{{ old('description', $quiz->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 flex justify-end space-x-3">
                <a href="{{ route('admin.quizzes.index') }}" 
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