@extends('layouts.auth')

@section('title', 'লগইন')

@section('auth-content')
<div class="bg-white dark:bg-slate-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-slate-700">
    <div class="px-8 py-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">স্বাগতম! 👋</h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm">আপনার একাউন্টে লগইন করুন</p>
        </div>
        
        {{-- 
        <div class="grid grid-cols-2 gap-4 mb-6">
            <a href="{{ route('social.login', 'google') }}" class="flex items-center justify-center py-2.5 px-4 border border-gray-200 dark:border-slate-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                <i class="fab fa-google text-red-500 mr-2"></i> Google
            </a>
            <a href="{{ route('social.login', 'facebook') }}" class="flex items-center justify-center py-2.5 px-4 border border-gray-200 dark:border-slate-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                <i class="fab fa-facebook-f text-blue-600 mr-2"></i> Facebook
            </a>
        </div> 
        
        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200 dark:border-slate-700"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white dark:bg-slate-800 text-gray-500 dark:text-gray-400">অথবা ইমেইল ব্যবহার করুন</span>
            </div>
        </div>
        --}}
        
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="login-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">ইমেইল</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="login-email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                           placeholder="name@example.com">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label for="login-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">পাসওয়ার্ড</label>
                    <a href="{{ route('password.request') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-500 font-medium">
                        পাসওয়ার্ড ভুলে গেছেন?
                    </a>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="login-password" name="password" required 
                           class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                           placeholder="********">
                    
                    <button type="button" onclick="togglePasswordVisibility('login-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input id="remember-me" type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 rounded dark:bg-slate-700">
                <label for="remember-me" class="ml-2 block text-sm text-gray-600 dark:text-gray-400">আমাকে মনে রাখুন</label>
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                লগইন করুন <i class="fas fa-arrow-right ml-2 mt-1"></i>
            </button>
        </form>
        
        <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
            একাউন্ট নেই? 
            <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-bold hover:underline">
                বিনামূল্যে রেজিস্ট্রেশন করুন
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