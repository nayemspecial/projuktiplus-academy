@extends('layouts.admin')

@section('title', 'ইউজার প্রোফাইল')

@section('header', 'ইউজার বিস্তারিত')

@section('actions')
    <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none transition-colors mr-2">
        <i class="fas fa-edit mr-2"></i> এডিট
    </a>
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> ফিরে যান
    </a>
@endsection

@section('admin-content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Column: Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 text-center">
                <div class="relative inline-block mb-4">
                    <img class="h-32 w-32 rounded-full object-cover border-4 border-gray-100 dark:border-slate-700 mx-auto" 
                         src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random' }}" 
                         alt="{{ $user->name }}">
                    <span class="absolute bottom-2 right-2 w-5 h-5 rounded-full border-2 border-white dark:border-slate-800 {{ $user->status === 'active' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                </div>
                
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $user->email }}</p>
                
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium capitalize
                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' : 
                       ($user->role === 'instructor' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' : 
                       'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300') }}">
                    {{ $user->role }}
                </span>

                <div class="mt-6 border-t border-gray-100 dark:border-slate-700 pt-4 text-left space-y-3">
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                        <i class="fas fa-phone w-6 text-center mr-2 text-gray-400"></i>
                        {{ $user->phone ?? 'N/A' }}
                    </div>
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                        <i class="fas fa-map-marker-alt w-6 text-center mr-2 text-gray-400"></i>
                        {{ $user->address ?? 'ঠিকানা নেই' }}
                    </div>
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                        <i class="fas fa-calendar-alt w-6 text-center mr-2 text-gray-400"></i>
                        জয়েন করেছেন: {{ $user->created_at->format('d M, Y') }}
                    </div>
                </div>
            </div>

            <!-- Bio (If Exists) -->
            @if($user->bio)
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">বায়ো</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                    {{ $user->bio }}
                </p>
            </div>
            @endif
        </div>

        <!-- Right Column: Activities/Courses -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @if($user->role === 'instructor')
                    <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 mr-4">
                            <i class="fas fa-book-open text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">তৈরি করা কোর্স</p>
                            <h4 class="text-xl font-bold text-gray-800 dark:text-white">{{ $user->courses->count() ?? 0 }}</h4>
                        </div>
                    </div>
                @elseif($user->role === 'student')
                    <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 mr-4">
                            <i class="fas fa-graduation-cap text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">এনরোল করা কোর্স</p>
                            <h4 class="text-xl font-bold text-gray-800 dark:text-white">{{ $user->enrollments->count() ?? 0 }}</h4>
                        </div>
                    </div>
                @endif

                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">অ্যাক্টিভ স্ট্যাটাস</p>
                        <h4 class="text-xl font-bold text-gray-800 dark:text-white">{{ ucfirst($user->status) }}</h4>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ $user->role === 'instructor' ? 'তৈরি করা কোর্সসমূহ' : 'এনরোল করা কোর্সসমূহ' }}
                    </h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                        <thead class="bg-gray-50 dark:bg-slate-700/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">কোর্স নাম</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">তারিখ</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                            @if($user->role === 'student')
                                @forelse($user->enrollments as $enrollment)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $enrollment->course->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $enrollment->created_at->format('d M, Y') }}</td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">দেখুন</a>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">কোনো কোর্স পাওয়া যায়নি।</td></tr>
                                @endforelse
                            @elseif($user->role === 'instructor')
                                {{-- এখানে ইনস্ট্রাকটরের কোর্স লুপ হবে --}}
                                {{-- @forelse($user->courses as $course) ... @empty ... @endforelse --}}
                                <tr><td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">ডেটা লোড করার লজিক এখানে বসবে।</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection