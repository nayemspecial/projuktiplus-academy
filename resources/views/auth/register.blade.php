@extends('layouts.auth')

@section('title', 'রেজিস্ট্রেশন')

@section('auth-content')
<div class="bg-white dark:bg-slate-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-slate-700">
    <div class="px-8 py-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-2">নতুন একাউন্ট তৈরি করুন</h2>
        <p class="text-center text-gray-500 dark:text-gray-400 text-sm mb-6">আপনার দক্ষতা বাড়াতে আজই যুক্ত হোন</p>
        
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label for="register-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পূর্ণ নাম</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" id="register-name" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                           placeholder="আপনার নাম">
                </div>
                @error('name')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="register-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="register-email" name="email" value="{{ old('email') }}" required
                           class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                           placeholder="name@example.com">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="register-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পাসওয়ার্ড</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="register-password" name="password" required 
                           class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                           placeholder="********">
                    
                    <button type="button" onclick="togglePasswordVisibility('register-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">পাসওয়ার্ড কমপক্ষে ৮ ক্যারেক্টার হতে হবে</p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="register-confirm-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পাসওয়ার্ড নিশ্চিত করুন</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-lock-open"></i>
                    </span>
                    <input type="password" id="register-confirm-password" name="password_confirmation" required 
                           class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           placeholder="********">
                    
                    <button type="button" onclick="togglePasswordVisibility('register-confirm-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-start">
                <input id="terms" type="checkbox" name="agreeTerms" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 rounded dark:bg-slate-700">
                <label for="terms" class="ml-2 block text-sm text-gray-600 dark:text-gray-400">
                    আমি <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">শর্তাবলী</a> এবং <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">গোপনীয়তা নীতি</a> মেনে নিচ্ছি
                </label>
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                একাউন্ট তৈরি করুন
            </button>
        </form>
        
        <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
            ইতিমধ্যে একাউন্ট আছে? 
            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-bold hover:underline">
                লগইন করুন
            </a>
        </div>
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