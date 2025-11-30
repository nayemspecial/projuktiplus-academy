@extends('layouts.admin')

@section('title', 'ইমেইল টেমপ্লেট - ProjuktiPlus LMS Admin')

@section('admin-content')
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
    
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">ইমেইল টেমপ্লেট তালিকা</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">সিস্টেমের অটোমেটিক ইমেইলগুলোর কন্টেন্ট এখান থেকে পরিবর্তন করতে পারবেন।</p>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
            <thead class="bg-gray-50 dark:bg-slate-700/50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">নাম (Key)</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">সাবজেক্ট</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">স্ট্যাটাস</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                @forelse($templates as $template)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $template->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 font-mono">{{ $template->key }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-700 dark:text-gray-300">{{ Str::limit($template->subject, 30) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $template->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                            {{ $template->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.email-templates.edit', $template->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition">
                            <i class="fas fa-edit"></i> এডিট
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        কোনো টেমপ্লেট পাওয়া যায়নি।
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection