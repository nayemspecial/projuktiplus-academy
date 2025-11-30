@extends('layouts.instructor')

@section('title', 'আমার আয়')

@section('instructor-content')
    <!-- Page title and Action -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">আমার আয় (Earnings)</h2>
        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-sm transition-colors">
            <i class="fas fa-hand-holding-usd mr-2"></i> টাকা উত্তোলন (Withdraw)
        </button>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        
        <!-- মোট আয় -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                    <i class="fas fa-money-bill-wave text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">সর্বমোট আয়</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">৳{{ number_format($totalEarnings, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- এই মাসের আয় -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">এই মাসের আয়</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">৳{{ number_format($thisMonthEarnings, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- মোট বিক্রয় -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400">
                    <i class="fas fa-shopping-cart text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">মোট বিক্রয় (কোর্স)</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalCoursesSold }} টি</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">আয়ের বিবরণ (Transactions)</h3>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                সর্বশেষ ২০টি লেনদেন
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                <thead class="bg-gray-50 dark:bg-slate-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">তারিখ</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">কোর্স নাম</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">শিক্ষার্থী</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">পেমেন্ট মেথড</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">মোট মূল্য</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">আপনার আয়</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($transactions as $payment)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $payment->completed_at ? $payment->completed_at->format('d M, Y') : 'N/A' }}
                            <br>
                            <span class="text-xs text-gray-400">{{ $payment->completed_at ? $payment->completed_at->format('h:i A') : '' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white" title="{{ $payment->course->title ?? 'Unknown' }}">
                                {{ \Illuminate\Support\Str::limit($payment->course->title ?? 'N/A', 30) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if(optional($payment->user)->avatar_url)
                                    <img class="h-6 w-6 rounded-full mr-2" src="{{ $payment->user->avatar_url }}" alt="">
                                @else
                                    <div class="h-6 w-6 rounded-full bg-gray-200 dark:bg-slate-600 mr-2 flex items-center justify-center text-xs">
                                        {{ substr($payment->user->name ?? 'U', 0, 1) }}
                                    </div>
                                @endif
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ $payment->user->name ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 uppercase">
                                {{ $payment->payment_gateway }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500 dark:text-gray-400">
                            ৳{{ number_format($payment->amount, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold text-green-600 dark:text-green-400">
                            +৳{{ number_format($payment->instructor_earnings, 2) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400">
                                <i class="fas fa-receipt text-4xl mb-3 opacity-50"></i>
                                <p class="text-lg font-medium">এখনো কোনো আয় হয়নি</p>
                                <p class="text-sm">আপনার কোর্স বিক্রি শুরু হলে এখানে তালিকা দেখা যাবে।</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($transactions->hasPages())
        <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
@endsection