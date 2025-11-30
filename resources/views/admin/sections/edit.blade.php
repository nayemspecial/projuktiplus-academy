@extends('layouts.admin') 

@section('title', 'সেকশন এডিট করুন - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">সেকশন এডিট করুন</h3>
        </div>
        
        <form action="{{ route('admin.sections.update', $section) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="px-6 py-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Course Selection -->
                    <div class="md:col-span-2">
                        <label for="course_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কোর্স নির্বাচন করুন *</label>
                        <select name="course_id" id="course_id" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                                required>
                            <option value="">কোর্স নির্বাচন করুন</option>
                            @foreach($courses as $id => $title)
                                <option value="{{ $id }}" {{ old('course_id', $section->course_id) == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">সেকশন টাইটেল *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $section->title) }}" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">অর্ডার</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $section->order) }}" min="1" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="is_published" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">স্ট্যাটাস</label>
                        <select name="is_published" id="is_published" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                            <option value="0" {{ old('is_published', $section->is_published) == 0 ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ old('is_published', $section->is_published) == 1 ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('is_published')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">বিবরণ</label>
                    <textarea name="description" id="description" rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">{{ old('description', $section->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 flex justify-end space-x-3">
                <a href="{{ route('admin.sections.index') }}" 
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