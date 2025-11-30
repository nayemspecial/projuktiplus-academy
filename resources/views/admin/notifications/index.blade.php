@extends('layouts.admin')

@section('title', 'নোটিফিকেশন - ProjuktiPlus LMS Admin')

@section('header', 'সকল নোটিফিকেশন')

@section('actions')
    @if($notifications->count() > 0)
    <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST">
        @csrf
        <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none transition-colors">
            <i class="fas fa-check-double mr-2 text-blue-600"></i> সব পড়া হয়েছে
        </button>
    </form>
    @endif
@endsection

@section('admin-content')
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
    <div class="divide-y divide-gray-200 dark:divide-slate-700">
        @forelse($notifications as $notification)
            <div class="group p-4 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition duration-150 ease-in-out {{ !$notification->is_read ? 'bg-blue-50/40 dark:bg-blue-900/20' : '' }}">
                <div class="flex items-start space-x-4">
                    
                    <!-- Icon -->
                    <div class="flex-shrink-0 mt-1">
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
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <a href="{{ route('admin.notifications.show', $notification->id) }}" class="block focus:outline-none">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    {{ $notification->title }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                    {{ $notification->message }}
                                </p>
                            </a>
                            <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap ml-2">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>
                        
                        <div class="mt-2 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                @if(!$notification->is_read)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                                        নতুন
                                    </span>
                                @endif
                                
                                @if(!empty($notification->data) && isset($notification->data['url']))
                                    <a href="{{ route('admin.notifications.show', $notification->id) }}" class="text-xs font-medium text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                                        বিস্তারিত দেখুন <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                @endif
                            </div>

                            <!-- Delete Button (Visible on Hover) -->
                            <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition p-1" title="মুছে ফেলুন" onclick="return confirm('আপনি কি নিশ্চিত?')">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-16 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-slate-700 mb-4">
                    <i class="far fa-bell-slash text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">কোনো নোটিফিকেশন নেই</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">আপনার ইনবক্স এখন ফাঁকা।</p>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($notifications->hasPages())
        <div class="px-4 py-3 border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
@endsection