@extends('layouts.admin')

@section('title', 'ইউজার ম্যানেজমেন্ট')

@section('header', 'ইউজার লিস্ট')

@section('actions')
    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
        <i class="fas fa-user-plus mr-2"></i> নতুন ইউজার
    </a>
@endsection

@push('styles')
<style>
    /* কাস্টম স্ক্রলবার */
    .custom-scrollbar::-webkit-scrollbar {
        height: 8px;
        width: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #475569;
    }
</style>
@endpush

@section('admin-content')
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden flex flex-col">
        
        <!-- Filters & Search -->
        <div class="p-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50/50 dark:bg-slate-800/50">
            <form action="{{ url()->current() }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <!-- Search Box -->
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ $search ?? '' }}" 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg leading-5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out" 
                           placeholder="নাম, ইমেইল বা ফোন দিয়ে খুঁজুন...">
                </div>
                
                <!-- Role Filter -->
                <div class="w-full sm:w-48">
                    <select name="role" onchange="this.form.submit()" 
                            class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 dark:border-slate-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100">
                        <option value="all" {{ $role == 'all' ? 'selected' : '' }}>সকল রোল</option>
                        <option value="student" {{ $role == 'student' ? 'selected' : '' }}>স্টুডেন্ট</option>
                        <option value="instructor" {{ $role == 'instructor' ? 'selected' : '' }}>ইন্সট্রাক্টর</option>
                        <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>অ্যাডমিন</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Table Container with Custom Scrollbar -->
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                <thead class="bg-gray-50 dark:bg-slate-700/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">নাম</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ফোন</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ইমেইল</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">রোল</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">স্ট্যাটাস</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">জয়েন তারিখ</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors duration-200">
                        <!-- Name & Avatar -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover ring-2 ring-gray-100 dark:ring-slate-700" 
                                         src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random' }}" 
                                         alt="{{ $user->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-400">ID: {{ $user->id }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Phone -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            {{ $user->phone ?? 'N/A' }}
                        </td>

                        <!-- Email -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            {{ $user->email }}
                        </td>

                        <!-- Role -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-bold rounded-full capitalize
                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : 
                                   ($user->role === 'instructor' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' : 
                                   'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.users.status', $user->id) }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="hidden" name="status" value="{{ $user->status === 'active' ? 'inactive' : 'active' }}">
                                <button type="submit" class="relative inline-flex h-5 w-9 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 {{ $user->status === 'active' ? 'bg-green-500' : 'bg-gray-200 dark:bg-slate-600' }}" role="switch" aria-checked="{{ $user->status === 'active' }}">
                                    <span aria-hidden="true" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $user->status === 'active' ? 'translate-x-4' : 'translate-x-0' }}"></span>
                                </button>
                            </form>
                        </td>

                        <!-- Join Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $user->created_at->format('d M, Y') }}
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.users.show', $user->id) }}" 
                                   class="p-1.5 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-900/20 rounded hover:bg-blue-100 transition" 
                                   title="বিস্তারিত">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                   class="p-1.5 text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 bg-yellow-50 dark:bg-yellow-900/20 rounded hover:bg-yellow-100 transition" 
                                   title="এডিট">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ইউজারকে ডিলিট করতে চান?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-1.5 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 bg-red-50 dark:bg-red-900/20 rounded hover:bg-red-100 transition" 
                                            title="ডিলিট">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-users-slash text-gray-400 text-xl"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">কোনো ব্যবহারকারী পাওয়া যায়নি</p>
                                <p class="text-sm text-gray-400 mt-1">ভিন্ন কিওয়ার্ড দিয়ে খুঁজুন অথবা ফিল্টার রিসেট করুন।</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            {{ $users->links() }}
        </div>
    </div>
@endsection