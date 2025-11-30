@extends('layouts.student')

@section('title', 'আমার নোটিফিকেশন - ProjuktiPlus LMS')

@section('student-content')
<div class="mx-auto">
    <!-- Page Header -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">আমার নোটিফিকেশন</h1>
            <p class="text-gray-600 dark:text-gray-400">আপনার সব আপডেট এবং বার্তা</p>
        </div>
        
        @if($notifications->where('is_read', false)->count() > 0)
        <form action="{{ route('student.notifications.mark-all-read') }}" method="POST">
            @csrf
            <button type="submit" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
                <i class="fas fa-check-double mr-1"></i> সব পঠিত করুন
            </button>
        </form>
        @endif
    </div>

    <!-- Notification List -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        @if($notifications->count() > 0)
            <div class="divide-y divide-gray-200 dark:divide-slate-700">
                @foreach($notifications as $notification)
                    <div class="p-4 flex items-start gap-4 transition {{ !$notification->is_read ? 'bg-blue-50 dark:bg-blue-900/10' : 'hover:bg-gray-50 dark:hover:bg-slate-700/50' }}">
                        
                        <!-- Icon -->
                        <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center {{ $notification->is_read ? 'bg-gray-100 dark:bg-slate-700' : 'bg-blue-100 dark:bg-blue-900/30' }}">
                            @php $icon = 'fas fa-bell'; @endphp
                            @if($notification->type == 'quiz_completed')
                                @php $icon = 'fas fa-clipboard-check'; @endphp
                            @elseif($notification->type == 'course_enrolled')
                                @php $icon = 'fas fa-graduation-cap'; @endphp
                            @elseif($notification->type == 'certificate_issued')
                                @php $icon = 'fas fa-award'; @endphp
                            @endif
                            <i class="{{ $icon }} text-lg {{ $notification->is_read ? 'text-gray-500' : 'text-blue-600 dark:text-blue-400' }}"></i>
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1">
                            <a href="{{ route('student.notifications.show', $notification->id) }}" class="block">
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $notification->title }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $notification->message }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </a>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex flex-col items-end gap-2">
                            <!-- Unread Dot -->
                            @if(!$notification->is_read)
                                <span class="w-3 h-3 bg-blue-500 rounded-full" title="Unread"></span>
                            @endif
                            
                            <!-- Delete Button -->
                            <form action="{{ route('student.notifications.destroy', $notification->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 dark:hover:text-red-400" title="ডিলিট" onclick="return confirm('আপনি কি এই নোটিফিকেশনটি ডিলিট করতে চান?')">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($notifications->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700">
                    {{ $notifications->links() }}
                </div>
            @endif

        @else
            <div class="text-center py-16 p-6">
                <i class="fas fa-bell-slash text-5xl text-gray-300 dark:text-slate-600 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">কোনো নোটিফিকেশন নেই</h3>
                <p class="text-gray-500 dark:text-gray-400">আপনার জন্য কোনো নতুন বার্তা বা আপডেট নেই।</p>
            </div>
        @endif
    </div>
</div>
@endsection