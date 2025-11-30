<!DOCTYPE html>
@php
    use App\Models\Setting;
    
    // গ্লোবাল সেটিংস লোড
    $siteName = Setting::get('site_name', 'ProjuktiPlus LMS');
    $siteFavicon = Setting::get('site_favicon');
    $primaryColor = Setting::get('primary_color', '#4F46E5');
    
    // এসইও মেটা ডাটা
    $metaDesc = Setting::get('meta_description', 'Best LMS Platform in Bangladesh');
    $metaKeywords = Setting::get('meta_keywords', 'lms, course, education');
    $metaAuthor = Setting::get('meta_author', 'ProjuktiPlus');
    $ogImageDefault = Setting::get('og_image');
    
    // পেজ স্পেসিফিক মেটা
    $pageTitle = trim($__env->yieldContent('title'));
    $metaTitle = $pageTitle ? "$pageTitle - $siteName" : $siteName;
    $currentUrl = url()->current();
@endphp

<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- [FIX] ডার্ক মোড প্রি-লোডার স্ক্রিপ্ট (FOUC ফিক্স) --}}
    <script>
        // পেজ রেন্ডার হওয়ার আগেই চেক করে ক্লাস বসিয়ে দিবে
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    {{-- এসইও মেটা ট্যাগ --}}
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="@yield('meta_description', $metaDesc)">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="author" content="{{ $metaAuthor }}">
    <link rel="canonical" href="{{ $currentUrl }}">

    {{-- ওপেন গ্রাফ / সোশ্যাল মিডিয়া --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="@yield('meta_description', $metaDesc)">
    <meta property="og:image" content="@yield('meta_image', $ogImageDefault ? asset('storage/' . $ogImageDefault) : asset('images/default-og.jpg'))">

    {{-- ফেভিকন --}}
    @if($siteFavicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $siteFavicon) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif

    {{-- Vite Assets (CSS & JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome (Backup) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- ডাইনামিক প্রাইমারি কালার --}}
    <style>
        :root {
            --color-primary-600: {{ $primaryColor }};
        }
    </style>
    
    @stack('styles')
</head>
<body class="text-slate-600 dark:text-slate-400 transition-colors duration-300 bg-slate-50 dark:bg-slate-900 flex flex-col min-h-screen font-body antialiased"
      x-data="{ 
          darkMode: localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
          mobileMenuOpen: false 
      }"
      x-init="$watch('darkMode', val => {
          localStorage.setItem('darkMode', val);
          val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark');
      })"
>



    <!-- হেডার -->
    @include('frontend.partials.header')

    <!-- মেইন কন্টেন্ট -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ফুটার -->
    @include('frontend.partials.footer')

    <!-- কাস্টম স্ক্রিপ্ট -->
    @stack('scripts')

</body>
</html>