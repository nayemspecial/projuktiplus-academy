@extends('layouts.admin')

@section('title', 'সিকিউরিটি সেটিংস')

@section('header', 'প্রোফাইল সেটিংস')

@section('admin-content')
<div class="mx-auto">
    
    <!-- Tabs Navigation -->
    <div class="mb-6 border-b border-gray-200 dark:border-slate-700">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <!-- General Info Tab -->
            <a href="{{ route('admin.profile.index') }}" 
               class="{{ request()->routeIs('admin.profile.index') ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2 transition-colors">
               <i class="fas fa-user-circle"></i> সাধারণ তথ্য
            </a>

            <!-- Security Tab (Active) -->
            <a href="{{ route('admin.profile.security') }}" 
               class="{{ request()->routeIs('admin.profile.security') ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2 transition-colors">
               <i class="fas fa-lock"></i> সিকিউরিটি ও পাসওয়ার্ড
            </a>
        </nav>
    </div>

    <!-- Content Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">পাসওয়ার্ড পরিবর্তন</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">আপনার অ্যাকাউন্টের নিরাপত্তার জন্য শক্তিশালী পাসওয়ার্ড ব্যবহার করুন।</p>
        </div>
        
        <form action="{{ route('admin.profile.security.update') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="max-w-xl space-y-6">
                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">বর্তমান পাসওয়ার্ড</label>
                    <div class="relative">
                        <input type="password" name="current_password" id="current_password" required
                               class="block w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white shadow-sm transition-colors">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-400 hover:text-gray-600" onclick="togglePassword('current_password', this)">
                            <i class="far fa-eye"></i>
                        </div>
                    </div>
                    @error('current_password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">নতুন পাসওয়ার্ড</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                               class="block w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white shadow-sm transition-colors">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-400 hover:text-gray-600" onclick="togglePassword('password', this)">
                            <i class="far fa-eye"></i>
                        </div>
                    </div>
                    @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">নতুন পাসওয়ার্ড নিশ্চিত করুন</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="block w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white shadow-sm transition-colors">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-400 hover:text-gray-600" onclick="togglePassword('password_confirmation', this)">
                            <i class="far fa-eye"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200 dark:border-slate-700 flex justify-start">
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-key mr-2"></i> পাসওয়ার্ড আপডেট করুন
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function togglePassword(fieldId, iconContainer) {
        const input = document.getElementById(fieldId);
        const icon = iconContainer.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
@endsection