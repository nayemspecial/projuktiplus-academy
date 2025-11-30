@extends('layouts.instructor')

@section('title', 'সেটিংস - সাধারণ তথ্য')

@section('instructor-content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">প্রোফাইল সেটিংস</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">আপনার ব্যক্তিগত তথ্য আপডেট করুন</p>
    </div>

    <div class="flex border-b border-gray-200 dark:border-slate-700 mb-6 overflow-x-auto">
        <a href="{{ route('instructor.settings.index') }}" 
           class="px-4 py-2 border-b-2 font-medium transition-colors whitespace-nowrap {{ request()->routeIs('instructor.settings.index') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
            সাধারণ তথ্য
        </a>
        <a href="{{ route('instructor.settings.security') }}" 
           class="px-4 py-2 border-b-2 font-medium transition-colors whitespace-nowrap {{ request()->routeIs('instructor.settings.security') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
            সিকিউরিটি
        </a>
        <a href="{{ route('instructor.settings.notifications') }}" 
           class="px-4 py-2 border-b-2 font-medium transition-colors whitespace-nowrap {{ request()->routeIs('instructor.settings.notifications') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
            নোটিফিকেশন
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <form action="{{ route('instructor.settings.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="relative group">
                        <img id="avatar-preview" class="h-24 w-24 rounded-full object-cover border-4 border-gray-100 dark:border-slate-700" 
                             src="{{ $instructor->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($instructor->name) }}" 
                             alt="{{ $instructor->name }}">
                        <label for="avatar" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition duration-200">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <div class="text-center sm:text-left">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">প্রোফাইল ছবি</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">JPG, GIF বা PNG। সর্বোচ্চ 2MB।</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পূর্ণ নাম</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $instructor->name) }}" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল</label>
                        <input type="email" value="{{ $instructor->email }}" disabled
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-gray-100 dark:bg-slate-700 text-gray-500 cursor-not-allowed">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ফোন নাম্বার</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $instructor->phone) }}"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white">
                    </div>
                    
                    <div>
                        <label for="expertise" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">বিশেষজ্ঞতা (Expertise)</label>
                        <input type="text" name="expertise" id="expertise" value="{{ old('expertise', $instructor->expertise ?? '') }}"
                               placeholder="যেমন: Laravel, VueJS"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white">
                    </div>
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">বায়ো / নিজের সম্পর্কে</label>
                    <textarea name="bio" id="bio" rows="4"
                              class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white">{{ old('bio', $instructor->bio) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">সংক্ষেপে আপনার অভিজ্ঞতা এবং দক্ষতা সম্পর্কে লিখুন।</p>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        পরিবর্তন সেভ করুন
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection