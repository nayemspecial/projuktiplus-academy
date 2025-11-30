@extends('layouts.admin')

@section('title', 'সার্টিফিকেট টেমপ্লেট - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 flex flex-col md:flex-row justify-between items-center gap-3">
        <h3 class="text-lg font-medium text-gray-800 dark:text-white">সার্টিফিকেট টেমপ্লেট</h3>
        <a href="{{ route('admin.certificates.templates.create') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i> নতুন টেমপ্লেট
        </a>
    </div>
    
    <!-- Stats -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-700 border-b border-gray-200 dark:border-slate-600 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                    <i class="fas fa-palette text-blue-600 dark:text-blue-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">মোট টেমপ্লেট</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $templates->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-full">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">সক্রিয় টেমপ্লেট</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $templates->where('is_active', true)->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-2 bg-gray-100 dark:bg-gray-900/30 rounded-full">
                    <i class="fas fa-times-circle text-gray-600 dark:text-gray-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">নিষ্ক্রিয় টেমপ্লেট</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $templates->where('is_active', false)->count() }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">নাম</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">বর্ণনা</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">স্ট্যাটাস</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ব্যাকগ্রাউন্ড</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">তৈরির তারিখ</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                @forelse($templates as $template)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                    <!-- নাম -->
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-800 dark:text-white">
                            {{ $template->name }}
                        </div>
                    </td>
                    
                    <!-- বর্ণনা -->
                    <td class="px-4 py-4">
                        <div class="text-sm text-gray-800 dark:text-white">
                            {{ $template->description ?? 'N/A' }}
                        </div>
                    </td>
                    
                    <!-- স্ট্যাটাস -->
                    <td class="px-4 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $template->is_active 
                                ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' 
                                : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400' }}">
                            {{ $template->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    
                    <!-- ব্যাকগ্রাউন্ড -->
                    <td class="px-4 py-4 whitespace-nowrap">
                        @if($template->background_image)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                            Yes
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400">
                            No
                        </span>
                        @endif
                    </td>
                    
                    <!-- তৈরির তারিখ -->
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white">
                        {{ $template->created_at->format('d M, Y') }}
                    </td>
                    
                    <!-- অ্যাকশন -->
                    <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-3">
                        <a href="{{ route('admin.certificates.templates.edit', $template) }}" 
                           class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-900 dark:hover:text-yellow-300" 
                           title="এডিট">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.certificates.templates.destroy', $template) }}" method="POST" class="inline-block" 
                              onsubmit="return confirm('আপনি কি নিশ্চিত এই টেমপ্লেট ডিলিট করতে চান?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300" 
                                    title="ডিলিট">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-palette text-3xl mb-2 text-gray-300 dark:text-slate-600"></i>
                        <p>কোন টেমপ্লেট পাওয়া যায়নি</p>
                        <a href="{{ route('admin.certificates.templates.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline mt-2 inline-block">
                            প্রথম টেমপ্লেট তৈরি করুন
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Template Variables Help -->
<div class="mt-6 bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
        <h3 class="text-lg font-medium text-gray-800 dark:text-white">টেমপ্লেট ভেরিয়েবল</h3>
    </div>
    <div class="px-6 py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">উপলব্ধ ভেরিয়েবল</h4>
                <div class="bg-gray-50 dark:bg-slate-700 p-4 rounded-lg">
                    <div class="space-y-2 text-sm">
                        <p><code class="bg-gray-200 dark:bg-slate-600 px-1 py-0.5 rounded">{student_name}</code> - শিক্ষার্থীর নাম</p>
                        <p><code class="bg-gray-200 dark:bg-slate-600 px-1 py-0.5 rounded">{course_name}</code> - কোর্সের নাম</p>
                        <p><code class="bg-gray-200 dark:bg-slate-600 px-1 py-0.5 rounded">{issue_date}</code> - ইস্যুর তারিখ</p>
                        <p><code class="bg-gray-200 dark:bg-slate-600 px-1 py-0.5 rounded">{certificate_number}</code> - সার্টিফিকেট নম্বর</p>
                        <p><code class="bg-gray-200 dark:bg-slate-600 px-1 py-0.5 rounded">{completion_date}</code> - সম্পূর্ণতার তারিখ</p>
                        <p><code class="bg-gray-200 dark:bg-slate-600 px-1 py-0.5 rounded">{expiry_date}</code> - মেয়াদ শেষের তারিখ</p>
                        <p><code class="bg-gray-200 dark:bg-slate-600 px-1 py-0.5 rounded">{verification_code}</code> - যাচাইকরণ কোড</p>
                    </div>
                </div>
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">HTML ব্যবহার উদাহরণ</h4>
                <div class="bg-gray-50 dark:bg-slate-700 p-4 rounded-lg font-mono text-sm">
                    <pre>&lt;div class="certificate"&gt;
    &lt;h1&gt;Certificate of Completion&lt;/h1&gt;
    &lt;p&gt;This certifies that {student_name}&lt;/p&gt;
    &lt;p&gt;has completed the course {course_name}&lt;/p&gt;
    &lt;p&gt;on {issue_date}&lt;/p&gt;
    &lt;p&gt;Certificate No: {certificate_number}&lt;/p&gt;
&lt;/div&gt;</pre>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection