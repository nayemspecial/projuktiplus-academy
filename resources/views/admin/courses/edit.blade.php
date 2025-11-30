@extends('layouts.admin')

@section('title', 'কোর্স এডিট')

@section('header', 'কোর্স এডিট: ' . $course->title)

@section('actions')
    <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> ফিরে যান
    </a>
@endsection

@section('admin-content')
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
    <!-- AlpineJS এর মাধ্যমে ডাটা লোড করা হচ্ছে -->
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8" 
          x-data="courseForm(
              @js($course->what_you_will_learn), 
              @js($course->requirements), 
              @js($course->target_audience)
          )">
        @csrf
        @method('PUT')
        
        <!-- 1. Basic Information -->
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b border-gray-200 dark:border-slate-700 pb-2">বেসিক তথ্য</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">শিরোনাম <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $course->title) }}" required 
                           class="block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইন্সট্রাক্টর <span class="text-red-500">*</span></label>
                    <select name="instructor_id" required class="block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ old('instructor_id', $course->instructor_id) == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ক্যাটাগরি</label>
                    <select name="category" required class="block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $course->category) == $cat ? 'selected' : '' }}>{{ ucfirst(str_replace('-', ' ', $cat)) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">মূল্য (৳)</label>
                    <input type="number" name="price" value="{{ old('price', $course->price) }}" min="0" 
                           class="block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">লেভেল</label>
                    <select name="level" class="block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white sm:text-sm">
                         @foreach($levels as $lvl)
                            <option value="{{ $lvl }}" {{ old('level', $course->level) == $lvl ? 'selected' : '' }}>{{ ucfirst($lvl) }}</option>
                        @endforeach
                    </select>
                </div>

                 <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ভাষা</label>
                    <select name="language" class="block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white sm:text-sm">
                        @foreach($languages as $lang)
                            <option value="{{ $lang }}" {{ old('language', $course->language) == $lang ? 'selected' : '' }}>{{ ucfirst($lang) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <!-- 2. Pricing & Media -->
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b border-gray-200 dark:border-slate-700 pb-2">মূল্য ও মিডিয়া</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ডিসকাউন্ট মূল্য (৳)</label>
                    <input type="number" name="discount_price" value="{{ old('discount_price', $course->discount_price) }}" min="0" 
                           class="block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white sm:text-sm">
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">নতুন থাম্বনেইল (অপশনাল)</label>
                    @if($course->thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$course->thumbnail) }}" class="h-24 w-40 object-cover rounded border border-gray-200 dark:border-slate-600">
                        </div>
                    @endif
                    <input type="file" name="thumbnail" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-gray-300">
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">প্রিভিউ ভিডিও (অপশনাল)</label>
                    @if($course->video_preview)
                        <div class="mb-2 text-xs text-green-600 dark:text-green-400 flex items-center">
                            <i class="fas fa-check-circle mr-1"></i> ভিডিও ইতিমধ্যে আপলোড করা আছে
                        </div>
                    @endif
                    <input type="file" name="video_preview" accept="video/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-gray-300">
                </div>
            </div>
        </div>

        <!-- 3. Description -->
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b border-gray-200 dark:border-slate-700 pb-2">বিবরণ</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">সংক্ষিপ্ত বিবরণ</label>
                    <textarea name="short_description" rows="2" class="block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('short_description', $course->short_description) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">বিস্তারিত বিবরণ <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="6" required class="block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('description', $course->description) }}</textarea>
                </div>
            </div>
        </div>
        
        <!-- 4. Dynamic Lists (Requirements, What you'll learn, Target Audience) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- What you will learn -->
            <div class="bg-gray-50 dark:bg-slate-700/30 p-4 rounded-lg border border-gray-200 dark:border-slate-700">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কোর্সে যা যা শিখবে</label>
                <template x-for="(item, index) in learningPoints" :key="index">
                    <div class="flex gap-2 mb-2">
                        <input type="text" name="what_you_will_learn[]" x-model="learningPoints[index]" class="flex-1 px-3 py-1.5 text-sm border border-gray-300 dark:border-slate-600 rounded-md dark:bg-slate-800 dark:text-white" placeholder="নতুন পয়েন্ট...">
                        <button type="button" @click="removeLearningPoint(index)" class="text-red-500 hover:text-red-700"><i class="fas fa-times"></i></button>
                    </div>
                </template>
                <button type="button" @click="addLearningPoint()" class="text-sm text-blue-600 hover:underline mt-1">+ আরও যোগ করুন</button>
            </div>

            <!-- Requirements -->
            <div class="bg-gray-50 dark:bg-slate-700/30 p-4 rounded-lg border border-gray-200 dark:border-slate-700">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">পূর্বশর্ত</label>
                <template x-for="(item, index) in requirements" :key="index">
                    <div class="flex gap-2 mb-2">
                        <input type="text" name="requirements[]" x-model="requirements[index]" class="flex-1 px-3 py-1.5 text-sm border border-gray-300 dark:border-slate-600 rounded-md dark:bg-slate-800 dark:text-white" placeholder="নতুন শর্ত...">
                        <button type="button" @click="removeRequirement(index)" class="text-red-500 hover:text-red-700"><i class="fas fa-times"></i></button>
                    </div>
                </template>
                <button type="button" @click="addRequirement()" class="text-sm text-blue-600 hover:underline mt-1">+ আরও যোগ করুন</button>
            </div>

            <!-- Target Audience -->
            <div class="bg-gray-50 dark:bg-slate-700/30 p-4 rounded-lg border border-gray-200 dark:border-slate-700">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কারা এই কোর্সটি করবে</label>
                <template x-for="(item, index) in targetAudience" :key="index">
                    <div class="flex gap-2 mb-2">
                        <input type="text" name="target_audience[]" x-model="targetAudience[index]" class="flex-1 px-3 py-1.5 text-sm border border-gray-300 dark:border-slate-600 rounded-md dark:bg-slate-800 dark:text-white" placeholder="অডিয়েন্স...">
                        <button type="button" @click="removeTargetAudience(index)" class="text-red-500 hover:text-red-700"><i class="fas fa-times"></i></button>
                    </div>
                </template>
                <button type="button" @click="addTargetAudience()" class="text-sm text-blue-600 hover:underline mt-1">+ আরও যোগ করুন</button>
            </div>
        </div>

        <!-- 5. Settings & Status -->
        <div class="bg-blue-50 dark:bg-blue-900/10 p-5 rounded-lg border border-blue-100 dark:border-blue-800/30">
            <div class="flex flex-wrap gap-6">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="featured" value="0">
                    <input type="checkbox" name="featured" value="1" {{ $course->featured ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 bg-white dark:bg-slate-700 dark:border-slate-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">ফিচার্ড কোর্স?</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="certificate_included" value="0">
                    <input type="checkbox" name="certificate_included" value="1" {{ $course->certificate_included ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 bg-white dark:bg-slate-700 dark:border-slate-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">সার্টিফিকেট অন্তর্ভুক্ত?</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="lifetime_access" value="0">
                    <input type="checkbox" name="lifetime_access" value="1" {{ $course->lifetime_access ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 bg-white dark:bg-slate-700 dark:border-slate-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">লাইফটাইম এক্সেস?</span>
                </label>
            </div>

            <div class="mt-6 max-w-xs">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">স্ট্যাটাস</label>
                <select name="status" class="block w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500">
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ old('status', $course->status) == $status ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex justify-end pt-4">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                <i class="fas fa-save mr-2"></i> আপডেট করুন
            </button>
        </div>
    </form>
</div>

<script>
    function courseForm(learnings, reqs, audiences) {
        return {
            // ডাটাবেস থেকে আসা ডাটা অ্যারে কিনা চেক করে ভ্যালু সেট করা হচ্ছে
            // যাতে Alpine.js ক্র্যাশ না করে
            learningPoints: (Array.isArray(learnings) && learnings.length) ? learnings : [''],
            requirements: (Array.isArray(reqs) && reqs.length) ? reqs : [''],
            targetAudience: (Array.isArray(audiences) && audiences.length) ? audiences : [''],

            addLearningPoint() { this.learningPoints.push(''); },
            removeLearningPoint(index) { this.learningPoints.splice(index, 1); },
            
            addRequirement() { this.requirements.push(''); },
            removeRequirement(index) { this.requirements.splice(index, 1); },

            addTargetAudience() { this.targetAudience.push(''); },
            removeTargetAudience(index) { this.targetAudience.splice(index, 1); }
        }
    }
</script>
@endsection