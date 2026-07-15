@extends('layouts.app')

@section('title', 'Budi Hartanto Platform - Tech Agency & LMS')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center justify-center pt-24 pb-16 overflow-hidden">
    <!-- Glowing background elements -->
    <div class="absolute top-1/4 left-1/4 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full bg-indigo-600/20 blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 translate-x-1/2 translate-y-1/2 w-96 h-96 rounded-full bg-purple-600/15 blur-[120px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div data-aos="fade-down" class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full border border-indigo-500/30 bg-indigo-500/5 text-indigo-400 text-sm font-semibold tracking-wide mb-6">
            <span class="w-2.5 h-2.5 rounded-full bg-indigo-500 animate-ping"></span>
            Tech Agency & LMS Platform Resmi
        </div>

        <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight heading-font mb-6 leading-tight">
            Transformasi Ide Digital & <br/>
            <span class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                Kuasai Pemrograman Modern
            </span>
        </h1>

        <p data-aos="fade-up" data-aos-delay="200" class="max-w-2xl mx-auto text-gray-400 text-lg sm:text-xl mb-10 leading-relaxed">
            Saya membantu bisnis membangun perangkat lunak premium dan membimbing talenta digital masa depan menjadi programmer andal melalui kurikulum berstandar industri.
        </p>

        <div data-aos="fade-up" data-aos-delay="300" class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="#portfolio" class="w-full sm:w-auto px-8 py-4 text-base font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl hover:from-indigo-600 hover:to-purple-700 hover:scale-[1.03] active:scale-[0.98] transition-all duration-300 shadow-xl shadow-indigo-500/25 cursor-pointer">
                Lihat Portofolio
            </a>
            <a href="#courses" class="w-full sm:w-auto px-8 py-4 text-base font-semibold text-gray-300 border border-gray-800 hover:border-gray-700 bg-slate-950/40 rounded-2xl hover:text-white hover:bg-slate-900 transition-all duration-300 cursor-pointer">
                Mulai Belajar Coding
            </a>
        </div>
    </div>
</section>

