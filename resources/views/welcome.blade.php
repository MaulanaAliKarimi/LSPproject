<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Portal RPL') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100 selection:bg-orange-500 selection:text-white">
    
    <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
        
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-orange-500/20 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-0 right-0 w-3/4 h-3/4 bg-orange-600/10 blur-[120px] rounded-full"></div>
        </div>

        <div class="relative z-10 w-full max-w-4xl px-6 py-12 mx-auto text-center">
            
            <div class="flex justify-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/40 ring-4 ring-orange-500/20">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
            </div>

            <span class="inline-block py-1.5 px-4 rounded-full bg-orange-100 dark:bg-orange-500/10 text-orange-600 dark:text-orange-400 text-sm font-semibold tracking-wider mb-6 border border-orange-200 dark:border-orange-500/20 shadow-sm">
                My Web System
            </span>

            <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-6">
                Selamat Datang di <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">My Web</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed">
                Selamat datang di portal ujian praktik. Sistem ini dipersiapkan untuk pengujian dan sertifikasi kompetensi pengembangan aplikasi dan perangkat lunak.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-medium transition-all shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950">
                            Masuk ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-medium transition-all shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950">
                            Sudah punya akun? Login Disini
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-gray-800 hover:border-orange-500 dark:hover:border-orange-500 hover:text-orange-500 dark:hover:text-orange-400 rounded-xl font-medium transition-all focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950">
                                Belum punya akun? Daftar disini
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

    </div>

</body>
</html>