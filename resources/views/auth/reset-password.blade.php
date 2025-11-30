@extends('layouts.auth')

@section('title', 'ProjuktiPlus LMS - Reset Password')

@section('auth-content')
<div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg overflow-hidden">
    <div class="px-8 py-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">নতুন পাসওয়ার্ড সেট করুন</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-6">আপনার ইমেইল এড্রেস এবং নতুন পাসওয়ার্ড লিখুন।</p>
        
        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div>
                <label for="reset-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল</label>
                <input type="email" id="reset-email" name="email" value="{{ $email ?? old('email') }}" required class="form-input w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="reset-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">নতুন পাসওয়ার্ড</label>
                <div class="relative">
                    <input type="password" id="reset-password" name="password" required class="form-input w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                    <button type="button" onclick="togglePasswordVisibility('reset-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">পাসওয়ার্ড কমপক্ষে ৮ ক্যারেক্টার লম্বা হতে হবে</p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="reset-confirm-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পাসওয়ার্ড নিশ্চিত করুন</label>
                <div class="relative">
                    <input type="password" id="reset-confirm-password" name="password_confirmation" required class="form-input w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                    <button type="button" onclick="togglePasswordVisibility('reset-confirm-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    পাসওয়ার্ড রিসেট করুন
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
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
@endsection