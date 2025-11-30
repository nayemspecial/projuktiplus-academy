@extends('layouts.admin')

@section('title', 'সাধারণ সেটিংস')

@section('admin-content')
<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">সাইট কনফিগারেশন</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">আপনার ওয়েবসাইটের মৌলিক তথ্যগুলো এখান থেকে পরিবর্তন করুন।</p>
        </div>
        
        <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Site Name -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">সাইটের নাম</label>
                    <input type="text" name="site_name" value="{{ \App\Models\Setting::get('site_name') }}" required
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white">
                </div>
                
                <!-- Site Email -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">সাপোর্ট ইমেইল</label>
                    <input type="email" name="site_email" value="{{ \App\Models\Setting::get('site_email') }}" required
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white">
                </div>

                <!-- Phone -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ফোন নম্বর</label>
                    <input type="text" name="site_phone" value="{{ \App\Models\Setting::get('site_phone') }}"
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white">
                </div>

                <!-- Address -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ঠিকানা</label>
                    <input type="text" name="site_address" value="{{ \App\Models\Setting::get('site_address') }}"
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white">
                </div>

                <!-- Logo Upload -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">লোগো (Logo)</label>
                    @if(\App\Models\Setting::get('site_logo'))
                        <div class="mb-2 p-2 bg-gray-100 rounded w-fit">
                            <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="Logo" class="h-10">
                        </div>
                    @endif
                    <input type="file" name="site_logo" accept="image/*" 
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-gray-300">
                </div>

                <!-- Favicon Upload -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ফেভিকন (Favicon)</label>
                    @if(\App\Models\Setting::get('site_favicon'))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . \App\Models\Setting::get('site_favicon')) }}" alt="Favicon" class="h-8 w-8">
                        </div>
                    @endif
                    <input type="file" name="site_favicon" accept="image/*" 
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-gray-300">
                </div>

                <!-- Footer Text -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ফুটার টেক্সট</label>
                    <textarea name="footer_text" rows="2" class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white">{{ \App\Models\Setting::get('footer_text') }}</textarea>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 dark:border-slate-700 flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                    <i class="fas fa-save mr-2"></i> সেভ করুন
                </button>
            </div>
        </form>
    </div>
</div>
@endsection