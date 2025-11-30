@extends('layouts.admin')

@section('title', 'সার্টিফিকেট বিবরণ - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        
        <!-- Header & Actions -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
            <div>
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">সার্টিফিকেট বিবরণ</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">সার্টিফিকেট নম্বর: {{ $certificate->certificate_number }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.certificates.edit', $certificate->id) }}" 
                   class="inline-flex items-center px-3 py-1 border border-yellow-300 dark:border-yellow-600 rounded-md text-sm font-medium text-yellow-700 dark:text-yellow-300 bg-white dark:bg-slate-700 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-colors">
                    <i class="fas fa-edit mr-1"></i> এডিট
                </a>
                
                <a href="{{ route('admin.certificates.download', $certificate->id) }}" class="inline-flex items-center px-3 py-1 border border-blue-300 dark:border-blue-600 rounded-md text-sm font-medium text-blue-700 dark:text-blue-300 bg-white dark:bg-slate-700 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                    <i class="fas fa-download mr-1"></i> ডাউনলোড
                </a>

                @if($certificate->is_revoked)
                <form action="{{ route('admin.certificates.restore', $certificate->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="inline-flex items-center px-3 py-1 border border-green-300 dark:border-green-600 rounded-md text-sm font-medium text-green-700 dark:text-green-300 bg-white dark:bg-slate-700 hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors"
                            onclick="return confirm('আপনি কি নিশ্চিত এই সার্টিফিকেট পুনরুদ্ধার করতে চান?')">
                        <i class="fas fa-undo mr-1"></i> Restore
                    </button>
                </form>
                @else
                <button type="button" 
                        class="inline-flex items-center px-3 py-1 border border-red-300 dark:border-red-600 rounded-md text-sm font-medium text-red-700 dark:text-red-300 bg-white dark:bg-slate-700 hover:bg-red-50 dark:hover:bg-red-900/20 revoke-btn transition-colors"
                        data-certificate-id="{{ $certificate->id }}"
                        data-certificate-number="{{ $certificate->certificate_number }}">
                    <i class="fas fa-ban mr-1"></i> Revoke
                </button>
                @endif
            </div>
        </div>
        
        <!-- Body Content -->
        <div class="px-6 py-6 space-y-6">
            
            <!-- Certificate Header Info -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800 rounded-lg border border-blue-100 dark:border-slate-600">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $certificate->certificate_number }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        ইস্যু তারিখ: {{ $certificate->issue_date->format('d M, Y') }}
                        @if($certificate->expiry_date)
                        • মেয়াদ শেষ: {{ $certificate->expiry_date->format('d M, Y') }}
                        @endif
                    </p>
                </div>
                <div>
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                        {{ $certificate->is_revoked 
                            ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' 
                            : ($certificate->isExpired() 
                                ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' 
                                : 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400') }}">
                        {{ $certificate->is_revoked ? 'Revoked' : ($certificate->isExpired() ? 'Expired' : 'Valid') }}
                    </span>
                </div>
            </div>
            
            <!-- Verification Info -->
            <div class="bg-gray-50 dark:bg-slate-700 p-5 rounded-lg border border-gray-200 dark:border-slate-600">
                <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-shield-alt mr-2 text-blue-500"></i> যাচাইকরণ তথ্য
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">যাচাইকরণ কোড</p>
                        <div class="flex items-center">
                            <p class="text-gray-800 dark:text-white font-mono text-sm bg-white dark:bg-slate-600 px-3 py-2 rounded border border-gray-200 dark:border-slate-500 w-full">
                                {{ $certificate->verification_code }}
                            </p>
                            <button onclick="copyToClipboard('{{ $certificate->verification_code }}')" class="ml-2 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400" title="কপি করুন">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">যাচাইকরণ URL</p>
                        <p class="text-gray-800 dark:text-white text-sm bg-white dark:bg-slate-600 px-3 py-2 rounded border border-gray-200 dark:border-slate-500 break-all">
                            <!-- [FIXED] সঠিক রাউট নাম ব্যবহার করা হয়েছে -->
                            <a href="{{ route('admin.certificates.verify.code', ['code' => $certificate->verification_code]) }}" 
                               class="text-blue-600 dark:text-blue-400 hover:underline" target="_blank">
                                {{ route('admin.certificates.verify.code', ['code' => $certificate->verification_code]) }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- User Information -->
            <div class="bg-white dark:bg-slate-700 p-5 rounded-lg border border-gray-200 dark:border-slate-600">
                <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-user-graduate mr-2 text-green-500"></i> ব্যবহারকারী তথ্য
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">নাম</p>
                        <p class="text-gray-800 dark:text-white font-medium mt-1">{{ $certificate->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">ইমেইল</p>
                        <p class="text-gray-800 dark:text-white mt-1">{{ $certificate->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">ফোন</p>
                        <p class="text-gray-800 dark:text-white mt-1">{{ $certificate->user->phone ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Course Information -->
            <div class="bg-white dark:bg-slate-700 p-5 rounded-lg border border-gray-200 dark:border-slate-600">
                <h4 class="text-lg font-medium text-gray-800 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-book mr-2 text-purple-500"></i> কোর্স তথ্য
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">কোর্স নাম</p>
                        <p class="text-gray-800 dark:text-white font-medium mt-1">{{ $certificate->course->title }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">ক্যাটেগরি</p>
                        <p class="text-gray-800 dark:text-white mt-1">{{ ucfirst($certificate->course->category) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">ইনস্ট্রাক্টর</p>
                        <p class="text-gray-800 dark:text-white mt-1">{{ $certificate->course->instructor->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Revocation Details (if revoked) -->
            @if($certificate->is_revoked)
            <div class="bg-red-50 dark:bg-red-900/20 p-5 rounded-lg border border-red-200 dark:border-red-700">
                <h4 class="text-lg font-medium text-red-800 dark:text-red-300 mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2 text-red-500"></i> Revoke বিবরণ
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-red-600 dark:text-red-400">Revoke তারিখ</p>
                        <p class="text-red-800 dark:text-red-300 mt-1">{{ $certificate->revoked_at ? $certificate->revoked_at->format('d M, Y H:i') : 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-red-600 dark:text-red-400">Revoke কারণ</p>
                        <p class="text-red-800 dark:text-red-300 font-medium mt-1">{{ $certificate->revocation_reason }}</p>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Footer Actions -->
            <div class="flex justify-between items-center pt-6 border-t border-gray-200 dark:border-slate-700">
                <a href="{{ route('admin.certificates.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> তালিকায় ফিরে যান
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Revoke Modal -->
<div id="revokeModal" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 transition-opacity">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-xl rounded-lg bg-white dark:bg-slate-800 dark:border-slate-700">
        <div class="mt-3">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30 mb-4">
                <i class="fas fa-ban text-red-600 dark:text-red-400 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-center text-gray-900 dark:text-white mb-2">সার্টিফিকেট বাতিল করুন</h3>
            <p class="text-sm text-center text-gray-500 dark:text-gray-400 mb-4">
                সার্টিফিকেট নং: <span id="modalCertificateNumber" class="font-mono font-bold text-gray-800 dark:text-gray-200"></span>
            </p>
            
            <form id="revokeForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="revocation_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">বাতিলের কারণ *</label>
                    <textarea name="revocation_reason" id="revocation_reason" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 dark:bg-slate-700 dark:text-white sm:text-sm" 
                              required placeholder="কেন বাতিল করা হচ্ছে..."></textarea>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button type="button" 
                            class="px-4 py-2 bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-gray-300 rounded-md text-sm hover:bg-gray-300 dark:hover:bg-slate-600 transition"
                            onclick="document.getElementById('revokeModal').classList.add('hidden')">
                        ফিরে যান
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700 transition shadow-sm">
                        নিশ্চিত করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Copy Function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Optional: Show toast/alert
            alert('কপি করা হয়েছে!');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const revokeButtons = document.querySelectorAll('.revoke-btn');
        const revokeModal = document.getElementById('revokeModal');
        const revokeForm = document.getElementById('revokeForm');
        const modalCertNum = document.getElementById('modalCertificateNumber');
        
        revokeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const certificateId = this.getAttribute('data-certificate-id');
                const certificateNumber = this.getAttribute('data-certificate-number');
                
                // Set form action
                revokeForm.action = `/admin/certificates/${certificateId}/revoke`;
                
                // Update modal text
                modalCertNum.textContent = certificateNumber;
                
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