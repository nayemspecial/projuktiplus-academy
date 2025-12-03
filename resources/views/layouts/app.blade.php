<!DOCTYPE html>
<html lang="en" x-data="appData()" x-init="init()" :class="{'dark': isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ProjuktiPlus Academy')</title>
    <!-- Tailwind CSS -->
    {{-- Vite Assets --}}
    @vite(['resources/css/tailwind.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- বাংলা ফন্ট ইম্পোর্ট -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Kohinoor+Bangla:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        slate: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617'
                        },
                        primary: {
                            500: '#6366f1',
                            600: '#4f46e5'
                        }
                    },
                    fontFamily: {
                        'heading': ['Hind Siliguri', 'sans-serif'],
                        'body': ['Kohinoor Bangla', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Kohinoor Bangla', sans-serif;
            letter-spacing: .5px;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Hind Siliguri', sans-serif;
        }
        [x-cloak] { display: none !important; }
        .sidebar:hover {
            width: 260px;
        }
        .sidebar:hover .sidebar-text {
            display: block;
        }
        .sidebar-link.active {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border-left: 3px solid #3b82f6;
        }
        .sidebar-link.active:hover {
            background-color: rgba(59, 130, 246, 0.2);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-slate-300 min-h-screen">
    @yield('content')
    
    @stack('scripts')
</body>
</html>