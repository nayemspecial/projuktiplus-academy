@extends('layouts.admin')

@section('title', 'সকল সেকশন - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 flex flex-col md:flex-row justify-between items-center gap-3">
        <h3 class="text-lg font-medium text-gray-800 dark:text-white">সকল সেকশন</h3>
        <div class="relative">
            <a href="{{ route('admin.sections.create') }}" 
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i> নতুন সেকশন
            </a>
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">সেকশন</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">কোর্স</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">অর্ডার</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">লেসন</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">স্ট্যাটাস</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                @foreach($sections as $section)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                    <!-- সেকশন -->
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-800 dark:text-white">{{ $section->title }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ Str::limit($section->description, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    
                    <!-- কোর্স -->
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white">
                        {{ $section->course->title }}
                    </td>
                    
                    <!-- অর্ডার -->
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white">
                        {{ $section->order }}
                    </td>
                    
                    <!-- লেসন -->
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white">
                        {{ $section->total_lessons }}
                    </td>
                    
                    <!-- স্ট্যাটাস -->
                    <td class="px-4 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $section->is_published 
                                ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' 
                                : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400' }}">
                            {{ $section->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    
                    <!-- অ্যাকশন -->
                    <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-3">
                        <a href="{{ route('admin.sections.show', $section) }}" 
                           class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300" 
                           title="দেখুন">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.sections.edit', $section) }}" 
                           class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-900 dark:hover:text-yellow-300" 
                           title="এডিট">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="inline-block" 
                              onsubmit="return confirm('আপনি কি নিশ্চিত এই সেকশন ডিলিট করতে চান?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300" 
                                    title="ডিলিট">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-3 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        {{ $sections->links() }}
    </div>
</div>
@endsection