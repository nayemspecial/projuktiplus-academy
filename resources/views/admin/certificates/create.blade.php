@extends('layouts.admin')

@section('title', 'নতুন সার্টিফিকেট তৈরি করুন')

@section('header', 'নতুন সার্টিফিকেট ইস্যু')

@section('actions')
    <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> ফিরে যান
    </a>
@endsection

@section('admin-content')
<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">ম্যানুয়ালি সার্টিফিকেট তৈরি করুন</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">যেকোনো এনরোল্ড স্টুডেন্টের জন্য সার্টিফিকেট ইস্যু করুন।</p>
        </div>
        
        <form action="{{ route('admin.certificates.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- User Selection -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ব্যবহারকারী</label>
                    <select name="user_id" id="user_id" 
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                        <option value="">সকল ব্যবহারকারী</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <!-- Course Selection -->
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কোর্স</label>
                    <select name="course_id" id="course_id" 
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                        <option value="">সকল কোর্স</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <!-- Enrollment Selection (Filtered) -->
            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-100 dark:border-blue-800">
                <label for="enrollment_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">এনরোলমেন্ট নির্বাচন করুন <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="enrollment_id" id="enrollment_id" 
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm" 
                            required>
                        <option value="">-- প্রথমে ইউজার বা কোর্স সিলেক্ট করুন --</option>
                        @foreach($enrollments as $enrollment)
                            <option value="{{ $enrollment->id }}" 
                                    data-user-id="{{ $enrollment->user_id }}"
                                    data-course-id="{{ $enrollment->course_id }}"
                                    {{ old('enrollment_id') == $enrollment->id ? 'selected' : '' }}>
                                {{ optional($enrollment->user)->name }} - {{ optional($enrollment->course)->title }} 
                                (স্ট্যাটাস: {{ ucfirst($enrollment->status) }})
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
                <p id="no-enrollments-msg" class="mt-2 text-xs text-red-500 hidden flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i> এই ইউজার এবং কোর্সের জন্য কোনো এনরোলমেন্ট পাওয়া যায়নি।
                </p>
                @error('enrollment_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Issue Date -->
                <div>
                    <label for="issue_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ইস্যু তারিখ <span class="text-red-500">*</span></label>
                    <input type="date" name="issue_date" id="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required 
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                    @error('issue_date') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <!-- Validity Period -->
                <div>
                    <label for="validity_period" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">মেয়াদ (মাস)</label>
                    <input type="number" name="validity_period" id="validity_period" value="{{ old('validity_period') }}" min="1" placeholder="খালি রাখলে আজীবন মেয়াদ" 
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">খালি রাখলে "Lifetime" হিসেবে গণ্য হবে।</p>
                </div>
            </div>
            
            <div class="pt-4 border-t border-gray-100 dark:border-slate-700 flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-transform hover:scale-105">
                    <i class="fas fa-check-circle mr-2"></i> সার্টিফিকেট ইস্যু করুন
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userIdSelect = document.getElementById('user_id');
    const courseIdSelect = document.getElementById('course_id');
    const enrollmentIdSelect = document.getElementById('enrollment_id');
    const noEnrollmentsMsg = document.getElementById('no-enrollments-msg');
    
    // সব অপশন মেমরিতে সেভ রাখা
    const originalOptions = Array.from(enrollmentIdSelect.options).slice(1);

    function filterEnrollments() {
        const selectedUserId = userIdSelect.value;
        const selectedCourseId = courseIdSelect.value;
        
        // ড্রপডাউন ক্লিয়ার
        enrollmentIdSelect.innerHTML = '<option value="">-- এনরোলমেন্ট নির্বাচন করুন --</option>';
        
        let hasMatch = false;

        originalOptions.forEach(option => {
            const uId = option.getAttribute('data-user-id');
            const cId = option.getAttribute('data-course-id');
            
            // লজিক: যদি ইউজার/কোর্স সিলেক্ট না থাকে অথবা আইডি মিলে যায় (Loose equality check '==' for string vs int)
            const userMatch = !selectedUserId || uId == selectedUserId;
            const courseMatch = !selectedCourseId || cId == selectedCourseId;
            
            if (userMatch && courseMatch) {
                enrollmentIdSelect.appendChild(option.cloneNode(true));
                hasMatch = true;
            }
        });

        // মেসেজ দেখানো
        if (!hasMatch && (selectedUserId || selectedCourseId)) {
            noEnrollmentsMsg.classList.remove('hidden');
        } else {
            noEnrollmentsMsg.classList.add('hidden');
        }
        
        // অটো সিলেক্ট (যদি একটিই অপশন থাকে এবং সেটি ম্যাচ করে)
        if (enrollmentIdSelect.options.length === 2) {
            enrollmentIdSelect.selectedIndex = 1;
        }
    }
    
    userIdSelect.addEventListener('change', filterEnrollments);
    courseIdSelect.addEventListener('change', filterEnrollments);
    
    // প্রথম লোডে রান করা
    filterEnrollments();
});
</script>
@endpush
@endsection