@extends('frontend.layouts.master')

@section('title', 'Privacy Policy | ProjuktiPlus Academy')

@section('content')

<section class="relative pt-32 pb-20 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-slate-50 dark:from-slate-900 to-transparent z-10"></div>
        <div class="absolute top-1/4 left-0 w-[600px] h-[600px] bg-blue-500/5 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-500/5 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4 font-heading">
            Privacy <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">Policy</span>
        </h1>
        
        <nav class="flex justify-center items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800 dark:text-slate-200 font-medium">Privacy Policy</span>
        </nav>

        <p class="mt-6 text-sm text-slate-500 dark:text-slate-400">
            Last Updated: <span class="font-bold text-slate-700 dark:text-slate-300">{{ date('d M, Y') }}</span>
        </p>
    </div>
</section>

<section class="pb-24 mt-4 relative bg-slate-50/20 dark:bg-slate-900/20">
    <div class="container mx-auto px-4 relative z-10">
        
        <div class="mx-auto">
            <div class="bg-white/20 dark:bg-slate-800/20 backdrop-blur-xl border border-white/50 dark:border-slate-700/50 rounded-3xl p-8 md:p-16 shadow-sm space-y-12 text-slate-600 dark:text-slate-300 leading-relaxed">
                
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-blue-600 pl-4">
                        1. Introduction
                    </h2>
                    <p>
                        Welcome to <strong>ProjuktiPlus Academy</strong>. We respect your privacy and are committed to protecting your personal data. This privacy policy will inform you as to how we look after your personal data when you visit our website, enroll in our courses, and tell you about your privacy rights.
                    </p>
                    <p class="mt-4">
                        By using our services, you agree to the collection and use of information in accordance with this policy.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-purple-600 pl-4">
                        2. Information We Collect
                    </h2>
                    <p class="mb-4">We collect several different types of information for various purposes to provide and improve our service to you:</p>
                    <ul class="list-disc pl-6 space-y-2 marker:text-purple-600">
                        <li><strong>Personal Identification Information:</strong> Name, email address, phone number, etc.</li>
                        <li><strong>Account Credentials:</strong> Passwords (which are encrypted) and username.</li>
                        <li><strong>Payment Information:</strong> We may collect transaction IDs (TrxID) for verification purposes. <span class="text-red-500 dark:text-red-400 font-bold">*Note: We DO NOT store your credit card details or PINs.*</span></li>
                        <li><strong>Usage Data:</strong> Information on how the service is accessed and used (e.g., time spent on pages, course progress).</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-pink-600 pl-4">
                        3. How We Use Your Information
                    </h2>
                    <p class="mb-4">ProjuktiPlus Academy uses the collected data for various purposes:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-white/40 dark:bg-slate-900/30 border border-slate-200 dark:border-slate-700/50">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>To provide and maintain our Service (LMS Access).</span>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-white/40 dark:bg-slate-900/30 border border-slate-200 dark:border-slate-700/50">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>To notify you about changes to our Service.</span>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-white/40 dark:bg-slate-900/30 border border-slate-200 dark:border-slate-700/50">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>To provide customer support.</span>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-white/40 dark:bg-slate-900/30 border border-slate-200 dark:border-slate-700/50">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>To issue certificates upon course completion.</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-orange-600 pl-4">
                        4. Data Security
                    </h2>
                    <p>
                        The security of your data is important to us. We implement appropriate technical and organizational measures to ensure a level of security appropriate to the risk. Your password is stored in an encrypted format, and our website uses <strong>SSL (Secure Socket Layer)</strong> technology to ensure secure data transmission.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-cyan-600 pl-4">
                        5. Third-Party Disclosure
                    </h2>
                    <p>
                        We do not sell, trade, or otherwise transfer to outside parties your Personally Identifiable Information unless we provide users with advance notice. This does not include website hosting partners and other parties who assist us in operating our website, conducting our business, or serving our users, so long as those parties agree to keep this information confidential.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4 font-heading border-l-4 border-teal-600 pl-4">
                        6. Cookies
                    </h2>
                    <p>
                        We use cookies and similar tracking technologies to track the activity on our Service and hold certain information. Cookies are files with small amount of data which may include an anonymous unique identifier. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.
                    </p>
                </div>

                <div class="p-8 rounded-2xl bg-blue-50/50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-800">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                        Contact Us
                    </h2>
                    <p class="mb-4 text-sm">
                        If you have any questions about this Privacy Policy, please contact us:
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6">
                        <a href="mailto:support@topit24.com" class="flex items-center gap-2 text-blue-600 dark:text-blue-400 font-bold hover:underline">
                            <i class="fas fa-envelope"></i> support@projuktiplus.com
                        </a>
                        <a href="tel:01909605599" class="flex items-center gap-2 text-blue-600 dark:text-blue-400 font-bold hover:underline">
                            <i class="fas fa-phone-alt"></i> +8801909605599
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection