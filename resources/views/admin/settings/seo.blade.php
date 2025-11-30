@extends('layouts.admin')

@section('title', 'এসইও সেটিংস')

@section('admin-content')
<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden" x-data="{ title: '{{ \App\Models\Setting::get('meta_title') }}', desc: '{{ \App\Models\Setting::get('meta_description') }}' }">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">সার্চ ইঞ্জিন অপ্টিমাইজেশন (SEO)</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">গুগল এবং সোশ্যাল মিডিয়ায় আপনার সাইট কীভাবে দেখাবে তা সেট করুন।</p>
        </div>
        
        <form action="{{ route('admin.settings.seo.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Google Preview Card -->
            <div class="bg-white p-4 rounded border border-gray-200 shadow-sm">
                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Google সার্চ প্রিভিউ</h4>
                <div class="font-sans">
                    <div class="text-sm text-[#202124] truncate mb-1">{{ url('/') }}</div>
                    <div class="text-xl text-[#1a0dab] hover:underline cursor-pointer truncate" x-text="title || 'আপনার সাইটের টাইটেল'"></div>
                    <div class="text-sm text-[#4d5156] mt-1 line-clamp-2" x-text="desc || 'এখানে আপনার সাইটের মেটা ডেসক্রিপশন দেখাবে যা গুগল সার্চ রেজাল্টে প্রদর্শিত হবে।'"></div>
                </div>
            </div>

            <div class="space-y-4">
                <!-- Meta Title -->
                <div>
                    <div class="flex justify-between">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">মেটা টাইটেল</label>
                        <span class="text-xs" :class="title.length > 60 ? 'text-red-500' : 'text-gray-400'" x-text="title.length + '/60'"></span>
                    </div>
                    <input type="text" name="meta_title" x-model="title" required
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 dark:bg-slate-900 dark:text-white">
                    <p class="text-xs text-gray-500 mt-1">সর্বোচ্চ ৬০ ক্যারেক্টার। এটি ব্রাউজার ট্যাবে এবং গুগল সার্চে দেখাবে।</p>
                </div>

                <!-- Meta Description -->
                <div>
                    <div class="flex justify-between">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">মেটা ডেসক্রিপশন</label>
                        <span class="text-xs" :class="desc.length > 160 ? 'text-red-500' : 'text-gray-400'" x-text="desc.length + '/160'"></span>
                    </div>
                    <textarea name="meta_description" rows="3" x-model="desc" required
                              class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 dark:bg-slate-900 dark:text-white"></textarea>
                    <p class="text-xs text-gray-500 mt-1">সর্বোচ্চ ১৬০ ক্যারেক্টার। এটি সার্চ রেজাল্টের নিচে দেখাবে।</p>
                </div>

                <!-- Keywords -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">মেটা কিওয়ার্ডস</label>
                    <input type="text" name="meta_keywords" value="{{ \App\Models\Setting::get('meta_keywords') }}"
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 dark:bg-slate-900 dark:text-white"
                           placeholder="lms, course, bangla tutorial (কমা দিয়ে আলাদা করুন)">
                </div>

                <!-- OG Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">সোশ্যাল শেয়ার ইমেজ (OG Image)</label>
                    <div class="flex items-center gap-4">
                        @if(\App\Models\Setting::get('og_image'))
                            <img src="{{ asset('storage/' . \App\Models\Setting::get('og_image')) }}" alt="OG Image" class="h-20 w-32 object-cover rounded border border-gray-200">
                        @endif
                        <input type="file" name="og_image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-gray-300">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">ফেসবুক বা লিঙ্কডিনে শেয়ার করলে এই ছবিটি দেখাবে। (Recommended: 1200x630px)</p>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100 dark:border-slate-700">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">আপডেট করুন</button>
            </div>
        </form>
    </div>
</div>
@endsection