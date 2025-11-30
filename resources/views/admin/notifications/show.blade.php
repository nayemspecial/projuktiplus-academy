@extends('layouts.admin')

@section('title', 'নোটিফিকেশন বিস্তারিত - ProjuktiPlus LMS Admin')

@section('header', 'নোটিফিকেশন বিস্তারিত')

@section('actions')
    <a href="{{ route('admin.notifications.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> ফিরে যান
    </a>
@endsection

@section('admin-content')
<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50 flex items-center justify-between">
            <div class="flex items-center gap-3">
                @if($notification->type == 'order')
                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600">
                        <i class="fas fa-shopping-cart"></i>
                    </span>
                @elseif($notification->type == 'user')
                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600">
                        <i class="fas fa-user-plus"></i>
                    </span>
                @elseif($notification->type == 'course')
                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600">
                        <i class="fas fa-book"></i>
                    </span>
                @else
                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-400">
                        <i class="fas fa-bell"></i>
                    </span>
                @endif
                
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $notification->title }}</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $notification->created_at->format('d M, Y h:i A') }} ({{ $notification->created_at->diffForHumans() }})</p>
                </div>
            </div>

            <div>
                <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-400 hover:text-red-500 transition p-2" title="মুছে ফেলুন">
                        <i class="fas fa-trash-alt text-lg"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Body -->
        <div class="p-6">
            <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                <p class="text-base leading-relaxed">
                    {{ $notification->message }}
                </p>
            </div>

            @if(!empty($notification->data))
                <div class="mt-6 bg-gray-50 dark:bg-slate-700/50 rounded-lg p-4 border border-gray-100 dark:border-slate-700">
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">অতিরিক্ত তথ্য:</h4>
                    <pre class="text-xs text-gray-600 dark:text-gray-400 overflow-x-auto">{{ json_encode($notification->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 flex justify-end">
            @if(!empty($notification->data) && isset($notification->data['url']))
                <a href="{{ $notification->data['url'] }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none transition ease-in-out duration-150">
                    লিংকে যান <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @else
                <button onclick="history.back()" class="text-gray-600 dark:text-gray-400 hover:underline text-sm">ফিরে যান</button>
            @endif
        </div>

    </div>
</div>
@endsection