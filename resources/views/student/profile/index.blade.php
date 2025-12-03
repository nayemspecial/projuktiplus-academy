@extends('layouts.student')

@section('title', 'আমার প্রোফাইল - ProjuktiPlus LMS')

@section('student-content')
<div class="mx-auto">
    
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">প্রোফাইল সেটিংস</h1>
        <p class="text-gray-600 dark:text-gray-400">আপনার ব্যক্তিগত তথ্য আপডেট করুন</p>
    </div>

    <!-- Tabs Navigation -->
    <div class="flex border-b border-gray-200 dark:border-slate-700 mb-6 overflow-x-auto">
        <a href="{{ route('student.profile.index') }}" 
           class="px-6 py-3 border-b-2 font-medium text-sm flex items-center gap-2 transition-colors whitespace-nowrap {{ request()->routeIs('student.profile.index') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 hover:border-gray-300' }}">
           <i class="fas fa-user-circle"></i> সাধারণ তথ্য
        </a>
        <a href="{{ route('student.profile.security') }}" 
           class="px-6 py-3 border-b-2 font-medium text-sm flex items-center gap-2 transition-colors whitespace-nowrap {{ request()->routeIs('student.profile.security') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 hover:border-gray-300' }}">
           <i class="fas fa-lock"></i> সিকিউরিটি
        </a>
        <a href="{{ route('student.profile.notifications') }}" 
           class="px-6 py-3 border-b-2 font-medium text-sm flex items-center gap-2 transition-colors whitespace-nowrap {{ request()->routeIs('student.profile.notifications') ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 hover:border-gray-300' }}">
           <i class="fas fa-bell"></i> নোটিফিকেশন
        </a>
    </div>

    <!-- Content Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">ব্যক্তিগত তথ্য</h3>
        </div>

        {{-- [IMPORTANT] enctype="multipart/form-data" ছাড়া ছবি আপলোড হবে না --}}
        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Avatar Upload Section -->
            <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
                <div class="w-full md:w-1/3 flex flex-col items-center">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-100 dark:border-slate-700 shadow-sm">
                            {{-- ইউজার মডেলের getAvatarUrlAttribute এক্সেসর ব্যবহার করা হচ্ছে --}}
                            <img id="avatar-preview" 
                                 src="{{ $user->avatar_url }}" 
                                 alt="{{ $user->name }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <label for="avatar" class="absolute bottom-0 right-0 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full cursor-pointer shadow-md transition-transform hover:scale-110" title="ছবি পরিবর্তন করুন">
                            <i class="fas fa-camera text-sm"></i>
                            <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*" onchange="previewAvatar(this)">
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-3 text-center">
                        সর্বোচ্চ ২MB (JPG, PNG, WebP)
                    </p>
                    @error('avatar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="w-full md:w-2/3 space-y-5">
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পুরো নাম</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email (Disabled) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল অ্যাড্রেস</label>
                        <input type="email" value="{{ $user->email }}" disabled
                               class="w-full px-4 py-2 border border-gray-200 dark:border-slate-700 bg-gray-100 dark:bg-slate-800 rounded-lg text-gray-500 cursor-not-allowed">
                        <p class="text-xs text-gray-500 mt-1">ইমেইল পরিবর্তনের জন্য সাপোর্টে যোগাযোগ করুন</p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ফোন নাম্বার</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Bio -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">বায়ো / নিজের সম্পর্কে</label>
                        <textarea name="bio" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('bio', $user->bio) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">আপনার সম্পর্কে সংক্ষেপে লিখুন।</p>
                        @error('bio') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-gray-100 dark:border-slate-700 flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-sm">
                    পরিবর্তন সেভ করুন
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            // ফাইল সাইজ চেক (২ এমবি)
            if (input.files[0].size > 2 * 1024 * 1024) {
                alert('ফাইলের সাইজ ২ এমবি এর বেশি হতে পারবে না।');
                input.value = ''; // ক্লিয়ার ইনপুট
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection