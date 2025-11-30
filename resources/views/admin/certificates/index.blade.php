@extends('layouts.admin')

@section('title', 'সার্টিফিকেট ব্যবস্থাপনা - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 flex flex-col md:flex-row justify-between items-center gap-3">
        <h3 class="text-lg font-medium text-gray-800 dark:text-white">সার্টিফিকেট তালিকা</h3>
        <div class="flex gap-2">
            <a href="{{ route('admin.certificates.templates') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600">
                <i class="fas fa-palette mr-2"></i> টেমপ্লেট
            </a>
            <a href="{{ route('admin.certificates.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i> নতুন সার্টিফিকেট
            </a>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-700 border-b border-gray-200 dark:border-slate-600">
        <form method="GET" action="{{ route('admin.certificates.index') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">খুঁজুন</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                       placeholder="সার্টিফিকেট নম্বর, ব্যবহারকারীর নাম, বা কোর্স নাম..." 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white text-sm">
            </div>
            
            <div class="w-48">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">স্ট্যাটাস</label>
                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white text-sm">
                    <option value="">সব</option>
                    <option value="valid" {{ request('status') == 'valid' ? 'selected' : '' }}>Valid</option>
                    <option value="revoked" {{ request('status') == 'revoked' ? 'selected' : '' }}>Revoked</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>
            
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                    <i class="fas fa-filter mr-1"></i> ফিল্টার
                </button>
                <a href="{{ route('admin.certificates.index') }}" class="px-4 py-2 bg-gray-300 dark:bg-slate-600 text-gray-700 dark:text-gray-300 rounded-md text-sm hover:bg-gray-400 dark:hover:bg-slate-500">
                    <i class="fas fa-times mr-1"></i> Clear
                </a>
            </div>
        </form>
    </div>
    
    <!-- Stats -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-700 border-b border-gray-200 dark:border-slate-600 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                    <i class="fas fa-certificate text-blue-600 dark:text-blue-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">মোট সার্টিফিকেট</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ App\Models\Certificate::count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-full">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Valid</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ App\Models\Certificate::valid()->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-full">
                    <i class="fas fa-ban text-red-600 dark:text-red-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Revoked</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ App\Models\Certificate::revoked()->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-slate-800 p-4 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-full">
                    <i class="fas fa-clock text-yellow-600 dark:text-yellow-400"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Expired</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ App\Models\Certificate::expired()->count() }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">সার্টিফিকেট নম্বর</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ব্যবহারকারী</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">কোর্স</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ইস্যু তারিখ</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">মেয়াদ শেষ</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">স্ট্যাটাস</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                @forelse($certificates as $certificate)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                    <!-- সার্টিফিকেট নম্বর -->
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-800 dark:text-white">
                            {{ $certificate->certificate_number }}
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            ID: {{ $certificate->id }}
                        </div>
                    </td>
                    
                    <!-- ব্যবহারকারী -->
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8">
                                <img class="h-8 w-8 rounded-full" src="{{ $certificate->user->profile_photo_url ?? asset('images/logo.jpg') }}" alt="{{ $certificate->user->name }}">
                            </div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-800 dark:text-white">
                                    {{ $certificate->user->name }}   
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $certificate->user->email }}
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <!-- কোর্স -->
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white">
                        {{ $certificate->course->title }}
                    </td>
                    
                    <!-- ইস্যু তারিখ -->
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white">
                        {{ $certificate->issue_date->format('d M, Y') }}
                    </td>
                    
                    <!-- মেয়াদ শেষ -->
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white">
                        {{ $certificate->expiry_date ? $certificate->expiry_date->format('d M, Y') : 'N/A' }}
                    </td>
                    
                    <!-- স্ট্যাটাস -->
                    <td class="px-4 py-4 whitespace-nowrap">
                        @if($certificate->is_revoked)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                            Revoked
                        </span>
                        @elseif($certificate->isExpired())
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                            Expired
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                            Valid
                        </span>
                        @endif
                    </td>
                    
                    <!-- অ্যাকশন -->
                    <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-3">
                        <a href="{{ route('admin.certificates.show', $certificate) }}" 
                           class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300" 
                           title="দেখুন">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.certificates.edit', $certificate) }}" 
                           class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-900 dark:hover:text-yellow-300" 
                           title="এডিট">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if($certificate->is_revoked)
                        <form action="{{ route('admin.certificates.restore', $certificate) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" 
                                    class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300" 
                                    title="Restore"
                                    onclick="return confirm('আপনি কি নিশ্চিত এই সার্টিফিকেট পুনরুদ্ধার করতে চান?')">
                                <i class="fas fa-undo"></i>
                            </button>
                        </form>
                        @else
                        <button type="button" 
                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 revoke-btn" 
                                title="Revoke"
                                data-certificate-id="{{ $certificate->id }}"
                                data-certificate-number="{{ $certificate->certificate_number }}">
                            <i class="fas fa-ban"></i>
                        </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                        <i class="fas fa-certificate text-3xl mb-2 text-gray-300 dark:text-slate-600"></i>
                        <p>কোন সার্টিফিকেট পাওয়া যায়নি</p>
                        <a href="{{ route('admin.certificates.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline mt-2 inline-block">
                            প্রথম সার্টিফিকেট তৈরি করুন
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($certificates->hasPages())
    <div class="px-6 py-3 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        {{ $certificates->links() }}
    </div>
    @endif
</div>

<!-- Revoke Modal -->
<div id="revokeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white dark:bg-slate-800">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">সার্টিফিকেট Revoke করুন</h3>
            
            <form id="revokeForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="revocation_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Revoke কারণ *</label>
                    <textarea name="revocation_reason" id="revocation_reason" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white" 
                              required placeholder="সার্টিফিকেট Revoke করার কারণ লিখুন..."></textarea>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button type="button" 
                            class="px-4 py-2 bg-gray-300 dark:bg-slate-600 text-gray-700 dark:text-gray-300 rounded-md text-sm hover:bg-gray-400 dark:hover:bg-slate-500"
                            onclick="document.getElementById('revokeModal').classList.add('hidden')">
                        বাতিল
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                        Revoke করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const revokeButtons = document.querySelectorAll('.revoke-btn');
    const revokeModal = document.getElementById('revokeModal');
    const revokeForm = document.getElementById('revokeForm');
    
    revokeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const certificateId = this.getAttribute('data-certificate-id');
            const certificateNumber = this.getAttribute('data-certificate-number');
            
            // Set form action
            revokeForm.action = `/admin/certificates/${certificateId}/revoke`;
            
            // Update modal title with certificate number
            const modalTitle = revokeModal.querySelector('h3');
            modalTitle.textContent = `সার্টিফিকেট Revoke করুন: ${certificateNumber}`;
            
            // Show modal
            revokeModal.classList.remove('hidden');
        });
    });
    
    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === revokeModal) {
            revokeModal.classList.add('hidden');
        }
    });
});
</script>
@endpush