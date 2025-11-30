@extends('layouts.admin')

@section('title', 'সার্টিফিকেট এডিট')

@section('header', 'সার্টিফিকেট এডিট')

@section('actions')
    <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> ফিরে যান
    </a>
@endsection

@section('admin-content')
<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">সার্টিফিকেট তথ্য আপডেট</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-mono mt-1">{{ $certificate->certificate_number }}</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $certificate->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ ucfirst($certificate->status) }}
            </span>
        </div>
        
        <form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- User Selection -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ব্যবহারকারী</label>
                    <select name="user_id" id="user_id" class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $certificate->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <!-- Course Selection -->
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">কোর্স</label>
                    <select name="course_id" id="course_id" class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id', $certificate->course_id) == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <!-- Enrollment ID (Hidden/Readonly usually, but editable if needed) -->
            <div>
                <label for="enrollment_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">এনরোলমেন্ট আইডি</label>
                <select name="enrollment_id" id="enrollment_id" class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                     @foreach($enrollments as $enrollment)
                        <option value="{{ $enrollment->id }}" {{ old('enrollment_id', $certificate->enrollment_id) == $enrollment->id ? 'selected' : '' }}>
                            ID: {{ $enrollment->id }} - {{ $enrollment->user->name }} ({{ $enrollment->course->title }})
                        </option>
                    @endforeach
                </select>
                @error('enrollment_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Issue Date -->
                <div>
                    <label for="issue_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ইস্যু তারিখ</label>
                    <input type="date" name="issue_date" id="issue_date" value="{{ old('issue_date', $certificate->issue_date->format('Y-m-d')) }}" required 
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                    @error('issue_date') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <!-- Validity Period -->
                <div>
                    <label for="validity_period" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">মেয়াদ (মাস)</label>
                    <input type="number" name="validity_period" id="validity_period" value="{{ old('validity_period', $certificate->validity_period) }}" min="0" placeholder="0 = Lifetime" 
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                    <p class="mt-1 text-xs text-gray-500">বর্তমান মেয়াদ শেষ: {{ $certificate->expiry_date ? $certificate->expiry_date->format('d M, Y') : 'আজীবন' }}</p>
                </div>
            </div>
            
            <div class="pt-4 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-3">
                <a href="{{ route('admin.certificates.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm">বাতিল</a>
                <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i> আপডেট করুন
                </button>
            </div>
        </form>
    </div>
</div>
@endsection