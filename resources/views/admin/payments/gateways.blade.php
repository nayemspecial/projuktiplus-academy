@extends('layouts.admin')

@section('title', 'পেমেন্ট গেটওয়ে সেটিংস')

@section('header', 'পেমেন্ট কনফিগারেশন')

@section('actions')
    <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> লেনদেন তালিকা
    </a>
@endsection

@section('admin-content')
<div class="space-y-6">
    @foreach($gateways as $gateway)
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50/50 dark:bg-slate-800/50 flex justify-between items-center">
            <div class="flex items-center gap-3">
                @if($gateway->name === 'stripe')
                    <i class="fab fa-stripe text-blue-600 text-3xl"></i>
                @elseif($gateway->name === 'paypal')
                    <i class="fab fa-paypal text-blue-700 text-2xl"></i>
                @elseif($gateway->name === 'sslcommerz')
                    <i class="fas fa-credit-card text-green-600 text-xl"></i>
                @else
                    <i class="fas fa-money-bill-wave text-gray-600 dark:text-gray-400 text-xl"></i>
                @endif
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $gateway->title }}</h3>
            </div>
            
            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $gateway->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                {{ $gateway->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
            </span>
        </div>
        
        <form action="{{ route('admin.payments.gateways.update', $gateway->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Settings Toggles -->
                <div class="space-y-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $gateway->is_active ? 'checked' : '' }} class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">গেটওয়ে সক্রিয় করুন</span>
                    </label>

                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="test_mode" value="1" {{ $gateway->test_mode ? 'checked' : '' }} class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-500"></div>
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">টেস্ট মোড (Sandbox)</span>
                    </label>
                </div>
            </div>

            <!-- Dynamic Credentials Fields -->
            <div class="space-y-4 border-t border-gray-200 dark:border-slate-600 pt-4">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">এপিআই ক্রেডেনশিয়ালস</h4>
                
                @if($gateway->name === 'stripe')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Publishable Key</label>
                            <input type="text" name="credentials[publishable_key]" value="{{ $gateway->credentials['publishable_key'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg dark:bg-slate-900 dark:text-white text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Secret Key</label>
                            <input type="password" name="credentials[secret_key]" value="{{ $gateway->credentials['secret_key'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg dark:bg-slate-900 dark:text-white text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                @elseif($gateway->name === 'paypal')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Client ID</label>
                            <input type="text" name="credentials[client_id]" value="{{ $gateway->credentials['client_id'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg dark:bg-slate-900 dark:text-white text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Client Secret</label>
                            <input type="password" name="credentials[client_secret]" value="{{ $gateway->credentials['client_secret'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg dark:bg-slate-900 dark:text-white text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                @elseif($gateway->name === 'sslcommerz')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Store ID</label>
                            <input type="text" name="credentials[store_id]" value="{{ $gateway->credentials['store_id'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg dark:bg-slate-900 dark:text-white text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Store Password</label>
                            <input type="password" name="credentials[store_password]" value="{{ $gateway->credentials['store_password'] ?? '' }}" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg dark:bg-slate-900 dark:text-white text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                @elseif($gateway->name === 'manual')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">ব্যাংক/মোবাইল ব্যাংকিং তথ্য</label>
                            <textarea name="credentials[bank_info]" rows="2" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg dark:bg-slate-900 dark:text-white text-sm focus:ring-blue-500 focus:border-blue-500">{{ $gateway->credentials['bank_info'] ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">পেমেন্ট নির্দেশনা</label>
                            <textarea name="credentials[instructions]" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg dark:bg-slate-900 dark:text-white text-sm focus:ring-blue-500 focus:border-blue-500">{{ $gateway->credentials['instructions'] ?? '' }}</textarea>
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors shadow-sm">
                    <i class="fas fa-save mr-2"></i> সেটিংস সেভ করুন
                </button>
            </div>
        </form>
    </div>
    @endforeach
</div>
@endsection