<!-- Portfolio Showcase Section -->
<section id="portfolio" class="py-24 border-t border-gray-900 bg-[#090d16]" x-data="{ activeCategory: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16">
            <div data-aos="fade-right">
                <h2 class="text-3xl sm:text-4xl font-extrabold heading-font text-white mb-4">
                    Portofolio Pekerjaan Nyata
                </h2>
                <p class="text-gray-400 max-w-xl">
                    Penerapan teknologi berstandar production-grade pada sistem berskala korporasi maupun aplikasi seluler (mobile).
                </p>
            </div>

            <!-- Interactive Filters (Alpine.js) -->
            <div data-aos="fade-left" class="flex flex-wrap items-center gap-2 mt-6 md:mt-0 p-1.5 rounded-2xl bg-slate-950 border border-gray-800/80 w-fit">
                <button @click="activeCategory = 'all'" :class="activeCategory === 'all' ? 'bg-indigo-500 text-white shadow-md' : 'text-gray-400 hover:text-white'" class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 cursor-pointer">
                    Semua
                </button>
                <button @click="activeCategory = 'web'" :class="activeCategory === 'web' ? 'bg-indigo-500 text-white shadow-md' : 'text-gray-400 hover:text-white'" class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 cursor-pointer">
                    Web/Sistem
                </button>
                <button @click="activeCategory = 'mobile'" :class="activeCategory === 'mobile' ? 'bg-indigo-500 text-white shadow-md' : 'text-gray-400 hover:text-white'" class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 cursor-pointer">
                    Aplikasi Mobile
                </button>
            </div>
        </div>

        <!-- Portfolios Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($portfolios as $portfolio)
                <div 
                    x-show="activeCategory === 'all' || activeCategory === '{{ $portfolio->category }}'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    data-aos="fade-up" 
                    data-aos-delay="{{ $loop->index * 50 }}"
                    class="glass rounded-3xl overflow-hidden hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl border border-gray-800/80 group flex flex-col h-full"
                >
                    <!-- Visual Card Thumbnail -->
                    <div class="relative overflow-hidden aspect-video">
                        <img src="{{ $portfolio->image_url ?? 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=600&auto=format&fit=crop&q=60' }}" 
                             alt="{{ $portfolio->title }}" 
                             class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#090d16] via-transparent to-transparent opacity-80"></div>
                        <span class="absolute top-4 right-4 text-xs font-semibold px-3 py-1.5 rounded-full bg-slate-950/80 backdrop-blur text-indigo-400 border border-indigo-500/20">
                            {{ $portfolio->platform }}
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-indigo-400 transition-colors duration-200 heading-font">
                            {{ $portfolio->title }}
                        </h3>
                        <p class="text-gray-400 text-sm mb-6 leading-relaxed flex-grow">
                            {{ $portfolio->description }}
                        </p>

                        <!-- Tech Badges -->
                        <div class="flex flex-wrap gap-1.5 mt-auto">
                            @foreach($portfolio->tech_stack as $tech)
                                @php
                                    $badgeStyle = 'bg-slate-900 text-gray-300 border border-gray-800';
                                    $lowTech = strtolower($tech);
                                    if (str_contains($lowTech, 'laravel')) {
                                        $badgeStyle = 'bg-gradient-to-r from-red-500/10 to-orange-500/10 text-red-400 border border-red-500/20';
                                    } elseif (str_contains($lowTech, 'flutter')) {
                                        $badgeStyle = 'bg-gradient-to-r from-cyan-500/10 to-blue-500/10 text-cyan-400 border border-cyan-500/20';
                                    } elseif (str_contains($lowTech, 'wordpress')) {
                                        $badgeStyle = 'bg-gradient-to-r from-blue-500/10 to-indigo-500/10 text-blue-400 border border-blue-500/20';
                                    } elseif (str_contains($lowTech, 'codeigniter')) {
                                        $badgeStyle = 'bg-gradient-to-r from-orange-600/10 to-red-600/10 text-orange-400 border border-orange-600/20';
                                    } elseif (str_contains($lowTech, 'node')) {
                                        $badgeStyle = 'bg-gradient-to-r from-green-500/10 to-emerald-500/10 text-emerald-400 border border-green-500/20';
                                    } elseif (str_contains($lowTech, 'react') || str_contains($lowTech, 'expo')) {
                                        $badgeStyle = 'bg-gradient-to-r from-sky-400/10 to-blue-500/10 text-sky-400 border border-sky-400/20';
                                    }
                                @endphp
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-lg {{ $badgeStyle }}">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Web Services & Pricing Section -->
<section id="services" class="py-24 border-t border-gray-900 bg-[#070a12] relative">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full bg-purple-600/5 blur-[150px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-3xl sm:text-4xl font-extrabold heading-font text-white mb-4">
                Layanan Agensi Teknologi
            </h2>
            <p class="text-gray-400 max-w-xl mx-auto">
                Solusi rekayasa perangkat lunak ujung-ke-ujung (end-to-end) siap rilis dengan estimasi harga transparan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="glass rounded-3xl p-8 border border-gray-800 flex flex-col h-full hover:border-indigo-500/30 transition-all duration-300">
                    <h3 class="text-xl font-bold text-white mb-2 heading-font">{{ $service->package_name }}</h3>
                    <div class="mb-6 mt-4">
                        <span class="text-xs text-gray-500 uppercase tracking-wider block mb-1">Mulai dari</span>
                        <span class="text-3xl font-extrabold text-white heading-font">Rp {{ number_format($service->base_price, 0, ',', '.') }}</span>
                    </div>
                    
                    <hr class="border-gray-800 my-6">

                    <!-- Features checklist -->
                    <ul class="space-y-4 mb-8 flex-grow">
                        @foreach($service->features as $feature)
                            <li class="flex items-start gap-3 text-sm text-gray-300">
                                <svg class="w-5 h-5 text-indigo-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="#contact" class="w-full py-4 rounded-2xl text-center text-sm font-bold text-indigo-400 hover:text-white bg-indigo-500/5 hover:bg-indigo-600 border border-indigo-500/20 hover:border-indigo-500 transition-all duration-300 cursor-pointer">
                        Konsultasi Sekarang
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- LMS Courses Section -->
<section id="courses" class="py-24 border-t border-gray-900 bg-[#090d16]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-3xl sm:text-4xl font-extrabold heading-font text-white mb-4">
                Kursus Pemrograman Terpilih
            </h2>
            <p class="text-gray-400 max-w-xl mx-auto">
                Kurikulum terstruktur dilengkapi video penjelasan berkualitas dan studi kasus nyata untuk melatih skill developer profesional.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($courses as $course)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="glass rounded-3xl overflow-hidden hover:scale-105 transition-all duration-300 border border-gray-800 flex flex-col h-full group">
                    <div class="aspect-video relative overflow-hidden">
                        <img src="{{ $course->thumbnail_url ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&auto=format&fit=crop&q=60' }}" 
                             alt="{{ $course->title }}" 
                             class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-4 right-4 text-xs font-bold px-3 py-1.5 rounded-full bg-slate-950/80 text-purple-400 border border-purple-500/30">
                            {{ $course->lessons_count }} Pelajaran
                        </span>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-white mb-3 heading-font leading-snug group-hover:text-indigo-400 transition-colors">
                            {{ $course->title }}
                        </h3>
                        <p class="text-gray-400 text-sm mb-6 leading-relaxed flex-grow">
                            {{ Str::limit($course->description, 130) }}
                        </p>
                        
                        <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-800/80">
                            <div>
                                <span class="text-[10px] text-gray-500 uppercase tracking-widest block">Biaya Belajar</span>
                                <span class="text-lg font-extrabold text-white heading-font">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                            </div>

                            @auth
                                <a href="{{ route('student.courses.show', $course->id) }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer">
                                    Akses Kelas
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer">
                                    Daftar Kelas
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact & Consultation Form -->
<section id="contact" class="py-24 border-t border-gray-900 bg-[#070a12] relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="glass rounded-3xl p-8 sm:p-12 border border-gray-800" data-aos="zoom-in">
            <div class="text-center mb-10">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white heading-font mb-3">Mulai Konsultasi Proyek Anda</h2>
                <p class="text-gray-400 text-sm">Diskusikan kebutuhan teknologi agensi Anda atau tanyakan seputar kursus LMS kami.</p>
            </div>

            <form action="#" method="GET" class="space-y-6" @submit.prevent="alert('Terima kasih! Pesan Anda telah terkirim (Simulasi).')">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Nama Lengkap</label>
                        <input type="text" required class="w-full px-4 py-3.5 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm" placeholder="Nama Anda">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Alamat Email</label>
                        <input type="email" required class="w-full px-4 py-3.5 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm" placeholder="email@domain.com">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Subjek Pesan</label>
                    <select class="w-full px-4 py-3.5 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm">
                        <option>Konsultasi Pembuatan Web / Sistem</option>
                        <option>Konsultasi Pembuatan Aplikasi Mobile</option>
                        <option>Pertanyaan Mengenai LMS / Kelas</option>
                        <option>Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Detail Pesan</label>
                    <textarea required rows="4" class="w-full px-4 py-3.5 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm" placeholder="Tuliskan ide proyek atau pertanyaan Anda di sini..."></textarea>
                </div>
                
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-sm font-bold rounded-xl hover:scale-[1.01] active:scale-[0.99] transition-all duration-200 cursor-pointer">
                    Kirim Pesan Konsultasi
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
