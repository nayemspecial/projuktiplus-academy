@extends('layouts.student')

@section('title', 'আমার প্রোফাইল - ProjuktiPlus LMS')

@section('student-content')
<div class="mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">প্রোফাইল সেটিংস</h1>
        <p class="text-gray-600 dark:text-gray-400">আপনার ব্যক্তিগত তথ্য আপডেট করুন</p>
    </div>

    <div class="flex border-b border-gray-200 dark:border-slate-700 mb-6">
        <a href="{{ route('student.profile.index') }}" class="px-4 py-2 border-b-2 {{ request()->routeIs('student.profile.index') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }} font-medium">
            সাধারণ তথ্য
        </a>
        <a href="{{ route('student.profile.security') }}" class="px-4 py-2 border-b-2 {{ request()->routeIs('student.profile.security') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }} font-medium">
            সিকিউরিটি
        </a>
        <a href="{{ route('student.profile.notifications') }}" class="px-4 py-2 border-b-2 {{ request()->routeIs('student.profile.notifications') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }} font-medium">
            নোটিফিকেশন
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            @if(session('success'))
                <div class="mb-6 bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-400 p-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-1/3 flex flex-col items-center">
                    <div class="relative mb-4 group">
                        <img id="avatar-preview" 
                             src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}" 
                             alt="{{ $user->name }}" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-gray-100 dark:border-slate-700 group-hover:opacity-75 transition">
                        
                        <label for="avatar" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition duration-200">
                            <i class="fas fa-camera mr-2"></i> পরিবর্তন
                        </label>
                        <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                        JPG, PNG বা GIF (সর্বোচ্চ 1MB)
                    </p>
                    @error('avatar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex-1 space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পুরো নাম</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল এড্রেস</label>
                        <input type="email" value="{{ $user->email }}" disabled
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-gray-100 dark:bg-slate-700 text-gray-500 cursor-not-allowed">
                        <p class="text-xs text-gray-500 mt-1">ইমেইল পরিবর্তনের জন্য সাপোর্টে যোগাযোগ করুন</p>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ফোন নাম্বার</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">বায়ো / নিজের সম্পর্কে</label>
                        <textarea name="bio" id="bio" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">{{ old('bio', $user->bio) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">আপনার সম্পর্কে সংক্ষেপে লিখুন (সর্বোচ্চ ৫০০ ক্যারেক্টার)</p>
                        @error('bio')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            পরিবর্তন সেভ করুন
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
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