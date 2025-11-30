@extends('layouts.instructor')

@section('title', 'কোর্স এডিট করুন: ' . $course->title)

@section('instructor-content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">কোর্স এডিট করুন</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $course->title }}</p>
        </div>
        <a href="{{ route('instructor.courses.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700">
            <i class="fas fa-arrow-left mr-2"></i> সব কোর্সে ফিরে যান
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        
        <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স শিরোনাম <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স বিবরণ</label>
                            <textarea name="description" id="description" rows="8" 
                                      class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">{{ old('description', $course->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">কোর্স কন্টেন্ট</h3>
                            <div class="p-6 border border-gray-200 dark:border-slate-700 rounded-md bg-gray-50 dark:bg-slate-800/50 text-center">
                                <p class="text-gray-500 dark:text-gray-400">
                                    <a href="{{ route('instructor.courses.show', $course->id) }}" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                        কোর্স কন্টেন্ট পেজ
                                    </a>
                                    এ গিয়ে সেকশন ও লেসন ম্যানেজ করুন।
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স থাম্বনেইল</label>
                            <div class="mt-1">
                                @if($course->thumbnail)
                                <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-auto rounded-md mb-4 object-cover">
                                @endif
                                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-slate-700 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <i class="fas fa-image text-4xl text-gray-400"></i>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <label for="thumbnail" class="relative cursor-pointer bg-white dark:bg-slate-800 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">
                                                <span>ছবি পরিবর্তন করুন</span>
                                                <input id="thumbnail" name="thumbnail" type="file" class="sr-only" accept="image/*">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF (সর্বোচ্চ 2MB)</p>
                                    </div>
                                </div>
                            </div>
                            @error('thumbnail')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স মূল্য (৳) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" id="price" value="{{ old('price', $course->price) }}" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ক্যাটাগরি <span class="text-red-500">*</span></label>
                            <select name="category" id="category" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                                <option value="web-development" {{ old('category', $course->category) == 'web-development' ? 'selected' : '' }}>ওয়েব ডেভেলপমেন্ট</option>
                                <option value="mobile-development" {{ old('category', $course->category) == 'mobile-development' ? 'selected' : '' }}>মোবাইল ডেভেলপমেন্ট</option>
                                <option value="data-science" {{ old('category', $course->category) == 'data-science' ? 'selected' : '' }}>ডাটা সায়েন্স</option>
                                <option value="ux-ui" {{ old('category', $course->category) == 'ux-ui' ? 'selected' : '' }}>ইউআই/ইউএক্স ডিজাইন</option>
                                <option value="digital-marketing" {{ old('category', $course->category) == 'digital-marketing' ? 'selected' : '' }}>ডিজিটাল মার্কেটিং</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স স্তর <span class="text-red-500">*</span></label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input id="level_beginner" name="level" type="radio" value="beginner" {{ old('level', $course->level) == 'beginner' ? 'checked' : '' }}
                                           class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-slate-700 dark:bg-slate-800">
                                    <label for="level_beginner" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">শুরু (Beginner)</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="level_intermediate" name="level" type="radio" value="intermediate" {{ old('level', $course->level) == 'intermediate' ? 'checked' : '' }}
                                           class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 dark:border-slate-700 dark:bg-slate-800">
                                    <label for="level_intermediate" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">মধ্যম (Intermediate)</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="level_advanced" name="level" type="radio" value="advanced" {{ old('level', $course->level) == 'advanced' ? 'checked' : '' }}
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

            <div class="px-6 py-4 bg-gray-50 dark:bg-slate-700/50 flex justify-between items-center">
                <button type="button" @click="$dispatch('open-modal', 'delete-course-modal')" class="text-sm font-medium text-red-600 dark:text-red-400 hover:text-red-800">
                    কোর্স ডিলিট করুন
                </button>
                <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-save mr-2"></i> পরিবর্তন সেভ করুন
                </button>
            </div>
        </form>
    </div>

    <div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'delete-course-modal') open = true" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" @click="open = false"></div>

            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
                 class="relative bg-white dark:bg-slate-800 rounded-lg shadow-xl overflow-hidden transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                
                <form action="{{ route('instructor.courses.destroy', $course->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="p-6 text-center">
                        <div class="w-16 h-16 mx-auto flex items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                            <i class="fas fa-exclamation-triangle text-3xl text-red-500"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white mt-4">আপনি কি নিশ্চিত?</h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-2">আপনি কি সত্যিই এই কোর্সটি ডিলিট করতে চান? এই প্রক্রিয়াটি আনডু করা যাবে না।</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                            হ্যাঁ, ডিলিট করুন
                        </button>
                        <button type="button" @click="open = false" class="mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto sm:text-sm">
                             বাতিল করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection