@extends('layouts.auth')

@section('title', 'ProjuktiPlus LMS - Login')

@section('auth-content')
<div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg overflow-hidden">
    <div class="px-8 py-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">লগইন করুন</h2>
        
        <!-- Social Login Buttons -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <button onclick="socialLogin('google')" class="social-btn flex items-center justify-center py-2 px-4 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700">
                <i class="fab fa-google text-red-500 mr-2"></i> Google
            </button>
            <button onclick="socialLogin('facebook')" class="social-btn flex items-center justify-center py-2 px-4 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700">
                <i class="fab fa-facebook-f text-blue-600 mr-2"></i> Facebook
            </button>
        </div>
        
        <!-- Divider -->
        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300 dark:border-slate-700"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white dark:bg-slate-800 text-gray-500 dark:text-gray-400">অথবা</span>
            </div>
        </div>
        
        <!-- Email/Password Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="login-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল</label>
                <input type="email" id="login-email" name="email" required class="form-input w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="login-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পাসওয়ার্ড</label>
                <div class="relative">
                    <input type="password" id="login-password" name="password" required class="form-input w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                    <button type="button" onclick="togglePasswordVisibility('login-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="flex justify-end mt-1">
                    <a href="{{ route('password.request') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">
                        পাসওয়ার্ড ভুলে গেছেন?
                    </a>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center">
                <input id="remember-me" type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-700 rounded dark:bg-slate-800">
                <label for="remember-me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">আমাকে মনে রাখুন</label>
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    লগইন
                </button>
            </div>
        </form>
        
        <div class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
            একাউন্ট নেই? 
            <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 font-medium">
                রেজিস্ট্রেশন করুন
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

function socialLogin(provider) {
    console.log(`Social login with ${provider}`);
    alert(`${provider} লগইন সিস্টেমে রিডাইরেক্ট করা হচ্ছে...`);
}
</script>
@endsection