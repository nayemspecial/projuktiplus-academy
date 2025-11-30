@extends('layouts.admin') 

@section('title', 'লেসন এডিট করুন - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">লেসন এডিট করুন</h3>
        </div>
        
        <form action="{{ route('admin.lessons.update', $lesson) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="px-6 py-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Section Selection -->
                    <div class="md:col-span-2">
                        <label for="section_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">সেকশন নির্বাচন করুন *</label>
                        <select name="section_id" id="section_id" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">সেকশন নির্বাচন করুন</option>
                            @foreach($sections as $id => $title)
                                <option value="{{ $id }}" {{ old('section_id', $lesson->section_id) == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">লেসন টাইটেল *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $lesson->title) }}" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">অর্ডار</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $lesson->order) }}" min="1" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Video Type -->
                    <div>
                        <label for="video_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ভিডিও টাইপ</label>
                        <select name="video_type" id="video_type" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                            <option value="">টাইপ নির্বাচন করুন</option>
                            @foreach($videoTypes as $value => $label)
                                <option value="{{ $value }}" {{ old('video_type', $lesson->video_type) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('video_type')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Video URL -->
                    <div class="md:col-span-2">
                        <label for="video_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ভিডিও URL</label>
                        <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $lesson->video_url) }}" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               placeholder="https://">
                        @error('video_url')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Video Duration -->
                    <div>
                        <label for="video_duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ভিডিও সময়কাল (সেকেন্ড)</label>
                        <input type="number" name="video_duration" id="video_duration" value="{{ old('video_duration', $lesson->video_duration) }}" min="0" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('video_duration')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="is_published" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">স্ট্যাটাস</label>
                        <select name="is_published" id="is_published" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                            <option value="0" {{ old('is_published', $lesson->is_published) == 0 ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ old('is_published', $lesson->is_published) == 1 ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('is_published')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Free Lesson -->
                    <div>
                        <label class="flex items-center mt-6">
                            <input type="checkbox" name="is_free" value="1" {{ old('is_free', $lesson->is_free) ? 'checked' : '' }} 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 rounded dark:bg-slate-700">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">ফ্রি লেসন</span>
                        </label>
                        @error('is_free')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Preview Lesson -->
                    <div>
                        <label class="flex items-center mt-6">
                            <input type="checkbox" name="preview" value="1" {{ old('preview', $lesson->preview) ? 'checked' : '' }} 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 rounded dark:bg-slate-700">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">প্রিভিউ লেসন</span>
                        </label>
                        @error('preview')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কন্টেন্ট</label>
                    <textarea name="content" id="content" rows="6" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">{{ old('content', $lesson->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 flex justify-end space-x-3">
                <a href="{{ route('admin.lessons.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600">
                    বাতিল
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                    আপডেট করুন
                </button>
            </div>
        </form>
    </div>
</div>
@endsection