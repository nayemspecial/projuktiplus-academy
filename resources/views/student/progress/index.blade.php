@extends('layouts.student')

@section('title', 'আমার অগ্রগতি - ProjuktiPlus LMS')

@section('student-content')
<div class="max-w-7xl mx-auto" x-data="{ activeTab: 'journey' }">

    <!-- 1. Header & Stats (Compact) -->
    <div class="flex flex-col md:flex-row justify-between items-end mb-6 gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-800 dark:text-white">প্রোগ্রেস ট্র্যাকার</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400">আপনার লার্নিং জার্নির বর্তমান অবস্থা</p>
        </div>
        
        <!-- Tab Buttons -->
        <div class="bg-white dark:bg-slate-800 p-1 rounded-lg border border-slate-200 dark:border-slate-700 flex shadow-sm">
            <button @click="activeTab = 'journey'" 
                    :class="activeTab === 'journey' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700'"
                    class="px-3 py-1.5 rounded-md text-xs font-bold transition-all flex items-center gap-2">
                <i class="fas fa-map-marked-alt"></i> ম্যাপ ভিউ
            </button>
            <button @click="activeTab = 'report'" 
                    :class="activeTab === 'report' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700'"
                    class="px-3 py-1.5 rounded-md text-xs font-bold transition-all flex items-center gap-2">
                <i class="fas fa-list-ul"></i> ডিটেইলস টেবিল
            </button>
        </div>
    </div>

    <!-- Quick Stats Row -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        <div class="bg-white dark:bg-slate-800 p-3 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400">
                <i class="fas fa-trophy text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 uppercase font-bold">সম্পন্ন</p>
                <h4 class="text-lg font-bold text-slate-800 dark:text-white">{{ $courseStats['completed'] }}/{{ $courseStats['total_lessons'] }}</h4>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 p-3 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-green-50 dark:bg-green-900/20 flex items-center justify-center text-green-600 dark:text-green-400">
                <i class="fas fa-fire text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 uppercase font-bold">স্ট্রিক</p>
                <h4 class="text-lg font-bold text-slate-800 dark:text-white">{{ $courseStats['current_streak'] }} দিন</h4>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 p-3 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center text-purple-600 dark:text-purple-400">
                <i class="fas fa-chart-pie text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 uppercase font-bold">অগ্রগতি</p>
                <h4 class="text-lg font-bold text-slate-800 dark:text-white">{{ $courseStats['percentage'] }}%</h4>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 p-3 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center text-orange-600 dark:text-orange-400">
                <i class="fas fa-bullseye text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] text-slate-500 uppercase font-bold">আজকের লক্ষ্য</p>
                <h4 class="text-lg font-bold text-slate-800 dark:text-white">{{ $courseStats['today_completed'] }}/{{ $courseStats['daily_goal'] }}</h4>
            </div>
        </div>
    </div>

    <!-- TAB 1: Visual Journey Map -->
    <div x-show="activeTab === 'journey'" x-transition.opacity.duration.300ms>
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-5">
            
            @if(count($lessonMap) > 0)
                <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                    @foreach($lessonMap as $lesson)
                        <div class="relative group cursor-pointer" title="{{ $lesson['title'] }}">
                            <!-- Connector Line (Optional) -->
                            @if(!$loop->last)
                                <div class="absolute top-1/2 left-full w-2 h-0.5 -translate-y-1/2 {{ $lesson['status'] == 'completed' ? 'bg-green-500' : 'bg-slate-100 dark:bg-slate-700' }} hidden md:block -z-0"></div>
                            @endif

                            <!-- Circle Node (Compact) -->
                            <div class="w-8 h-8 rounded-full flex items-center justify-center relative z-10 transition-all duration-200 border
                                {{ $lesson['status'] == 'completed' ? 'bg-green-500 border-green-500 text-white hover:scale-110' : '' }}
                                {{ $lesson['status'] == 'current' ? 'bg-white dark:bg-slate-800 border-blue-500 text-blue-500 ring-2 ring-blue-200 dark:ring-blue-900 scale-110 animate-pulse' : '' }}
                                {{ $lesson['status'] == 'locked' ? 'bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-300 dark:text-slate-600' : '' }}
                            ">
                                <!-- Icon inside Circle -->
                                @if($lesson['status'] == 'completed')
                                    <i class="fas fa-check text-[10px]"></i>
                                @elseif($lesson['type'] == 'quiz')
                                    <i class="fas fa-question text-[10px]"></i>
                                @elseif($lesson['type'] == 'assignment')
                                    <i class="fas fa-file-alt text-[10px]"></i>
                                @elseif($lesson['status'] == 'locked')
                                    <i class="fas fa-lock text-[8px]"></i>
                                @else
                                    <span class="text-[10px] font-bold">{{ $loop->iteration }}</span>
                                @endif

                                <!-- Hover Tooltip (Super Compact) -->
                                <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 w-40 bg-slate-800 text-white text-[10px] rounded p-2 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50 shadow-lg text-center invisible group-hover:visible leading-tight">
                                    <p class="font-bold truncate mb-1 text-white">{{ $lesson['title'] }}</p>
                                    <div class="flex justify-center gap-2 text-slate-300">
                                        <span><i class="far fa-clock"></i> {{ $lesson['duration'] }}</span>
                                        <span>{{ ucfirst($lesson['type']) }}</span>
                                    </div>
                                    <!-- Triangle -->
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-slate-800"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Legend -->
                <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 flex flex-wrap gap-4 text-[10px] text-slate-500 dark:text-slate-400 justify-center md:justify-start">
                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span> সম্পন্ন</span>
                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full border border-blue-500"></span> বর্তমান</span>
                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-600"></span> লকড</span>
                    <span class="flex items-center gap-1"><i class="fas fa-question-circle text-slate-400"></i> কুইজ</span>
                </div>
            @else
                <div class="text-center py-10 text-slate-400">
                    <p class="text-sm">কোনো লেসন ডাটা পাওয়া যায়নি।</p>
                </div>
            @endif
        </div>
    </div>

    <!-- PART 2: Detailed Report Table (Compact) -->
    <div x-show="activeTab === 'report'" x-transition.opacity x-cloak>
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600 dark:text-slate-300">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 text-xs uppercase font-bold text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3 w-10">#</th>
                            <th class="px-4 py-3">লেসন শিরোনাম</th>
                            <th class="px-4 py-3">কোর্স</th>
                            <th class="px-4 py-3">ধরণ</th>
                            <th class="px-4 py-3 text-center">স্ট্যাটাস</th>
                            <th class="px-4 py-3 text-right">স্কোর/সময়</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($lessonMap as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition group">
                            <td class="px-4 py-2 font-medium text-slate-400">{{ $item['id'] }}</td>
                            <td class="px-4 py-2">
                                <p class="font-semibold text-slate-700 dark:text-slate-200 truncate max-w-[200px] sm:max-w-xs" title="{{ $item['title'] }}">
                                    {{ $item['title'] }}
                                </p>
                            </td>
                            <td class="px-4 py-2 text-slate-500 truncate max-w-[150px]">{{ $item['course_title'] }}</td>
                            <td class="px-4 py-2">
                                @if($item['type'] == 'video')
                                    <span class="text-[10px] font-bold text-blue-600 bg-blue-50 dark:bg-blue-900/30 px-1.5 py-0.5 rounded border border-blue-100 dark:border-blue-800">ভিডিও</span>
                                @elseif($item['type'] == 'quiz')
                                    <span class="text-[10px] font-bold text-purple-600 bg-purple-50 dark:bg-purple-900/30 px-1.5 py-0.5 rounded border border-purple-100 dark:border-purple-800">কুইজ</span>
                                @else
                                    <span class="text-[10px] font-bold text-orange-600 bg-orange-50 dark:bg-orange-900/30 px-1.5 py-0.5 rounded border border-orange-100 dark:border-orange-800">টাস্ক</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if($item['status'] == 'completed')
                                    <i class="fas fa-check-circle text-green-500 text-sm" title="সম্পন্ন"></i>
                                @elseif($item['status'] == 'current')
                                    <i class="fas fa-spinner fa-spin text-blue-500 text-sm" title="চলমান"></i>
                                @else
                                    <i class="fas fa-lock text-slate-300 dark:text-slate-600 text-xs" title="লকড"></i>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-right font-medium">
                                @if($item['type'] == 'quiz' && $item['status'] == 'completed')
                                    <span class="{{ $item['score'] >= 8 ? 'text-green-600' : 'text-yellow-600' }}">{{ $item['score'] }}/10</span>
                                @elseif($item['type'] == 'video')
                                    <span class="text-slate-400">{{ $item['duration'] }}</span>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-400">কোনো ডাটা নেই।</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Placeholder (If needed) -->
            <div class="px-4 py-3 border-t border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 text-center text-[10px] text-slate-500">
                সব ডাটা লোড করা হয়েছে
            </div>
        </div>
    </div>
</div>
@endsection