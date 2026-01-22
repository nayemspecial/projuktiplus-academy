@extends('frontend.layouts.master')

@section('title', 'চেকআউট - ' . $course->title)

@section('content')

<section class="relative w-full py-12 lg:py-20 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300" 
         x-data="{ 
             selectedMethod: 'bkash', 
             paymentNumber: '01955800853',
             methods: {
                 bkash: { name: 'bKash', color: 'bg-pink-600', hover: 'hover:border-pink-500', border: 'peer-checked:border-pink-600', text: 'text-pink-600' },
                 rocket: { name: 'Rocket', color: 'bg-purple-600', hover: 'hover:border-purple-500', border: 'peer-checked:border-purple-600', text: 'text-purple-600' },
                 nagad: { name: 'Nagad', color: 'bg-orange-600', hover: 'hover:border-orange-500', border: 'peer-checked:border-orange-600', text: 'text-orange-600' }
             }
         }">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-[500px] h-[500px] bg-blue-500/10 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-[500px] h-[500px] bg-purple-500/10 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 translate-y-1/2 animate-pulse delay-1000"></div>
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
        
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white font-heading mb-2">
                পেমেন্ট সম্পন্ন করুন
            </h2>
            <p class="text-slate-600 dark:text-slate-400">নিচে আপনার পছন্দের পেমেন্ট মাধ্যম নির্বাচন করুন</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 mx-auto">
            
            <div class="lg:w-2/3">
                <div class="bg-white/80 dark:bg-slate-800/60 backdrop-blur-md rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700/50 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <i class="far fa-credit-card text-blue-600"></i> পেমেন্ট মেথড
                        </h3>
                    </div>
                    
                    <div class="p-6">
                        @php
                            $payableAmount = $course->current_price;
                            if(session()->has('coupon') && session('coupon')['course_id'] == $course->id) {
                                $payableAmount = session('coupon')['new_total'];
                            }
                        @endphp

                        @if($payableAmount > 0)
                            
                            <div class="grid grid-cols-3 gap-4 mb-8">
                                <label class="cursor-pointer group relative">
                                    <input type="radio" name="gateway_selector" value="bkash" class="peer sr-only" x-model="selectedMethod">
                                    <div class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 peer-checked:border-pink-500 peer-checked:bg-pink-50 dark:peer-checked:bg-pink-900/10 transition-all hover:border-pink-300 h-24">
                                        <span class="text-pink-600 font-bold text-xl">bKash</span>
                                        <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity text-pink-600">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </label>

                                <label class="cursor-pointer group relative">
                                    <input type="radio" name="gateway_selector" value="rocket" class="peer sr-only" x-model="selectedMethod">
                                    <div class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 peer-checked:border-purple-500 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/10 transition-all hover:border-purple-300 h-24">
                                        <span class="text-purple-600 font-bold text-xl">Rocket</span>
                                        <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity text-purple-600">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </label>

                                <label class="cursor-pointer group relative">
                                    <input type="radio" name="gateway_selector" value="nagad" class="peer sr-only" x-model="selectedMethod">
                                    <div class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 peer-checked:border-orange-500 peer-checked:bg-orange-50 dark:peer-checked:bg-orange-900/10 transition-all hover:border-orange-300 h-24">
                                        <span class="text-orange-600 font-bold text-xl">Nagad</span>
                                        <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity text-orange-600">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="mb-8 rounded-xl p-5 border transition-colors duration-300"
                                 :class="selectedMethod === 'bkash' ? 'bg-pink-50 border-pink-200 text-pink-900 dark:bg-pink-900/20 dark:border-pink-800 dark:text-pink-100' : 
                                        (selectedMethod === 'rocket' ? 'bg-purple-50 border-purple-200 text-purple-900 dark:bg-purple-900/20 dark:border-purple-800 dark:text-purple-100' : 
                                        'bg-orange-50 border-orange-200 text-orange-900 dark:bg-orange-900/20 dark:border-orange-800 dark:text-orange-100')">
                                
                                <h4 class="font-bold text-lg mb-3 flex items-center gap-2">
                                    <i class="fas fa-info-circle"></i> 
                                    <span x-text="methods[selectedMethod].name"></span> পেমেন্ট নির্দেশনা
                                </h4>
                                
                                <ol class="list-decimal list-inside space-y-2 text-sm opacity-90">
                                    <li>আপনার <span x-text="methods[selectedMethod].name" class="font-bold"></span> অ্যাপ অথবা ডায়াল অপশনে যান।</li>
                                    <li><span class="font-bold">Send Money</span> অপশনটি সিলেক্ট করুন।</li>
                                    <li>প্রাপক নম্বর হিসেবে <span class="font-bold font-mono text-lg bg-white/50 px-2 rounded select-all cursor-pointer" @click="navigator.clipboard.writeText(paymentNumber); alert('নাম্বার কপি হয়েছে!')" title="কপি করতে ক্লিক করুন" x-text="paymentNumber"></span> দিন।</li>
                                    
                                    <li>টাকার পরিমাণ <span class="font-bold">৳{{ number_format($payableAmount) }}</span> লিখুন।</li>
                                    
                                    <li>রেফারেন্স হিসেবে আপনার <span class="font-bold">নাম</span> ব্যবহার করুন।</li>
                                    <li>পেমেন্ট সম্পন্ন হলে ট্রানজেকশন আইডি (TrxID) টি কপি করুন।</li>
                                </ol>
                            </div>

                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST" class="space-y-5">
                                @csrf
                                <input type="hidden" name="payment_method" x-model="selectedMethod">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                            যে নাম্বার থেকে টাকা পাঠিয়েছেন
                                        </label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                                                <i class="fas fa-phone-alt"></i>
                                            </span>
                                            <input type="text" name="sender_number" required placeholder="01XXXXXXXXX" 
                                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                            ট্রানজেকশন আইডি (TrxID)
                                        </label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                                                <i class="fas fa-receipt"></i>
                                            </span>
                                            <input type="text" name="transaction_id" required placeholder="8N7A6..." 
                                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm uppercase">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" 
                                        class="w-full py-4 text-white font-bold text-lg rounded-xl shadow-lg transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 mt-4"
                                        :class="selectedMethod === 'bkash' ? 'bg-pink-600 hover:bg-pink-700 shadow-pink-500/30' : 
                                               (selectedMethod === 'rocket' ? 'bg-purple-600 hover:bg-purple-700 shadow-purple-500/30' : 
                                               'bg-orange-600 hover:bg-orange-700 shadow-orange-500/30')">
                                    <i class="fas fa-check-circle"></i> 
                                    <span x-text="methods[selectedMethod].name"></span> পেমেন্ট নিশ্চিত করুন
                                </button>
                                
                                <p class="text-center text-xs text-slate-500 dark:text-slate-400 mt-2">
                                    সাবমিট করার পর অ্যাডমিন ভেরিফিকেশনের জন্য অপেক্ষা করুন। সাধারণত ৩০ মিনিটের মধ্যে কোর্স চালু হয়ে যায়।
                                </p>
                            </form>

                        @else
                            <div class="text-center py-10">
                                <div class="w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4 text-green-600 shadow-sm animate-bounce-slow">
                                    <i class="fas fa-gift text-3xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">
                                    @if($course->price > 0)
                                        অভিনন্দন! এটি এখন সম্পূর্ণ ফ্রি!
                                    @else
                                        এটি একটি ফ্রি কোর্স!
                                    @endif
                                </h3>
                                <p class="text-slate-600 dark:text-slate-400 mb-8">কোনো পেমেন্ট ছাড়াই আপনি এখনই এনরোল করে ক্লাস শুরু করতে পারেন।</p>
                                
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

            <div class="lg:w-1/3">
                <div class="sticky top-24">
                    <div class="bg-white dark:bg-slate-800/60 backdrop-blur-md rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700/50 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-900/50">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">অর্ডার সামারি</h3>
                        </div>
                        
                        <div class="p-6">
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

                            @if(!session()->has('coupon'))
                                <div class="mb-6 pb-6 border-b border-slate-100 dark:border-slate-700/50">
                                    <form action="{{ route('coupon.apply', $course->id) }}" method="POST" class="relative">
                                        @csrf
                                        <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-2">কুপন কোড আছে?</label>
                                        <div class="flex gap-2">
                                            <input type="text" name="coupon_code" placeholder="কোড লিখুন" required
                                                class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <button type="submit" class="px-4 py-2 bg-slate-800 dark:bg-slate-700 text-white text-sm font-bold rounded-lg hover:bg-slate-900 dark:hover:bg-slate-600 transition">
                                                এপ্লাই
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="mb-6 pb-6 border-b border-slate-100 dark:border-slate-700/50">
                                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-3 flex justify-between items-center">
                                        <div>
                                            <span class="block text-xs text-green-600 dark:text-green-400 font-bold">কুপন অ্যাপ্লাইড!</span>
                                            <span class="text-sm font-bold text-slate-800 dark:text-white">{{ session('coupon')['code'] }}</span>
                                        </div>
                                        <a href="{{ route('coupon.remove') }}" class="text-red-500 hover:text-red-700 text-xs font-bold bg-white dark:bg-slate-800 px-2 py-1 rounded border border-red-100 dark:border-red-900/50">
                                            <i class="fas fa-times"></i> রিমুভ
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="space-y-3 mb-6 text-sm">
                                <div class="flex justify-between text-slate-600 dark:text-slate-400">
                                    <span>মূল প্রাইস</span>
                                    <span>৳{{ number_format($course->price) }}</span>
                                </div>
                                
                                @if($course->discount_price)
                                    <div class="flex justify-between text-green-600 dark:text-green-400 font-medium">
                                        <span>রেগুলার ডিসকাউন্ট</span>
                                        <span>- ৳{{ number_format($course->price - $course->discount_price) }}</span>
                                    </div>
                                @endif

                                @if(session()->has('coupon') && session('coupon')['course_id'] == $course->id)
                                    <div class="flex justify-between text-blue-600 dark:text-blue-400 font-bold">
                                        <span>কুপন ডিসকাউন্ট</span>
                                        <span>- ৳{{ number_format(session('coupon')['discount']) }}</span>
                                    </div>
                                @endif

                                <div class="flex justify-between text-lg font-bold text-slate-900 dark:text-white pt-4 border-t border-slate-100 dark:border-slate-700">
                                    <span>সর্বমোট</span>
                                    <span>৳{{ number_format($payableAmount) }}</span>
                                </div>
                            </div>

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