@extends('layouts.instructor')

@section('title', 'ইন্সট্রাক্টর ড্যাশবোর্ড')

@push('styles')
    <!-- Chart.js লোড করা হচ্ছে -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('instructor-content')
    <!-- Page title and actions -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">ইন্সট্রাক্টর ড্যাশবোর্ড</h2>
        <a href="{{ route('instructor.courses.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-plus mr-2"></i> নতুন কোর্স
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <!-- মোট কোর্স -->
        <div class="bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700/50 rounded-lg shadow p-6 transition">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">মোট কোর্স</p>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $stats['totalCourses'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 dark:text-green-400 text-sm font-medium">+{{ $stats['courseGrowth'] }}%</span>
                <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">গত মাস থেকে</span>
            </div>
        </div>
        
        <!-- মোট শিক্ষার্থী -->
        <div class="bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700/50 rounded-lg shadow p-6 transition">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">মোট শিক্ষার্থী</p>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $stats['totalStudents'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 dark:text-green-400 text-sm font-medium">+{{ $stats['studentGrowth'] }}%</span>
                <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">গত মাস থেকে</span>
            </div>
        </div>
        
        <!-- মোট আয় -->
        <div class="bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700/50 rounded-lg shadow p-6 transition">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                    <i class="fas fa-money-bill-wave text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">মোট আয়</p>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-white">৳{{ number_format($stats['totalEarnings']) }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 dark:text-green-400 text-sm font-medium">+{{ $stats['earningsGrowth'] }}%</span>
                <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">গত মাস থেকে</span>
            </div>
        </div>
        
        <!-- গড় রেটিং -->
        <div class="bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700/50 rounded-lg shadow p-6 transition">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400">
                    <i class="fas fa-star text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">গড় রেটিং</p>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $stats['averageRating'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 dark:text-green-400 text-sm font-medium">+{{ $stats['ratingGrowth'] }}%</span>
                <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">গত মাস থেকে</span>
            </div>
        </div>
    </div>
    
    <!-- [নতুন] Earnings Chart -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-4">
        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">আয়ের চার্ট (গত ৬ মাস)</h3>
        <div class="h-80 relative w-full">
            @if(count($dashboardChart['data']) > 0)
                <canvas id="mainEarningsChart"></canvas>
            @else
                <div class="flex h-full items-center justify-center text-gray-400 dark:text-gray-500">
                    <p>চার্ট দেখানোর জন্য পর্যাপ্ত ডেটা নেই</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Enrollments and Course Performance -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Recent Enrollments -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">সাম্প্রতিক এনরোলমেন্ট</h3>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-slate-700">
                @forelse($recentEnrollments as $enrollment)
                <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full" src="{{ $enrollment->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($enrollment->user->name) }}" alt="{{ $enrollment->user->name }}">
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $enrollment->user->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $enrollment->course->title }}</p>
                        </div>
                        <div class="ml-auto text-right">
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $enrollment->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 dark:text-gray-400 p-6 text-center">এখনো কোনো এনরোলমেন্ট হয়নি।</p>
                @endforelse
            </div>
            <div class="px-6 py-3 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 text-center">
                <a href="{{ route('instructor.students.index') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">সব শিক্ষার্থী দেখুন</a>
            </div>
        </div>
        
        <!-- Course Performance -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">কোর্স পারফরম্যান্স (টপ ৫)</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($coursePerformance as $course)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-800 dark:text-white">{{ $course->title }}</span>
                            <span class="text-sm font-medium text-gray-800 dark:text-white">{{ $course->enrollments_count }} ছাত্র</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-2.5">
                            <div class="bg-blue-600 dark:bg-blue-500 h-2.5 rounded-full" style="width: {{ $stats['totalStudents'] > 0 ? ($course->enrollments_count / $stats['totalStudents']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center">এখনো কোনো কোর্স তৈরি হয়নি।</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // চার্ট ডেটা
            const chartData = @json($dashboardChart);
            
            const ctx = document.getElementById('mainEarningsChart');
            if (ctx && chartData.labels.length > 0) {
                const isDark = document.documentElement.classList.contains('dark');
                const textColor = isDark ? '#cbd5e1' : '#64748b';
                const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.05)';

                new Chart(ctx, {
                    type: 'bar', // আপনি চাইলে 'line' করতে পারেন
                    data: {
                        labels: chartData.labels,
                        datasets: [{
                            label: 'মাসিক আয় (৳)',
                            data: chartData.data,
                            backgroundColor: 'rgba(59, 130, 246, 0.5)', // Blue-500 with opacity
                            borderColor: '#3b82f6',
                            borderWidth: 1,
                            borderRadius: 4,
                            hoverBackgroundColor: '#2563eb'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false // ড্যাশবোর্ডে লেজেন্ড দরকার নেই
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: gridColor },
                                ticks: { color: textColor }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: textColor }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush
@endsection