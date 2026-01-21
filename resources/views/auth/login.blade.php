@extends('layouts.auth')

@section('title', 'লগইন')

@section('auth-content')
<div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl shadow-2xl rounded-2xl overflow-hidden border border-white/50 dark:border-slate-700/50">
    <div class="px-8 py-8">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-slate-800 dark:text-white mb-2 font-heading">স্বাগতম! 👋</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm">আপনার একাউন্টে লগইন করুন</p>
        </div>
        
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="login-email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">ইমেইল</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="login-email" name="email" value="{{ old('email') }}" required autofocus
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
                <div class="flex justify-between items-center mb-1.5">
                    <label for="login-password" class="block text-sm font-bold text-slate-700 dark:text-slate-300">পাসওয়ার্ড</label>
                    <a href="{{ route('password.request') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-bold hover:underline transition-colors">
                        পাসওয়ার্ড ভুলে গেছেন?
                    </a>
                </div>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="login-password" name="password" required 
                           class="w-full pl-10 pr-10 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('password') border-red-500 @enderror"
                           placeholder="********">
                    
                    <button type="button" onclick="togglePasswordVisibility('login-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors cursor-pointer focus:outline-none">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex items-center bg-blue-50/50 dark:bg-slate-700/30 p-2.5 rounded-lg border border-blue-100 dark:border-slate-700 w-fit">
                <input id="remember-me" type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 dark:border-slate-500 rounded bg-white dark:bg-slate-800 cursor-pointer">
                <label for="remember-me" class="ml-2 block text-xs font-medium text-slate-600 dark:text-slate-300 cursor-pointer select-none">আমাকে মনে রাখুন</label>
            </div>

            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                লগইন করুন <i class="fas fa-sign-in-alt ml-2 mt-1"></i>
            </button>
        </form>
        
        <div class="mt-8 text-center text-sm text-slate-600 dark:text-slate-400 border-t border-slate-100 dark:border-slate-700 pt-6">
            একাউন্ট নেই? 
            <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-bold hover:underline ml-1 transition-colors">
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
</script>
@endsection