@extends('layouts.admin')

@section('title', 'ড্যাশবোর্ড')

@section('header', 'অ্যাডমিন ড্যাশবোর্ড')

@push('styles')
<style>
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
</style>
@endpush

@section('admin-content')
    <div class="space-y-6">
        
        <!-- 1. Top Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Students -->
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center justify-between group hover:shadow-lg transition-all duration-300">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">মোট শিক্ষার্থী</p>
                    <h4 class="text-3xl font-bold text-gray-800 dark:text-white">{{ number_format($totalStudents) }}</h4>
                </div>
                <div class="p-4 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-xl group-hover:scale-110 transition-transform">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>

            <!-- Total Instructors -->
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center justify-between group hover:shadow-lg transition-all duration-300">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">ইন্সট্রাক্টর</p>
                    <h4 class="text-3xl font-bold text-gray-800 dark:text-white">{{ number_format($totalInstructors) }}</h4>
                </div>
                <div class="p-4 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-xl group-hover:scale-110 transition-transform">
                    <i class="fas fa-chalkboard-teacher text-2xl"></i>
                </div>
            </div>

            <!-- Total Courses -->
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center justify-between group hover:shadow-lg transition-all duration-300">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">মোট কোর্স</p>
                    <h4 class="text-3xl font-bold text-gray-800 dark:text-white">{{ number_format($totalCourses) }}</h4>
                </div>
                <div class="p-4 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-xl group-hover:scale-110 transition-transform">
                    <i class="fas fa-book-open text-2xl"></i>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-6 rounded-2xl shadow-lg text-white flex items-center justify-between group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div>
                    <p class="text-blue-100 font-medium mb-1">মোট আয়</p>
                    <h4 class="text-3xl font-bold">৳{{ number_format($totalRevenue) }}</h4>
                </div>
                <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                    <i class="fas fa-wallet text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- 2. Charts & Popular Courses -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Revenue Chart -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">আয়ের ওভারভিউ</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">গত ৬ মাসের পেমেন্ট রিপোর্ট</p>
                    </div>
                    <i class="fas fa-chart-line text-gray-300 dark:text-slate-600 text-2xl"></i>
                </div>
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Popular Courses List -->
            <div class="lg:col-span-1 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">জনপ্রিয় কোর্সসমূহ</h3>
                <div class="space-y-4">
                    @if(isset($popularCourses) && count($popularCourses) > 0)
                        @foreach($popularCourses as $course)
                        <div class="flex items-center gap-3 pb-3 border-b border-gray-100 dark:border-slate-700 last:border-0 last:pb-0">
                            <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-slate-700 flex-shrink-0 overflow-hidden">
                                @if($course->thumbnail)
                                    <img src="{{ asset('storage/'.$course->thumbnail) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-semibold text-gray-800 dark:text-white truncate" title="{{ $course->title }}">
                                    {{ $course->title }}
                                </h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $course->instructor->name ?? 'Unknown' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-sm font-bold text-blue-600 dark:text-blue-400">{{ $course->enrollments_count ?? 0 }}</span>
                                <span class="text-[10px] text-gray-400">ছাত্র</span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <p class="text-sm text-gray-400">কোনো ডাটা পাওয়া যায়নি</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- 3. Recent Data Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- New Users Table -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center bg-gray-50/50 dark:bg-slate-800">
                    <h3 class="font-bold text-gray-800 dark:text-white">নতুন ব্যবহারকারী</h3>
                    <a href="{{ route('admin.users.index') }}" class="text-xs font-medium text-blue-600 dark:text-blue-400 hover:underline">সব দেখুন</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                            @forelse($recentUsers as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random' }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-gray-100 dark:ring-slate-700">
                                        <div class="min-w-0">
                                            <p class="font-medium text-gray-800 dark:text-white truncate">{{ $user->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <span class="px-2.5 py-1 text-[10px] rounded-full font-semibold uppercase tracking-wide
                                        {{ $user->role == 'instructor' ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300' : 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td class="px-6 py-4 text-center text-gray-500">কোনো ব্যবহারকারী নেই</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Enrollments Table -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center bg-gray-50/50 dark:bg-slate-800">
                    <h3 class="font-bold text-gray-800 dark:text-white">সাম্প্রতিক এনরোলমেন্ট</h3>
                    <a href="{{ route('admin.enrollments.index') }}" class="text-xs font-medium text-blue-600 dark:text-blue-400 hover:underline">সব দেখুন</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                            @forelse($recentEnrollments as $enrollment)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded bg-green-50 dark:bg-green-900/20 flex items-center justify-center text-green-600 dark:text-green-400 flex-shrink-0">
                                            <i class="fas fa-graduation-cap text-xs"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-medium text-gray-800 dark:text-white truncate max-w-[180px]" title="{{ $enrollment->course->title ?? '' }}">
                                                {{ $enrollment->course->title ?? 'মুছে ফেলা কোর্স' }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $enrollment->user->name ?? 'Unknown' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <p class="text-xs text-gray-400 mb-1">{{ $enrollment->created_at->diffForHumans() }}</p>
                                    <span class="px-2 py-0.5 text-[10px] rounded font-medium
                                        {{ $enrollment->status == 'completed' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' }}">
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td class="px-6 py-4 text-center text-gray-500">কোনো এনরোলমেন্ট নেই</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    // [FIXED] Using json_encode in standard PHP tag to avoid Blade parsing errors
    const labels = {!! json_encode($chartLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!};
    const data = {!! json_encode($chartValues ?? [0, 0, 0, 0, 0, 0]) !!};

    // চার্ট কনফিগারেশন
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'মাসিক আয় (৳)',
                data: data,
                borderColor: '#4F46E5', // Primary Color
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4, // Smooth curve
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#4F46E5',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return '৳ ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(200, 200, 200, 0.1)' },
                    ticks: { 
                        color: '#9ca3af',
                        callback: function(value) { return '৳' + value; }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#9ca3af' }
                }
            }
        }
    });
});
</script>
@endpush