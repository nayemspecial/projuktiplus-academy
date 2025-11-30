@extends('layouts.admin')

@section('title', 'টেমপ্লেট এডিট করুন - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="mx-auto max-w-4xl">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">টেমপ্লেট এডিট করুন: {{ $template->name }}</h3>
        </div>
        
        <form action="{{ route('admin.certificates.templates.update', $template) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="px-6 py-6 space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">নাম *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $template->name) }}" 
                           class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">বর্ণনা</label>
                    <textarea name="description" id="description" rows="2" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">{{ old('description', $template->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কনটেন্ট *</label>
                    <textarea name="content" id="content" rows="10" 
                              class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white font-mono text-sm" 
                              required>{{ old('content', $template->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        ব্যবহার করুন: {student_name}, {course_name}, {issue_date}, {certificate_number}
                    </p>
                </div>
                
                <!-- Status -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600"
                               {{ old('is_active', $template->is_active) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">সক্রিয়</span>
                    </label>
                    @error('is_active')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 flex justify-end space-x-3">
                <a href="{{ route('admin.certificates.templates') }}" 
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