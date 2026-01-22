@extends('layouts.admin')

@section('title', 'কুপন ম্যানেজমেন্ট - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                <i class="fas fa-ticket-alt text-blue-600"></i> সকল কুপন তালিকা
            </h3>
            <div class="flex gap-2">
                <a href="{{ route('admin.coupons.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> নতুন কুপন তৈরি করুন
                </a>
            </div>
        </div>
    </div>
    
    <div class="px-6 py-3 bg-gray-50 dark:bg-slate-700 border-b border-gray-200 dark:border-slate-600">
        <form method="GET" class="flex flex-col md:flex-row gap-3">
            <div class="flex-1">
                <input type="text" name="search" placeholder="কুপন কোড দিয়ে খুঁজুন..." 
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
            </div>
            <div>
                <select name="status" class="px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white">
                    <option value="">সব স্ট্যাটাস</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full md:w-auto px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-filter mr-1"></i> ফিল্টার
                </button>
            </div>
        </form>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">কোড</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ডিসকাউন্ট</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ব্যবহার (Used/Max)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">মেয়াদ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">স্ট্যাটাস</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                @forelse($coupons as $coupon)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-900 dark:text-white bg-gray-100 dark:bg-slate-700 px-2 py-1 rounded inline-block border border-gray-200 dark:border-slate-600">
                            {{ $coupon->code }}
                        </div>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                            @if($coupon->type == 'percentage')
                                {{ $coupon->value }}% ছাড়
                            @else
                                ৳{{ number_format($coupon->value) }} ছাড়
                            @endif
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Min Order: ৳{{ $coupon->min_order_amount ?? 0 }}
                        </div>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-900 dark:text-white mr-2">
                                {{ $coupon->used_count }} / {{ $coupon->max_uses ?? '∞' }}
                            </span>
                            @if($coupon->max_uses)
                                @php
                                    $percent = ($coupon->used_count / $coupon->max_uses) * 100;
                                    $color = $percent > 90 ? 'bg-red-500' : 'bg-blue-500';
                                @endphp
                                <div class="w-16 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full {{ $color }}" style="width: {{ $percent }}%"></div>
                                </div>
                            @endif
                        </div>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                        @if($coupon->valid_to)
                            <div class="{{ \Carbon\Carbon::parse($coupon->valid_to)->isPast() ? 'text-red-500 font-bold' : '' }}">
                                {{ \Carbon\Carbon::parse($coupon->valid_to)->format('d M, Y') }}
                            </div>
                        @else
                            <span class="text-green-600">আজীবন মেয়াদ</span>
                        @endif
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.coupons.toggle', $coupon->id) }}" 
                           class="px-3 py-1 rounded-full text-xs font-medium cursor-pointer transition hover:opacity-80
                           {{ $coupon->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                            {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                        </a>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-3">
                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত এই কুপনটি ডিলিট করতে চান?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                   class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors" 
                                   title="ডিলিট">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-ticket-alt text-4xl mb-3 text-gray-300"></i>
                            <p>কোনো কুপন পাওয়া যায়নি</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        {{ $coupons->links() }}
    </div>
</div>
@endsection