@extends('layouts.admin')

@section('title', 'সকল এনরোলমেন্ট - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">সকল এনরোলমেন্ট</h3>
            <div class="relative">
                <a href="{{ route('admin.enrollments.create') }}" 
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> নতুন এনরোলমেন্ট
                </a>
            </div>
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ছাত্র</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">কোর্স</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">মূল্য</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">প্রোগ্রেস</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">স্ট্যাটাস</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">এনরোল তারিখ</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                @foreach($enrollments as $enrollment)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                    <!-- ছাত্র -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $enrollment->user->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $enrollment->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    
                    <!-- কোর্স -->
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 dark:text-white">{{ $enrollment->course->title }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $enrollment->course->instructor->name }}</div>
                    </td>
                    
                    <!-- মূল্য -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                        ৳{{ number_format($enrollment->price_paid, 2) }}
                    </td>
                    
                    <!-- প্রোগ্রেস -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-full bg-gray-200 dark:bg-slate-600 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" :style="'width: ' + {{ $enrollment->progress }} + '%'"></div>
                            </div>
                            <div class="ml-2 text-xs text-gray-500 dark:text-gray-400">{{ $enrollment->progress }}%</div>
                        </div>
                    </td>
                    
                    <!-- স্ট্যাটাস -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 rounded-full text-xs font-medium 
                            {{ $enrollment->status === 'active' 
                                ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                               ($enrollment->status === 'completed' 
                                ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' :
                               ($enrollment->status === 'cancelled' 
                                ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' :
                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400')) }}">
                            {{ $enrollment->status }}
                        </span>
                    </td>
                    
                    <!-- এনরোল তারিখ -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $enrollment->created_at->format('d M, Y') }}
                    </td>
                    
                    <!-- অ্যাকশন -->
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.enrollments.show', $enrollment) }}" 
                               class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition-colors" 
                               title="দেখুন">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.enrollments.edit', $enrollment) }}" 
                               class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-900 dark:hover:text-yellow-300 transition-colors" 
                               title="এডিট">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.enrollments.destroy', $enrollment) }}" method="POST" class="inline-block" 
                                  onsubmit="return confirm('আপনি কি নিশ্চিত এই এনরোলমেন্ট ডিলিট করতে চান?')">
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
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        {{ $enrollments->links() }}
    </div>
</div>
@endsection