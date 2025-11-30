@extends('layouts.admin')

@section('title', 'কোর্স ম্যানেজমেন্ট')

@section('header', 'কোর্স তালিকা')

@section('actions')
    <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
        <i class="fas fa-plus mr-2"></i> নতুন কোর্স
    </a>
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
                           placeholder="কোর্স, ক্যাটাগরি বা ইনস্ট্রাক্টর খুঁজুন...">
                </div>
                
                <!-- Instructor Filter -->
                <div class="w-full sm:w-48">
                    <select name="instructor" onchange="this.form.submit()" 
                            class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 dark:border-slate-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 cursor-pointer">
                        <option value="all" {{ $instructor == 'all' ? 'selected' : '' }}>সকল ইন্সট্রাক্টর</option>
                        @foreach($instructors as $inst)
                            <option value="{{ $inst->id }}" {{ $instructor == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="w-full sm:w-40">
                    <select name="status" onchange="this.form.submit()" 
                            class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 dark:border-slate-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 cursor-pointer">
                        <option value="all" {{ $status == 'all' ? 'selected' : '' }}>সকল স্ট্যাটাস</option>
                        <option value="published" {{ $status == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="draft" {{ $status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="archived" {{ $status == 'archived' ? 'selected' : '' }}>Archived</option>
                        <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Active</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                <thead class="bg-gray-50 dark:bg-slate-700/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">কোর্স</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ইনস্ট্রাক্টর</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">মূল্য</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">স্ট্যাটাস</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">তৈরি তারিখ</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($courses as $course)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors duration-200">
                        <!-- Course Info -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-16 bg-gray-100 dark:bg-slate-700 rounded-md overflow-hidden border border-gray-200 dark:border-slate-600">
                                    @if($course->thumbnail)
                                        <img class="h-full w-full object-cover" src="{{ asset('storage/'.$course->thumbnail) }}" alt="{{ $course->title }}">
                                    @else
                                        <div class="flex items-center justify-center h-full w-full text-gray-400"><i class="fas fa-image"></i></div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white line-clamp-1 w-48" title="{{ $course->title }}">{{ $course->title }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst($course->category) }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Instructor -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-6 w-6">
                                    <img class="h-6 w-6 rounded-full object-cover ring-1 ring-gray-200 dark:ring-slate-600" 
                                         src="{{ $course->instructor->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($course->instructor->name ?? 'Unknown').'&background=random' }}" 
                                         alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $course->instructor->name ?? 'Unknown' }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Price -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300 font-medium">
                            @if($course->discount_price)
                                <span class="text-red-500 line-through text-xs mr-1">৳{{ number_format($course->price) }}</span>
                                <span class="text-green-600 dark:text-green-400">৳{{ number_format($course->discount_price) }}</span>
                            @else
                                <span class="text-gray-800 dark:text-white">{{ $course->price > 0 ? '৳'.number_format($course->price) : 'ফ্রি' }}</span>
                            @endif
                        </td>

                        <!-- Status (Editable Form) -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.courses.status', $course->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()" 
                                        class="text-xs font-semibold rounded-full px-3 py-1 border-0 focus:ring-2 focus:ring-offset-1 cursor-pointer transition-colors
                                        {{ $course->status === 'published' || $course->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                                           ($course->status === 'pending' || $course->status === 'under_review' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                           'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                                    <option value="published" {{ $course->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="active" {{ $course->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="pending" {{ $course->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="under_review" {{ $course->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                    <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="archived" {{ $course->status == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </form>
                        </td>

                        <!-- Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $course->created_at->format('d M, Y') }}
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.courses.show', $course->id) }}" 
                                   class="p-1.5 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-900/20 rounded hover:bg-blue-100 transition" 
                                   title="বিস্তারিত">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="{{ route('admin.courses.edit', $course->id) }}" 
                                   class="p-1.5 text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 bg-yellow-50 dark:bg-yellow-900/20 rounded hover:bg-yellow-100 transition" 
                                   title="এডিট">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত এই কোর্সটি ডিলিট করতে চান?');" class="inline-block">
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
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-book-open text-gray-400 text-xl"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">কোনো কোর্স পাওয়া যায়নি</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            {{ $courses->links() }}
        </div>
    </div>
@endsection