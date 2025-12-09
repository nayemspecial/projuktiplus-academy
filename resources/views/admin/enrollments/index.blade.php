@extends('layouts.admin')

@section('title', 'এনরোলমেন্ট ম্যানেজমেন্ট')
@section('header', 'এনরোলমেন্ট রিকোয়েস্ট')

@section('admin-content')
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden flex flex-col">
    
    <!-- Filters & Search -->
    <div class="p-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50/50 dark:bg-slate-800/50 flex flex-col sm:flex-row gap-4 justify-between items-center">
        <form action="{{ route('admin.enrollments.index') }}" method="GET" class="flex flex-1 w-full gap-4">
            
            <!-- Search -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm" 
                       placeholder="নাম, ইমেইল, বা TrxID দিয়ে খুঁজুন...">
            </div>
            
            <!-- Status Filter -->
            <div class="w-full sm:w-48">
                <select name="status" onchange="this.form.submit()" 
                        class="block w-full pl-3 pr-10 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>সকল স্ট্যাটাস</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>পেন্ডিং (অপেক্ষমান)</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>অ্যাক্টিভ</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>বাতিল</option>
                </select>
            </div>
        </form>
        
        <!-- Create Button -->
        <a href="{{ route('admin.enrollments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i> ম্যানুয়াল এনরোল
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto custom-scrollbar">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
            <thead class="bg-gray-50 dark:bg-slate-700/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">স্টুডেন্ট</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">কোর্স</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">পেমেন্ট ডিটেইলস</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">স্ট্যাটাস</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                @forelse($enrollments as $enrollment)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors">
                    
                    <!-- Student Info -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 h-9 w-9">
                                <img class="h-9 w-9 rounded-full object-cover border border-gray-200 dark:border-slate-600" 
                                     src="{{ $enrollment->user->avatar_url ?? asset('images/default-avatar.png') }}" 
                                     alt="{{ $enrollment->user->name }}">
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $enrollment->user->name ?? 'Unknown' }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $enrollment->user->email }}</div>
                            </div>
                        </div>
                    </td>

                    <!-- Course Info -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 dark:text-white font-medium">
                            {{ \Illuminate\Support\Str::limit($enrollment->course->title ?? 'Deleted Course', 25) }}
                        </div>
                        <div class="text-xs text-gray-500">মূল্য: {{ $enrollment->price_paid > 0 ? '৳'.$enrollment->price_paid : 'ফ্রি' }}</div>
                    </td>

                    <!-- Payment Info (TrxID & Sender) -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($enrollment->payment)
                            <div class="flex flex-col gap-1">
                                <span class="font-mono text-xs bg-slate-100 dark:bg-slate-700 px-2 py-0.5 rounded border border-slate-200 dark:border-slate-600 text-slate-800 dark:text-slate-200 w-fit" title="Transaction ID">
                                    {{ $enrollment->payment->transaction_id }}
                                </span>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold capitalize {{ $enrollment->payment->payment_gateway == 'bkash' ? 'text-pink-600' : ($enrollment->payment->payment_gateway == 'nagad' ? 'text-orange-600' : 'text-blue-600') }}">
                                        {{ $enrollment->payment->payment_gateway }}
                                    </span>
                                    
                                    @php 
                                        $details = json_decode($enrollment->payment->payment_details); 
                                    @endphp
                                    @if(isset($details->sender_number))
                                        <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                            <i class="fas fa-phone-alt text-[10px]"></i> {{ $details->sender_number }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <span class="text-xs text-gray-400 italic">কোনো তথ্য নেই (ম্যানুয়াল/ফ্রি)</span>
                        @endif
                    </td>

                    <!-- Status -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold capitalize inline-flex items-center gap-1
                            {{ $enrollment->status == 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                               ($enrollment->status == 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                               'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400') }}">
                            
                            @if($enrollment->status == 'active') <i class="fas fa-check-circle text-[10px]"></i>
                            @elseif($enrollment->status == 'pending') <i class="fas fa-clock text-[10px]"></i>
                            @else <i class="fas fa-times-circle text-[10px]"></i>
                            @endif
                            {{ ucfirst($enrollment->status) }}
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        
                        {{-- পেন্ডিং থাকলে অ্যাপ্রুভ/রিজেক্ট বাটন দেখাবে --}}
                        @if($enrollment->status == 'pending')
                            <div class="flex justify-end gap-2">
                                <!-- Approve Button -->
                                <form action="{{ route('admin.enrollments.status', $enrollment->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে পেমেন্ট ভেরিফাই করেছেন? এটি স্টুডেন্টকে কোর্সে এক্সেস দিবে।');">
                                    @csrf
                                    <input type="hidden" name="status" value="active">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm flex items-center gap-1" title="Approve Payment">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                
                                <!-- Reject Button -->
                                <form action="{{ route('admin.enrollments.status', $enrollment->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এটি বাতিল করবেন?');">
                                    @csrf
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-2 py-1.5 rounded-lg text-xs font-bold transition border border-red-200 dark:border-red-800 dark:bg-red-900/10 dark:text-red-400 dark:hover:bg-red-900/30" title="Reject Request">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        
                        {{-- অ্যাক্টিভ বা অন্য অবস্থায় থাকলে ভিউ/ডিলিট --}}
                        @else
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.enrollments.show', $enrollment->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition" title="বিস্তারিত">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.enrollments.destroy', $enrollment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('স্থায়ীভাবে ডিলিট করবেন?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs transition" title="ডিলিট">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-3">
                                <i class="far fa-folder-open text-3xl text-slate-400"></i>
                            </div>
                            <p class="font-medium">কোনো এনরোলমেন্ট রিকোয়েস্ট পাওয়া যায়নি।</p>
                            <p class="text-xs mt-1">ফিল্টার পরিবর্তন করে আবার চেষ্টা করুন।</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($enrollments->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
        {{ $enrollments->links() }}
    </div>
    @endif
</div>
@endsection