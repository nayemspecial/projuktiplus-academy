@extends('layouts.admin')

@section('title', 'সকল শিক্ষার্থী')

@section('header', 'শিক্ষার্থীদের তালিকা')

@section('actions')
    <div class="flex gap-2">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none transition-colors">
            <i class="fas fa-users mr-2"></i> সকল ব্যবহারকারী
        </a>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition-colors">
            <i class="fas fa-user-plus mr-2"></i> নতুন স্টুডেন্ট
        </a>
    </div>
@endsection

@push('styles')
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 5px; height: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #475569; }
</style>
@endpush

@section('admin-content')
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden flex flex-col">
        
        <!-- Table Container -->
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                <thead class="bg-gray-50 dark:bg-slate-700/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">নাম</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ফোন</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ইমেইল</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">এনরোল্ড কোর্স</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">স্ট্যাটাস</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">জয়েন তারিখ</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($students as $student)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors duration-200">
                        <!-- Name & Avatar -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover ring-2 ring-green-100 dark:ring-green-900" 
                                         src="{{ $student->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($student->name).'&background=random' }}" 
                                         alt="{{ $student->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->name }}</div>
                                    <div class="text-xs text-gray-400">ID: {{ $student->id }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Phone -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            {{ $student->phone ?? 'N/A' }}
                        </td>

                        <!-- Email -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            {{ $student->email }}
                        </td>

                        <!-- Enrolled Courses Count -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                <i class="fas fa-book-open mr-1.5"></i> {{ $student->enrollments->count() }} টি
                            </span>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.users.status', $student->id) }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="hidden" name="status" value="{{ $student->status === 'active' ? 'inactive' : 'active' }}">
                                <button type="submit" class="relative inline-flex h-5 w-9 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 {{ $student->status === 'active' ? 'bg-green-500' : 'bg-gray-200 dark:bg-slate-600' }}" role="switch" aria-checked="{{ $student->status === 'active' }}">
                                    <span class="sr-only">স্ট্যাটাস পরিবর্তন</span>
                                    <span aria-hidden="true" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $student->status === 'active' ? 'translate-x-4' : 'translate-x-0' }}"></span>
                                </button>
                            </form>
                        </td>

                        <!-- Join Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $student->created_at->format('d M, Y') }}
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.users.show', $student->id) }}" 
                                   class="p-1.5 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-900/20 rounded hover:bg-blue-100 transition" 
                                   title="বিস্তারিত">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="{{ route('admin.users.edit', $student->id) }}" 
                                   class="p-1.5 text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 bg-yellow-50 dark:bg-yellow-900/20 rounded hover:bg-yellow-100 transition" 
                                   title="এডিট">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('admin.users.destroy', $student->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই শিক্ষার্থীকে ডিলিট করতে চান?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-1.5 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 bg-red-50 dark:bg-red-900/20 rounded hover:bg-red-100 transition" 
                                            title="ডিলিট">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-user-graduate text-gray-400 text-xl"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">কোনো শিক্ষার্থী পাওয়া যায়নি</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            {{ $students->links() }}
        </div>
    </div>
@endsection