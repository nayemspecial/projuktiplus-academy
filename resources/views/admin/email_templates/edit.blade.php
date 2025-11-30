@extends('layouts.admin')

@section('title', 'টেমপ্লেট এডিট')

@section('header', 'ইমেইল টেমপ্লেট এডিট')

@section('actions')
    <a href="{{ route('admin.email-templates.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> ফিরে যান
    </a>
@endsection

@section('admin-content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Edit Form -->
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">সম্পাদনা: {{ $template->name }}</h3>
            </div>
            
            <form action="{{ route('admin.email-templates.update', $template->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Subject -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল সাবজেক্ট</label>
                    <input type="text" name="subject" value="{{ old('subject', $template->subject) }}" required 
                           class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                    @error('subject') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Body -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল বডি (HTML)</label>
                    <textarea name="body" rows="10" required 
                              class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900 dark:text-white font-mono text-sm">{{ old('body', $template->body) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">HTML ট্যাগ ব্যবহার করা যাবে (যেমন &lt;p&gt;, &lt;br&gt;, &lt;strong&gt;)।</p>
                    @error('body') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $template->is_active ? 'checked' : '' }} 
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                        এই টেমপ্লেটটি সক্রিয় রাখুন
                    </label>
                </div>

                <div class="pt-4 border-t border-gray-100 dark:border-slate-700 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                        <i class="fas fa-save mr-2"></i> আপডেট করুন
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Variables Info -->
    <div class="lg:col-span-1">
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-100 dark:border-blue-800 p-5 sticky top-6">
            <h4 class="text-md font-bold text-blue-800 dark:text-blue-300 mb-3 flex items-center">
                <i class="fas fa-code mr-2"></i> ব্যবহারযোগ্য ভেরিয়েবল
            </h4>
            <p class="text-sm text-blue-700 dark:text-blue-400 mb-4">
                নিচের কোডগুলো ইমেইলের বডিতে ব্যবহার করলে তা ডাইনামিক ডাটা দিয়ে প্রতিস্থাপিত হবে।
            </p>
            
            <div class="space-y-2">
                @if($template->variables)
                    @foreach($template->variables as $variable)
                    <div class="flex items-center justify-between bg-white dark:bg-slate-800 p-2 rounded border border-blue-200 dark:border-blue-700">
                        <code class="text-sm font-mono text-red-500 dark:text-red-400">{{ $variable }}</code>
                        <button onclick="copyToClipboard('{{ $variable }}')" class="text-gray-400 hover:text-blue-600 transition" title="কপি করুন">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                    @endforeach
                @else
                    <p class="text-sm text-gray-500 italic">কোনো ভেরিয়েবল নেই</p>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // Optional: Toast notification logic here
            alert('কপি করা হয়েছে: ' + text);
        });
    }
</script>
@endpush
@endsection