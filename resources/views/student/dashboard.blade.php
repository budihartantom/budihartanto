@extends('layouts.app')

@section('title', 'Student Dashboard LMS - Budi Hartanto Platform')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-8 border-b border-gray-900 mb-10" data-aos="fade-down">
            <div>
                <h1 class="text-3xl font-extrabold text-white heading-font">LMS Kelas Belajar</h1>
                <p class="text-gray-400 mt-1">Selamat datang kembali! Pilih kelas pemrograman Anda untuk melanjutkan belajar</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <span class="text-xs px-3 py-1.5 rounded-lg bg-gray-800 text-indigo-400 border border-gray-700 font-semibold uppercase tracking-wider">
                    Siswa / Student
                </span>
            </div>
        </div>

        <!-- Available Courses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" data-aos="fade-up" data-aos-delay="100">
            @foreach($courses as $course)
                <div class="glass rounded-3xl overflow-hidden hover:scale-105 transition-all duration-300 border border-gray-800/80 flex flex-col h-full group">
                    <div class="aspect-video relative overflow-hidden">
                        <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-4 right-4 text-xs font-bold px-3 py-1.5 rounded-full bg-slate-950/80 text-indigo-400 border border-indigo-500/20">
                            {{ $course->lessons_count }} Pelajaran
                        </span>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-white mb-2 heading-font leading-snug group-hover:text-indigo-400 transition-colors">
                            {{ $course->title }}
                        </h3>
                        <p class="text-gray-400 text-xs mb-6 leading-relaxed flex-grow">
                            {{ Str::limit($course->description, 140) }}
                        </p>
                        
                        <div class="pt-6 border-t border-gray-800/80 flex items-center justify-between mt-auto">
                            <div class="text-xs text-gray-500">
                                Status: <span class="text-emerald-400 font-semibold">Tersedia</span>
                            </div>
                            <a href="{{ route('student.courses.show', $course->id) }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer">
                                Masuk Kelas
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
