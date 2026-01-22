@extends('layouts.admin')

@section('title', 'নতুন কুপন তৈরি - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">নতুন কুপন যুক্ত করুন</h3>
            <p class="text-gray-600 dark:text-gray-400 mt-1">কোর্সের জন্য ডিসকাউন্ট অফার তৈরি করুন</p>
        </div>
        <a href="{{ route('admin.coupons.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> ব্যাকে যান
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">কুপন তথ্য ফরম</h4>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.coupons.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কুপন কোড <span class="text-red-500">*</span></label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-ticket-alt text-gray-400"></i>
                            </div>
                            <input type="text" name="code" required placeholder="উদাহরণ: EID2025" 
                                   class="pl-10 block w-full border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white uppercase"
                                   value="{{ old('code') }}">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">কোডটি অবশ্যই ইউনিক হতে হবে।</p>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">প্রযোজ্য কোর্স</label>
                        <select name="course_id" class="block w-full border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                            <option value="">সকল কোর্সের জন্য</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ Str::limit($course->title, 40) }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500">সিলেক্ট না করলে সব কোর্সে কাজ করবে।</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ডিসকাউন্ট টাইপ <span class="text-red-500">*</span></label>
                        <select name="type" required class="block w-full border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                            <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>শতাংশ (%)</option>
                            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>ফিক্সড এমাউন্ট (Tk)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ডিসকাউন্ট ভ্যালু <span class="text-red-500">*</span></label>
                        <div class="relative rounded-md shadow-sm">
                            <input type="number" name="value" step="0.01" required placeholder="10 or 500" 
                                   class="block w-full border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white"
                                   value="{{ old('value') }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">শুরু হবে (Valid From)</label>
                        <input type="date" name="valid_from" 
                               class="block w-full border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white"
                               value="{{ old('valid_from') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">শেষ হবে (Valid To)</label>
                        <input type="date" name="valid_to" 
                               class="block w-full border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white"
                               value="{{ old('valid_to') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">সর্বনিম্ন অর্ডারের পরিমাণ</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">৳</span>
                            </div>
                            <input type="number" name="min_order_amount" placeholder="0" 
                                   class="pl-8 block w-full border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white"
                                   value="{{ old('min_order_amount') }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">সর্বোচ্চ ব্যবহার সংখ্যা</label>
                        <input type="number" name="max_uses" placeholder="যেমন: 100" 
                               class="block w-full border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white"
                               value="{{ old('max_uses') }}">
                    </div>
                </div>

                <div class="mt-6 flex items-center">
                    <input id="is_active" name="is_active" type="checkbox" checked
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900 dark:text-gray-300 cursor-pointer">
                        কুপনটি সাথে সাথেই <span class="font-bold">Active</span> করতে চাই
                    </label>
                </div>

                <div class="mt-8 pt-5 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i class="fas fa-save mr-2"></i> কুপন সেভ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection