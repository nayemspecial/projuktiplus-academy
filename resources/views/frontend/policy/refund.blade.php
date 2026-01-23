@extends('frontend.layouts.master')

@section('title', 'Refund Policy | ProjuktiPlus Academy')

@section('content')

<section class="relative pt-32 pb-20 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-slate-50 dark:from-slate-900 to-transparent z-10"></div>
        <div class="absolute top-1/4 left-0 w-[600px] h-[600px] bg-blue-500/5 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-500/5 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4 font-heading">
            Refund <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">Policy</span>
        </h1>
        
        <nav class="flex justify-center items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800 dark:text-slate-200 font-medium">Refund Policy</span>
        </nav>

        <p class="mt-6 text-sm text-slate-500 dark:text-slate-400">
            Effective Date: <span class="font-bold text-slate-700 dark:text-slate-300">{{ date('d M, Y') }}</span>
        </p>
    </div>
</section>

<section class="pb-24 mt-4 relative bg-slate-50 dark:bg-slate-900">
    <div class="container mx-auto px-4 relative z-10">
        
        <div class="mx-auto">
            <div class="bg-white/20 dark:bg-slate-800/20 backdrop-blur-xl border border-white/50 dark:border-slate-700/50 rounded-3xl p-8 md:p-12 shadow-sm space-y-10 text-slate-600 dark:text-slate-300 leading-relaxed text-start">
                
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-blue-600 pl-4">
                        1. Our "Hassle-Free" Guarantee
                    </h2>
                    <p>
                        At <strong>ProjuktiPlus Academy</strong>, we are confident in the quality of our content. We want you to learn without risk. That's why we offer a <strong>3-Day (72 Hours) Money-Back Guarantee</strong>.
                    </p>
                    <p class="mt-3">
                        If you purchase a course and feel it's not the right fit for you, simply let us know. However, to prevent abuse of the system, a few reasonable conditions apply.
                    </p>
                </div>

                <div class="bg-blue-50/50 dark:bg-blue-900/10 p-6 rounded-2xl border border-blue-100 dark:border-blue-800/50">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4 font-heading flex items-center gap-2">
                        <i class="fas fa-check-circle text-blue-600"></i> Eligibility for Refund
                    </h2>
                    <p class="mb-4 text-sm">You are eligible for a full refund if <strong>ALL</strong> of the following conditions are met:</p>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-blue-200 dark:bg-blue-800 text-blue-700 dark:text-white flex items-center justify-center text-xs font-bold shrink-0">1</span>
                            <span>The refund request is made within <strong>72 hours (3 days)</strong> of purchase.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-blue-200 dark:bg-blue-800 text-blue-700 dark:text-white flex items-center justify-center text-xs font-bold shrink-0">2</span>
                            <span>You have watched <strong>less than 5%</strong> of the course content. (Our system tracks your watch time automatically).</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-blue-200 dark:bg-blue-800 text-blue-700 dark:text-white flex items-center justify-center text-xs font-bold shrink-0">3</span>
                            <span>You have not downloaded any course materials (source codes, assets, etc.) that are marked as premium/downloadable.</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-purple-600 pl-4">
                        2. Non-Refundable Scenarios
                    </h2>
                    <p class="mb-4">We cannot offer refunds in the following cases:</p>
                    <ul class="list-disc pl-6 space-y-2 marker:text-purple-600">
                        <li>Refund requests made after 72 hours of purchase.</li>
                        <li>If you have completed more than 10% of the course.</li>
                        <li>If you have claimed or generated a Certificate for the course.</li>
                        <li>Discounted bundles or courses purchased during a "Non-Refundable" flash sale.</li>
                        <li>Account banned due to violation of our Terms & Conditions (e.g., sharing account credentials).</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-pink-600 pl-4">
                        3. How to Request a Refund
                    </h2>
                    <p>To request a refund, please email us from your registered email address.</p>
                    
                    <div class="mt-4 p-5 bg-slate-100 dark:bg-slate-900/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <ul class="space-y-2 text-sm font-mono">
                            <li><strong>Email To:</strong> support@topit24.com</li>
                            <li><strong>Subject:</strong> Refund Request - [Course Name]</li>
                            <li><strong>Body:</strong> Please include your Name, Phone Number, and Payment Transaction ID.</li>
                        </ul>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-orange-600 pl-4">
                        4. Refund Processing & Fees
                    </h2>
                    <ul class="list-disc pl-6 space-y-2 marker:text-orange-600">
                        <li><strong>Processing Time:</strong> Once approved, the refund will be processed within <strong>7-10 working days</strong>.</li>
                        <li><strong>Gateway Charges:</strong> Please note that mobile financial service providers (bKash/Nagad/Rocket) or Banks may deduct a small processing fee (approx. 2-3%) during the initial transaction. This third-party fee is non-refundable. We will refund the amount we received.</li>
                        <li><strong>Method:</strong> Refunds will be sent to the same payment method used for the purchase (e.g., if you paid via bKash, you get it back on bKash).</li>
                    </ul>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-200 dark:border-slate-700 text-center">
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Still have questions about our refund policy?
                    </p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-bold rounded-full hover:bg-slate-700 dark:hover:bg-slate-200 transition-all">
                        Contact Support
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>


@endsection
