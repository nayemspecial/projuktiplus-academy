@extends('layouts.auth')

@section('title', 'পাসওয়ার্ড রিসেট')

@section('auth-content')
<div class="bg-white dark:bg-slate-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-slate-700">
    <div class="px-8 py-8">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">নতুন পাসওয়ার্ড সেট করুন</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">আপনার একাউন্টের জন্য নতুন ও শক্তিশালী পাসওয়ার্ড দিন।</p>
        </div>
        
        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div>
                <label for="reset-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    {{-- [FIX] ইমেইল URL থেকে অটোমেটিক নিয়ে নিবে --}}
                    <input type="email" id="reset-email" name="email" value="{{ old('email', $email) }}" required
                           class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="reset-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">নতুন পাসওয়ার্ড</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="reset-password" name="password" required autofocus
                           class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                           placeholder="********">
                    <button type="button" onclick="togglePasswordVisibility('reset-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="reset-confirm-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পাসওয়ার্ড নিশ্চিত করুন</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-lock-open"></i>
                    </span>
                    <input type="password" id="reset-confirm-password" name="password_confirmation" required 
                           class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button type="button" onclick="togglePasswordVisibility('reset-confirm-password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 transition-all transform hover:-translate-y-0.5">
                পাসওয়ার্ড রিসেট করুন
            </button>
        </form>
    </div>
</div>

<script>
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
}
</script>
@endsection