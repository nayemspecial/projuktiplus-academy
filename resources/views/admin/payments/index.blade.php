@extends('layouts.admin')

@section('title', 'সকল পেমেন্ট - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">সকল পেমেন্ট</h3>
            <div class="flex gap-2">
                <a href="{{ route('admin.payments.gateways') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                    <i class="fas fa-cog mr-2"></i> পেমেন্ট গেটওয়ে
                </a>
                <a href="{{ route('admin.payments.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> নতুন পেমেন্ট
                </a>
            </div>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="px-6 py-3 bg-gray-50 dark:bg-slate-700 border-b border-gray-200 dark:border-slate-600">
        <form method="GET" class="flex flex-col md:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="search" placeholder="ট্রানজেকশন আইডি বা ইমেইল" 
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
            </div>
            <div>
                <select name="status" class="px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                    <option value="">সব স্ট্যাটাস</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    <option value="disputed" {{ request('status') == 'disputed' ? 'selected' : '' }}>Disputed</option>
                </select>
            </div>
            <div>
                <select name="gateway" class="px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                    <option value="">সব গেটওয়ে</option>
                    <option value="stripe" {{ request('gateway') == 'stripe' ? 'selected' : '' }}>Stripe</option>
                    <option value="paypal" {{ request('gateway') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full md:w-auto px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-filter mr-1"></i> ফিল্টার
                </button>
            </div>
        </form>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ট্রানজেকশন</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ব্যবহারকারী</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">কোর্স</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">পরিমাণ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">গেটওয়ে</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">তারিখ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">স্ট্যাটাস</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                @foreach($payments as $payment)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                    <!-- Transaction -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->transaction_id }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $payment->id }}</div>
                    </td>
                    
                    <!-- User -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">{{ $payment->user->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $payment->user->email }}</div>
                    </td>
                    
                    <!-- Course -->
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 dark:text-white">{{ $payment->course->title }}</div>
                    </td>
                    
                    <!-- Amount -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white">{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Platform: {{ number_format($payment->platform_fee, 2) }} | 
                            Gateway: {{ number_format($payment->gateway_fee, 2) }}
                        </div>
                    </td>
                    
                    <!-- Gateway -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                        {{ ucfirst($payment->payment_gateway) }}
                    </td>
                    
                    <!-- Date -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                        {{ $payment->created_at->format('M d, Y') }}
                    </td>
                    
                    <!-- Status -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                'failed' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                'refunded' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                'disputed' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$payment->status] }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    
                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.payments.show', $payment) }}" 
                               class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition-colors" 
                               title="দেখুন">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.payments.edit', $payment) }}" 
                               class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-900 dark:hover:text-yellow-300 transition-colors" 
                               title="এডিট">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        {{ $payments->links() }}
    </div>
</div>
@endsection