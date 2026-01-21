@extends('layouts.auth')

@section('title', 'রেজিস্ট্রেশন')

@section('auth-content')
<div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl shadow-2xl rounded-2xl overflow-hidden border border-white/50 dark:border-slate-700/50">
    <div class="px-8 py-8">
        
        <h2 class="text-2xl font-bold text-center text-slate-800 dark:text-white mb-2 font-heading">
            নতুন একাউন্ট তৈরি করুন
        </h2>
        <p class="text-center text-slate-500 dark:text-slate-400 text-sm mb-6">
            আপনার দক্ষতা বাড়াতে আজই যুক্ত হোন
        </p>
        
        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="register-name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">পূর্ণ নাম</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" id="register-name" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('name') border-red-500 @enderror"
                           placeholder="আপনার নাম">
                </div>
                @error('name')
                    <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="register-email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">ইমেইল</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="register-email" name="email" value="{{ old('email') }}" required
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('email') border-red-500 @enderror"
                           placeholder="name@example.com">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="register-password" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">পাসওয়ার্ড</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="register-password" name="password" required 
                           class="w-full pl-10 pr-10 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('password') border-red-500 @enderror"
                           placeholder="********">
                    
                    <button type="button" onclick="togglePasswordVisibility('register-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors cursor-pointer">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <p class="mt-1 text-[10px] text-slate-500 dark:text-slate-400 flex items-center gap-1">
                    <i class="fas fa-info-circle"></i> পাসওয়ার্ড কমপক্ষে ৮ ক্যারেক্টার হতে হবে
                </p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="register-confirm-password" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">পাসওয়ার্ড নিশ্চিত করুন</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-lock-open"></i>
                    </span>
                    <input type="password" id="register-confirm-password" name="password_confirmation" required 
                           class="w-full pl-10 pr-10 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm"
                           placeholder="********">
                    
                    <button type="button" onclick="togglePasswordVisibility('register-confirm-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors cursor-pointer">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-start bg-blue-50/50 dark:bg-slate-700/30 p-3 rounded-lg border border-blue-100 dark:border-slate-700">
                <input id="terms" type="checkbox" name="agreeTerms" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 dark:border-slate-500 rounded bg-white dark:bg-slate-800 cursor-pointer" required>
                <label for="terms" class="ml-3 block text-xs text-slate-600 dark:text-slate-300 cursor-pointer select-none">
                    আমি <a href="{{ route('policy.terms') }}" target="_blank" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">শর্তাবলী</a> এবং <a href="{{ route('policy.privacy') }}" target="_blank" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">গোপনীয়তা নীতি</a> পড়েছি এবং মেনে নিচ্ছি।
                </label>
            </div>

            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                একাউন্ট তৈরি করুন <i class="fas fa-arrow-right ml-2 mt-1"></i>
            </button>
        </form>
        
        <div class="mt-8 text-center text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-700 pt-6">
            ইতিমধ্যে একাউন্ট আছে? 
            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-bold hover:underline ml-1 transition-colors">
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