@extends('frontend.layouts.master')

@section('title', 'চেকআউট - ' . $course->title)

@section('content')

<section class="relative w-full py-12 lg:py-20 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300" x-data="{ paymentMethod: 'manual' }">
    
    <!-- Mesh Gradient Background -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-[500px] h-[500px] bg-blue-500/10 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-[500px] h-[500px] bg-purple-500/10 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 translate-y-1/2 animate-pulse delay-1000"></div>
        
        <!-- Grid Pattern -->
        <svg class="absolute inset-0 w-full h-full opacity-[0.03] dark:opacity-[0.05]" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="checkout-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#checkout-grid)" />
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        <!-- Header -->
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white font-heading mb-2">
                চেকআউট
            </h2>
            <p class="text-slate-600 dark:text-slate-400">আপনার এনরোলমেন্ট সম্পন্ন করতে পেমেন্ট করুন</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 max-w-6xl mx-auto">
            
            <!-- Left Column: Payment Methods -->
            <div class="lg:w-2/3">
                <div class="bg-white/80 dark:bg-slate-800/60 backdrop-blur-md rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700/50 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700/50">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <i class="far fa-credit-card text-blue-600"></i> পেমেন্ট মেথড নির্বাচন করুন
                        </h3>
                    </div>
                    
                    <div class="p-6">
                        @if($course->current_price > 0)
                            <!-- Payment Tabs -->
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-6">
                                @foreach($gateways as $gateway)
                                <label class="cursor-pointer group">
                                    <input type="radio" name="gateway" value="{{ $gateway->name }}" class="peer sr-only" 
                                           @click="paymentMethod = '{{ $gateway->name }}'" 
                                           {{ $loop->first ? 'checked' : '' }}>
                                    <div class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 peer-checked:border-blue-600 dark:peer-checked:border-blue-500 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 transition-all group-hover:border-blue-400">
                                        @if($gateway->name == 'bkash')
                                            <!-- আইকন বা লোগো -->
                                            <div class="text-pink-600 font-bold text-xl">bKash</div>
                                        @elseif($gateway->name == 'stripe')
                                            <i class="fab fa-stripe text-3xl text-blue-600"></i>
                                        @else
                                            <i class="fas fa-wallet text-2xl text-slate-600 dark:text-slate-300"></i>
                                        @endif
                                        <span class="mt-2 text-xs font-bold text-slate-700 dark:text-slate-300">{{ $gateway->title }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>

                            <!-- Manual Payment Form (Example: Bkash/Nagad) -->
                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST" class="space-y-5" x-show="paymentMethod === 'manual'">
                                @csrf
                                <input type="hidden" name="payment_method" value="manual">
                                
                                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700/50 rounded-xl p-5 text-sm text-yellow-800 dark:text-yellow-300 flex gap-3">
                                    <i class="fas fa-info-circle mt-0.5 text-lg"></i>
                                    <div>
                                        <p class="font-bold mb-1">পেমেন্ট নির্দেশনা:</p>
                                        <p class="leading-relaxed">অনুগ্রহ করে <strong>017XXXXXXXX</strong> নম্বরে সেন্ড মানি করুন। এরপর নিচের ফর্মে ট্রানজেকশন আইডি এবং আপনার নম্বর দিন।</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">আপনার মোবাইল নম্বর</label>
                                    <input type="text" name="sender_number" required placeholder="017XXXXXXXX" 
                                           class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">ট্রানজেকশন আইডি (TrxID)</label>
                                    <input type="text" name="transaction_id" required placeholder="8N7A6..." 
                                           class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm">
                                </div>

                                <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                    <i class="fas fa-check-circle"></i> পেমেন্ট নিশ্চিত করুন
                                </button>
                            </form>

                            <!-- Stripe Form (Placeholder) -->
                            <div x-show="paymentMethod === 'stripe'" class="text-center py-10 bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-dashed border-slate-300 dark:border-slate-700">
                                <i class="fas fa-credit-card text-4xl text-slate-300 mb-3"></i>
                                <p class="text-slate-500">স্ট্রাইপ পেমেন্ট ইন্টিগ্রেশন লোড হচ্ছে...</p>
                            </div>

                        @else
                            <!-- Free Course Enrollment -->
                            <div class="text-center py-10">
                                <div class="w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4 text-green-600 shadow-sm">
                                    <i class="fas fa-gift text-3xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">এটি একটি ফ্রি কোর্স!</h3>
                                <p class="text-slate-600 dark:text-slate-400 mb-8">আপনি এখনই ফ্রিতে এনরোল করে ক্লাস শুরু করতে পারেন।</p>
                                
                                <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="payment_method" value="free">
                                    <button type="submit" class="px-10 py-3.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-lg shadow-green-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 mx-auto">
                                        <i class="fas fa-play-circle"></i> এনরোল করুন (ফ্রি)
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="lg:w-1/3">
                <div class="sticky top-24">
                    <div class="bg-white dark:bg-slate-800/60 backdrop-blur-md rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700/50 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-900/50">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">অর্ডার সামারি</h3>
                        </div>
                        
                        <div class="p-6">
                            <!-- Course Info -->
                            <div class="flex gap-4 mb-6 pb-6 border-b border-slate-100 dark:border-slate-700/50">
                                <div class="w-24 h-16 rounded-lg overflow-hidden bg-slate-200 flex-shrink-0 border border-slate-200 dark:border-slate-600">
                                    <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('images/default-course.jpg') }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white line-clamp-2 leading-snug">{{ $course->title }}</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-1">
                                        <i class="fas fa-user-tie"></i> {{ $course->instructor->name }}
                                    </p>
                                </div>
                            </div>

                            <!-- Price Breakdown -->
                            <div class="space-y-3 mb-6 text-sm">
                                <div class="flex justify-between text-slate-600 dark:text-slate-400">
                                    <span>মূল প্রাইস</span>
                                    <span>৳{{ number_format($course->price) }}</span>
                                </div>
                                @if($course->discount_price)
                                <div class="flex justify-between text-green-600 dark:text-green-400 font-medium">
                                    <span>ডিসকাউন্ট</span>
                                    <span>- ৳{{ number_format($course->price - $course->discount_price) }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between text-lg font-bold text-slate-900 dark:text-white pt-4 border-t border-slate-100 dark:border-slate-700">
                                    <span>সর্বমোট</span>
                                    <span>৳{{ number_format($course->current_price) }}</span>
                                </div>
                            </div>

                            <!-- Security Badge -->
                            <div class="flex items-center justify-center gap-2 text-xs text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-900/50 p-3 rounded-lg border border-slate-100 dark:border-slate-700">
                                <i class="fas fa-lock text-green-500"></i>
                                সিকিউর পেমেন্ট এবং এনক্রিপ্টেড ডাটা
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection