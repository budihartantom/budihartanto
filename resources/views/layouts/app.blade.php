<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Budi Hartanto Platform - Tech Agency & LMS')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Tailwind CSS v4 -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js CDN -->
    <script defer src="https://unpkg.com/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Outfit', sans-serif;
            background-color: #0b0f19;
            color: #f3f4f6;
        }
        .heading-font {
            font-family: 'Outfit', sans-serif;
        }
        .glass {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white overflow-x-hidden">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 glass border-b border-gray-800 transition-all duration-300" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-18">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-300">
                            <span class="text-white font-extrabold text-xl heading-font">B</span>
                        </div>
                        <span class="font-bold text-xl tracking-tight bg-gradient-to-r from-white via-gray-200 to-indigo-400 bg-clip-text text-transparent heading-font">
                            Budi Hartanto
                        </span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}#portfolio" class="text-sm font-medium text-gray-300 hover:text-indigo-400 transition-colors duration-200">Portofolio</a>
                    <a href="{{ route('home') }}#services" class="text-sm font-medium text-gray-300 hover:text-indigo-400 transition-colors duration-200">Layanan</a>
                    <a href="{{ route('home') }}#courses" class="text-sm font-medium text-gray-300 hover:text-indigo-400 transition-colors duration-200">Kursus LMS</a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors duration-200">Dashboard</a>
                        
                        <div class="flex items-center gap-4 pl-4 border-l border-gray-800">
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold uppercase tracking-wider
                                {{ Auth::user()->role === 'admin' ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : '' }}
                                {{ Auth::user()->role === 'student' ? 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20' : '' }}
                                {{ Auth::user()->role === 'client' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : '' }}">
                                {{ Auth::user()->role }}
                            </span>
                            
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-semibold text-gray-400 hover:text-white transition-colors duration-200 cursor-pointer">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-indigo-400 transition-colors duration-200">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl hover:from-indigo-600 hover:to-purple-700 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 shadow-md shadow-indigo-500/20 cursor-pointer">
                            Mulai Belajar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-400 hover:text-white focus:outline-none cursor-pointer">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen" style="display: none;" class="md:hidden border-t border-gray-800 bg-slate-900/95">
            <div class="px-2 pt-2 pb-4 space-y-1 sm:px-3">
                <a href="{{ route('home') }}#portfolio" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-300 hover:text-white hover:bg-slate-800">Portofolio</a>
                <a href="{{ route('home') }}#services" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-300 hover:text-white hover:bg-slate-800">Layanan</a>
                <a href="{{ route('home') }}#courses" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-300 hover:text-white hover:bg-slate-800">Kursus LMS</a>
                
                @auth
                    <a href="{{ route('dashboard') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-indigo-400 hover:bg-slate-800">Dashboard ({{ Auth::user()->role }})</a>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-base font-medium text-red-400 hover:bg-slate-800 cursor-pointer">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-300 hover:bg-slate-800">Masuk</a>
                    <a href="{{ route('register') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-lg text-base font-medium text-indigo-400 hover:bg-slate-800">Daftar Sekarang</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Flash Alert Notification -->
        @if (session('success') || session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6" x-data="{ show: true }" x-show="show" x-transition>
                @if (session('success'))
                    <div class="p-4 rounded-xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-400 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-400 hover:text-emerald-300 cursor-pointer">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 rounded-xl border border-rose-500/20 bg-rose-500/10 text-rose-400 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            <span class="text-sm font-medium">{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="text-rose-400 hover:text-rose-300 cursor-pointer">&times;</button>
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-900 bg-[#070a13] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                            <span class="text-white font-extrabold text-lg heading-font">B</span>
                        </div>
                        <span class="font-bold text-lg text-white heading-font">Budi Hartanto Platform</span>
                    </div>
                    <p class="text-gray-400 text-sm max-w-sm mb-6">
                        Penyedia layanan solusi teknologi digital premium (Web/Sistem, Aplikasi Mobile) dan kursus pengembangan perangkat lunak terintegrasi.
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-sm uppercase tracking-wider mb-4 heading-font">Pintasan</h3>
                    <ul class="space-y-2.5 text-sm text-gray-400">
                        <li><a href="{{ route('home') }}#portfolio" class="hover:text-indigo-400 transition-colors">Portofolio Saya</a></li>
                        <li><a href="{{ route('home') }}#services" class="hover:text-indigo-400 transition-colors">Layanan Agensi</a></li>
                        <li><a href="{{ route('home') }}#courses" class="hover:text-indigo-400 transition-colors">Kursus Pemrograman</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-sm uppercase tracking-wider mb-4 heading-font">Hubungi Saya</h3>
                    <ul class="space-y-2.5 text-sm text-gray-400">
                        <li>Email: <a href="mailto:contact@budihartanto.com" class="hover:text-indigo-400 transition-colors">contact@budihartanto.com</a></li>
                        <li>Lokasi: Jakarta, Indonesia</li>
                        <li class="mt-4 flex gap-4">
                            <span class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-gray-800 text-indigo-400 border border-gray-700">MAMP 8889</span>
                            <span class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-gray-800 text-purple-400 border border-gray-700">Laravel 13</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-900 flex flex-col sm:flex-row items-center justify-between text-gray-500 text-xs">
                <p>&copy; 2026 Budi Hartanto Platform. All Rights Reserved.</p>
                <div class="flex gap-6 mt-4 sm:mt-0">
                    <span class="hover:text-white transition-colors">Syarat & Ketentuan</span>
                    <span class="hover:text-white transition-colors">Kebijakan Privasi</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                easing: 'ease-out-quad',
            });
        });
    </script>
</body>
</html>
