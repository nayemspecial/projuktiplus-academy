@extends('layouts.auth')

@section('title', 'পাসওয়ার্ড রিসেট')

@section('auth-content')
<div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl shadow-2xl rounded-2xl overflow-hidden border border-white/50 dark:border-slate-700/50">
    <div class="px-8 py-8">
        
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white mb-2 font-heading">নতুন পাসওয়ার্ড সেট করুন</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">আপনার একাউন্টের জন্য নতুন ও শক্তিশালী পাসওয়ার্ড দিন।</p>
        </div>
        
        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div>
                <label for="reset-email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">ইমেইল</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-envelope"></i>
                    </span>
                    {{-- [FIX] ইমেইল URL থেকে অটোমেটিক নিয়ে নিবে --}}
                    <input type="email" id="reset-email" name="email" value="{{ old('email', $email) }}" required
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('email') border-red-500 @enderror">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>
            
            <div>
                <label for="reset-password" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">নতুন পাসওয়ার্ড</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="reset-password" name="password" required autofocus
                           class="w-full pl-10 pr-10 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('password') border-red-500 @enderror"
                           placeholder="********">
                    
                    <button type="button" onclick="togglePasswordVisibility('reset-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors cursor-pointer focus:outline-none">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>
            
            <div>
                <label for="reset-confirm-password" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">পাসওয়ার্ড নিশ্চিত করুন</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fas fa-lock-open"></i>
                    </span>
                    <input type="password" id="reset-confirm-password" name="password_confirmation" required 
                           class="w-full pl-10 pr-10 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm"
                           placeholder="********">
                    
                    <button type="button" onclick="togglePasswordVisibility('reset-confirm-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors cursor-pointer focus:outline-none">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                পাসওয়ার্ড রিসেট করুন <i class="fas fa-check-circle ml-2 mt-1"></i>
            </button>
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