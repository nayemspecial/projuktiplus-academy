@extends('layouts.instructor')

@section('title', 'নতুন কোর্স তৈরি করুন')

@section('instructor-content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">নতুন কোর্স তৈরি করুন</h2>
        <a href="{{ route('instructor.courses.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700">
            <i class="fas fa-arrow-left mr-2"></i> সব কোর্সে ফিরে যান
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স শিরোনাম <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স বিবরণ</label>
                            <textarea name="description" id="description" rows="8" 
                                      class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স থাম্বনেইল</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-slate-700 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-image text-4xl text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="thumbnail" class="relative cursor-pointer bg-white dark:bg-slate-800 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">
                                            <span>ছবি আপলোড করুন</span>
                                            <input id="thumbnail" name="thumbnail" type="file" class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF (সর্বোচ্চ 2MB)</p>
                                </div>
                            </div>
                            @error('thumbnail')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স মূল্য (৳) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" id="price" value="{{ old('price', 0) }}" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ক্যাটাগরি <span class="text-red-500">*</span></label>
                            <select name="category" id="category" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                                <option value="web-development" {{ old('category') == 'web-development' ? 'selected' : '' }}>ওয়েব ডেভেলপমেন্ট</option>
                                <option value="mobile-development" {{ old('category') == 'mobile-development' ? 'selected' : '' }}>মোবাইল ডেভেলপমেন্ট</option>
                                <option value="data-science" {{ old('category') == 'data-science' ? 'selected' : '' }}>ডাটা সায়েন্স</option>
                                <option value="ux-ui" {{ old('category') == 'ux-ui' ? 'selected' : '' }}>ইউআই/ইউএক্স ডিজাইন</option>
                                <option value="digital-marketing" {{ old('category') == 'digital-marketing' ? 'selected' : '' }}>ডিজিটাল মার্কেটিং</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স স্তর <span class="text-red-500">*</span></label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input id="level_beginner" name="level" type="radio" value="beginner" {{ old('level', 'beginner') == 'beginner' ? 'checked' : '' }}
                                           class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-slate-700 dark:bg-slate-800">
                                    <label for="level_beginner" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">শুরু (Beginner)</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="level_intermediate" name="level" type="radio" value="intermediate" {{ old('level') == 'intermediate' ? 'checked' : '' }}
                                           class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-slate-700 dark:bg-slate-800">
                                    <label for="level_intermediate" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">মধ্যম (Intermediate)</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="level_advanced" name="level" type="radio" value="advanced" {{ old('level') == 'advanced' ? 'checked' : '' }}
                                           class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-slate-700 dark:bg-slate-800">
                                    <label for="level_advanced" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">উন্নত (Advanced)</label>
                                </div>
                            </div>
                            @error('level')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 dark:bg-slate-700/50 text-right">
                <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-save mr-2"></i> কোর্স সেভ করুন
                </button>
            </div>
        </form>
    </div>
@endsection