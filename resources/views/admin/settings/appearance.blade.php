@extends('layouts.admin')

@section('title', 'অ্যাপিয়ারেন্স সেটিংস')

@section('admin-content')
<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">থিম ও ডিজাইন</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">ওয়েবসাইটের ব্র্যান্ড কালার এবং ফন্ট ঠিক করুন।</p>
        </div>
        
        <form action="{{ route('admin.settings.appearance.update') }}" method="POST" class="p-6 space-y-8">
            @csrf
            @method('PUT')
            
            <!-- Colors -->
            <div>
                <h4 class="text-sm font-semibold text-gray-800 dark:text-white mb-4 uppercase tracking-wider border-b pb-2 dark:border-slate-700">কালার স্কিম</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Primary Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">প্রাইমারি কালার (Primary)</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="primary_color" value="{{ \App\Models\Setting::get('primary_color', '#4F46E5') }}" class="h-10 w-20 p-1 rounded border border-gray-300 cursor-pointer">
                            <input type="text" value="{{ \App\Models\Setting::get('primary_color', '#4F46E5') }}" class="flex-1 px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-gray-50 dark:bg-slate-900 dark:text-white font-mono uppercase">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">বাটন, লিংক এবং হেডিংয়ের জন্য ব্যবহৃত হবে।</p>
                    </div>

                    <!-- Accent Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">একসেন্ট কালার (Accent)</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="accent_color" value="{{ \App\Models\Setting::get('accent_color', '#10B981') }}" class="h-10 w-20 p-1 rounded border border-gray-300 cursor-pointer">
                            <input type="text" value="{{ \App\Models\Setting::get('accent_color', '#10B981') }}" class="flex-1 px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-gray-50 dark:bg-slate-900 dark:text-white font-mono uppercase">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">সাকসেস মেসেজ এবং হাইলাইটের জন্য ব্যবহৃত হবে।</p>
                    </div>
                </div>
            </div>

            <!-- Typography (Optional) -->
            <div>
                <h4 class="text-sm font-semibold text-gray-800 dark:text-white mb-4 uppercase tracking-wider border-b pb-2 dark:border-slate-700">টাইপোগ্রাফি</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ফন্ট ফ্যামিলি</label>
                        <select name="font_family" class="block w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 dark:bg-slate-900 dark:text-white">
                            <option value="Hind Siliguri" {{ \App\Models\Setting::get('font_family') == 'Hind Siliguri' ? 'selected' : '' }}>Hind Siliguri (বাংলা)</option>
                            <option value="Inter" {{ \App\Models\Setting::get('font_family') == 'Inter' ? 'selected' : '' }}>Inter (ইংরেজি)</option>
                            <option value="Roboto" {{ \App\Models\Setting::get('font_family') == 'Roboto' ? 'selected' : '' }}>Roboto</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-sm">
                    <i class="fas fa-save mr-2"></i> পরিবর্তন সেভ করুন
                </button>
            </div>
        </form>
    </div>
</div>
@endsection