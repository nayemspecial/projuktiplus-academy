@extends('layouts.admin')

@section('title', 'কোর্স ম্যানেজমেন্ট - ProjuktiPlus LMS Admin')

@section('admin-content')
    <!-- Course Management Content -->
    <div>
        <!-- Course List Table -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">সকল কোর্স</h3>
                <div class="relative">
                    <input type="text" class="pl-8 pr-4 py-2 border border-gray-300 dark:border-slate-700 rounded-lg bg-white dark:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="কোর্স খুঁজুন..." x-model="courseSearchQuery">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                    <thead class="bg-gray-50 dark:bg-slate-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">কোর্স নাম</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-50 dark:text-gray-300 uppercase tracking-wider">ইন্সট্রাক্টর</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-50 dark:text-gray-300 uppercase tracking-wider">শিক্ষার্থী</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-50 dark:text-gray-300 uppercase tracking-wider">স্ট্যাটাস</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-50 dark:text-gray-300 uppercase tracking-wider">ক্রিয়েশন তারিখ</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-50 dark:text-gray-300 uppercase tracking-wider">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                        <template x-for="course in filteredCourses" :key="course.id">
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded" :src="course.image" :alt="course.name">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-800 dark:text-white" x-text="course.name"></div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400" x-text="course.category"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <img class="h-8 w-8 rounded-full" :src="course.instructorImage" :alt="course.instructorName">
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-800 dark:text-white" x-text="course.instructorName"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-800 dark:text-white" x-text="course.students"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" :class="{'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400': course.status === 'active', 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400': course.status === 'draft', 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400': course.status === 'archived'}" x-text="getCourseStatusText(course.status)"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400" x-text="course.createdAt"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="editCourse(course.id)" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 mr-3">এডিট</button>
                                    <button @click="confirmDeleteCourse(course.id)" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">ডিলিট</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 flex items-center justify-between">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    দেখানো হচ্ছে <span x-text="filteredCourses.length"></span> এর <span x-text="courses.length"></span> কোর্স
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 dark:border-slate-700 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700">পূর্ববর্তী</button>
                    <button class="px-3 py-1 border border-gray-300 dark:border-slate-700 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700">পরবর্তী</button>
                </div>
            </div>
        </div>
    </div>
@endsection