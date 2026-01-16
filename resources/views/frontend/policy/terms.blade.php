@extends('frontend.layouts.master')

@section('title', 'Terms & Conditions | ProjuktiPlus Academy')

@section('content')

<section class="relative pt-32 pb-20 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-slate-50 dark:from-slate-900 to-transparent z-10"></div>
        <div class="absolute top-1/4 left-0 w-[600px] h-[600px] bg-blue-500/5 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-500/5 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4 font-heading">
            Terms & <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">Conditions</span>
        </h1>
        
        <nav class="flex justify-center items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800 dark:text-slate-200 font-medium">Terms of Service</span>
        </nav>

        <p class="mt-6 text-sm text-slate-500 dark:text-slate-400">
            Last Updated: <span class="font-bold text-slate-700 dark:text-slate-300">{{ date('d M, Y') }}</span>
        </p>
    </div>
</section>

<section class="pb-24 mt-4 relative bg-slate-50 dark:bg-slate-900">
    <div class="container mx-auto px-4 relative z-10">
        
        <div class="mx-auto">
            <div class="bg-white/20 dark:bg-slate-800/20 backdrop-blur-xl border border-white/50 dark:border-slate-700/50 rounded-3xl p-8 md:p-16 shadow-sm space-y-12 text-slate-600 dark:text-slate-300 leading-relaxed text-start">
                
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-blue-600 pl-4">
                        1. Introduction
                    </h2>
                    <p>
                        Welcome to <strong>ProjuktiPlus Academy</strong>! These Terms and Conditions outline the rules and regulations for the use of our Learning Management System (LMS) and Website, located at <a href="{{ url('/') }}" class="text-blue-600 hover:underline">projuktiplus.com</a>.
                    </p>
                    <p class="mt-4">
                        By accessing this website and enrolling in our courses, we assume you accept these terms and conditions. Do not continue to use ProjuktiPlus Academy if you do not agree to take all of the terms and conditions stated on this page.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-purple-600 pl-4">
                        2. User Account & Security
                    </h2>
                    <ul class="list-disc pl-6 space-y-2 marker:text-purple-600">
                        <li><strong>Account Integrity:</strong> To access our premium courses, you may be required to register an account. You must provide accurate and complete information.</li>
                        <li><strong>Confidentiality:</strong> You are responsible for maintaining the confidentiality of your account credentials (username & password).</li>
                        <li><strong>One Account Per Person:</strong> <span class="text-red-500 dark:text-red-400 font-bold">Account sharing is strictly prohibited.</span> If our system detects multiple logins from different locations/devices simultaneously that suggest sharing, your account may be permanently banned without refund.</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-pink-600 pl-4">
                        3. Intellectual Property Rights
                    </h2>
                    <p class="mb-4">
                        Unless otherwise stated, ProjuktiPlus Academy and/or its licensors own the intellectual property rights for all material on this website (videos, resources, source codes, PDFs). All intellectual property rights are reserved.
                    </p>
                    <p class="mb-2 font-bold text-slate-800 dark:text-white">You must not:</p>
                    <ul class="list-disc pl-6 space-y-2 marker:text-pink-600">
                        <li>Republish material from ProjuktiPlus Academy.</li>
                        <li>Sell, rent, or sub-license material from ProjuktiPlus Academy.</li>
                        <li>Reproduce, duplicate or copy material from ProjuktiPlus Academy.</li>
                        <li>Redistribute content from ProjuktiPlus Academy (unless content is specifically made for redistribution).</li>
                        <li>Download videos using any third-party tools (IDM, Extensions, etc.) unless a download option is provided.</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-orange-600 pl-4">
                        4. Payments & Refunds
                    </h2>
                    <p class="mb-4">
                        We offer premium courses for a fee. You agree to pay the fees associated with the courses you enroll in.
                    </p>
                    <ul class="list-disc pl-6 space-y-2 marker:text-orange-600">
                        <li><strong>Pricing:</strong> Prices are subject to change at any time, but changes will not affect prior enrollments.</li>
                        <li><strong>Refunds:</strong> We have a specific Refund Policy. Please refer to our <a href="{{ route('policy.refund') }}" class="text-blue-600 font-bold hover:underline">Refund Policy</a> page for detailed information on eligibility and processes. Generally, refunds are not provided after the specified guarantee period.</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-cyan-600 pl-4">
                        5. User Conduct
                    </h2>
                    <p>
                        We are committed to providing a safe and positive learning environment. You agree not to:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 marker:text-cyan-600 mt-2">
                        <li>Harass, threaten, or insult instructors or other students.</li>
                        <li>Post spam, advertisements, or irrelevant content in community groups.</li>
                        <li>Upload viruses or malicious code.</li>
                    </ul>
                    <p class="mt-4 text-sm bg-red-50 dark:bg-red-900/20 p-4 rounded-lg border border-red-100 dark:border-red-900/30 text-red-600 dark:text-red-400">
                        <strong>Warning:</strong> Violation of these conduct rules will result in immediate termination of your account.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-teal-600 pl-4">
                        6. Limitation of Liability
                    </h2>
                    <p>
                        The information provided by ProjuktiPlus Academy is for general informational and educational purposes only. We make no guarantees regarding specific career outcomes or earnings. Your success depends on your own effort and dedication. We shall not be held liable for any indirect, consequential, or special liability arising out of or in any way related to your use of this Website.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-indigo-600 pl-4">
                        7. Governing Law
                    </h2>
                    <p>
                        These Terms shall be governed and construed in accordance with the laws of <strong>Bangladesh</strong>, without regard to its conflict of law provisions.
                    </p>
                </div>

                <div class="mt-12 p-8 rounded-2xl bg-slate-100 dark:bg-slate-700/30 border border-slate-200 dark:border-slate-600">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                        Questions?
                    </h2>
                    <p class="mb-4 text-sm">
                        If you have any questions about our Terms and Conditions, please contact us at:
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6">
                        <a href="mailto:support@topit24.com" class="flex items-center gap-2 text-slate-700 dark:text-slate-300 font-bold hover:text-blue-600 transition-colors">
                            <i class="fas fa-envelope text-blue-600"></i> support@projuktiplus.com
                        </a>
                        <a href="tel:01909605599" class="flex items-center gap-2 text-slate-700 dark:text-slate-300 font-bold hover:text-blue-600 transition-colors">
                            <i class="fas fa-phone-alt text-blue-600"></i> +8801909605599
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection