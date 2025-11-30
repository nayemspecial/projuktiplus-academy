@extends('layouts.admin')

@section('title', 'আমার প্রোফাইল')

@section('header', 'প্রোফাইল সেটিংস')

@section('admin-content')
<div class="mx-auto">
    
    <!-- Tabs Navigation -->
    <div class="mb-6 border-b border-gray-200 dark:border-slate-700">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <!-- General Info Tab -->
            <a href="{{ route('admin.profile.index') }}" 
               class="{{ request()->routeIs('admin.profile.index') ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2">
               <i class="fas fa-user-circle"></i> সাধারণ তথ্য
            </a>

            <!-- Security Tab -->
            <a href="{{ route('admin.profile.security') }}" 
               class="{{ request()->routeIs('admin.profile.security') ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2">
               <i class="fas fa-lock"></i> সিকিউরিটি ও পাসওয়ার্ড
            </a>
        </nav>
    </div>

    <!-- Content Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">ব্যক্তিগত তথ্য</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">আপনার নাম, ইমেইল এবং প্রোফাইল ছবি আপডেট করুন।</p>
        </div>
        
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Avatar Upload -->
            <div class="flex items-center gap-6">
                <div class="relative">
                    <img id="avatar-preview" 
                            src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}" 
                            alt="{{ $user->name }}" 
                            class="h-24 w-24 rounded-full object-cover border-4 border-white dark:border-slate-700 shadow-md">
                    
                    <label for="avatar" class="absolute bottom-0 right-0 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full cursor-pointer shadow-sm transition-colors">
                        <i class="fas fa-camera text-xs"></i>
                        <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*" onchange="previewAvatar(this)">
                    </label>
                </div>
                <div>
                    <h4 class="text-base font-medium text-gray-900 dark:text-white">প্রোফাইল ছবি</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">JPG, PNG বা GIF (সর্বোচ্চ 2MB)</p>
                </div>
            </div>
            @error('avatar') <p class="text-xs text-red-500">{{ $message }}</p> @enderror

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">আপনার নাম</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="block w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 dark:bg-slate-900 dark:text-white">
                    @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Email -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ইমেইল অ্যাড্রেস</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="block w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 dark:bg-slate-900 dark:text-white">
                    @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Phone -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ফোন নম্বর</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="block w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 dark:bg-slate-900 dark:text-white">
                    @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Role (Readonly) -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">রোল</label>
                    <input type="text" value="{{ ucfirst($user->role) }}" readonly
                            class="block w-full px-4 py-2 border border-gray-200 dark:border-slate-700 bg-gray-100 dark:bg-slate-800 rounded-lg text-gray-500 cursor-not-allowed">
                </div>

                <!-- Bio -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">বায়ো / নিজের সম্পর্কে</label>
                    <textarea name="bio" rows="3" class="block w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 dark:bg-slate-900 dark:text-white">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                    <i class="fas fa-save mr-2"></i> পরিবর্তন সেভ করুন
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection