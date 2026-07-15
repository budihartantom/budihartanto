@extends('layouts.app')

@section('title')
    {{ $course->title }} - LMS Belajar
@endsection

@section('content')
<div class="py-8" x-data="{
    activeLessonId: {{ $activeLesson->id }},
    lessons: {{ $course->lessons->map(fn($l) => [
        'id' => $l->id,
        'title' => $l->title,
        'video_url' => $l->video_url,
        'content' => $l->content,
        'duration' => $l->duration_minutes,
        'index' => $l->order_index
    ])->toJson() }},
    currentLesson() {
        return this.lessons.find(l => l.id === this.activeLessonId) || this.lessons[0];
    },
    changeLesson(id) {
        this.activeLessonId = id;
        this.$nextTick(() => {
            if(this.$refs.videoPlayer) {
                this.$refs.videoPlayer.load();
                this.$refs.videoPlayer.play().catch(e => console.log('Autoplay blocked:', e));
            }
        });
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs & Navigation -->
        <div class="flex items-center justify-between pb-6 border-b border-gray-900 mb-8" data-aos="fade-down">
            <div class="flex items-center gap-3">
                <a href="{{ route('student.dashboard') }}" class="text-gray-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <span class="text-xs text-gray-500 uppercase tracking-widest block font-bold">LMS Kelas</span>
                    <h1 class="text-xl sm:text-2xl font-bold text-white heading-font">{{ $course->title }}</h1>
                </div>
            </div>
            <a href="{{ route('student.dashboard') }}" class="text-xs text-gray-400 hover:text-white border border-gray-800 rounded-xl px-4 py-2 hover:bg-slate-900 transition-all">
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Main Video & Content Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side: Interactive Video Player & Lesson Content (Col Span 2) -->
            <div class="lg:col-span-2 space-y-6" data-aos="fade-right">
                <!-- Premium Video Player wrapper -->
                <div class="relative aspect-video rounded-3xl overflow-hidden glass border border-gray-800 shadow-2xl bg-black">
                    <video x-ref="videoPlayer" class="w-full h-full object-contain" controls preload="auto">
                        <source :src="currentLesson().video_url" type="video/mp4">
                        Browser Anda tidak mendukung tag pemutar video HTML5.
                    </video>
                </div>

                <!-- Lesson Info Section -->
                <div class="glass p-8 rounded-3xl border border-gray-800 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold px-3 py-1 rounded bg-indigo-500/10 text-indigo-400 border border-indigo-500/20" x-text="'Materi ' + currentLesson().index">
                            Materi 1
                        </span>
                        <span class="text-xs text-gray-400 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span x-text="currentLesson().duration + ' Menit'">15 Menit</span>
                        </span>
                    </div>

                    <h2 class="text-2xl font-bold text-white heading-font" x-text="currentLesson().title">
                        Loading Title...
                    </h2>

                    <hr class="border-gray-900 my-4">

                    <p class="text-gray-300 text-sm leading-relaxed whitespace-pre-line" x-text="currentLesson().content">
                        Loading Description...
                    </p>
                </div>
            </div>

            <!-- Right Side: Chapter/Lesson List Navigation (Col Span 1) -->
            <div class="space-y-6" data-aos="fade-left" data-aos-delay="100">
                <div class="glass rounded-3xl p-6 border border-gray-800 space-y-4">
                    <h3 class="text-base font-bold text-white uppercase tracking-wider heading-font">
                        Daftar Materi Pembelajaran
                    </h3>
                    
                    <div class="space-y-3">
                        <template x-for="lesson in lessons" :key="lesson.id">
                            <button 
                                @click="changeLesson(lesson.id)"
                                :class="activeLessonId === lesson.id 
                                    ? 'bg-indigo-500/10 border-indigo-500/40 text-indigo-400' 
                                    : 'bg-slate-950/40 border-gray-800 hover:border-gray-700 text-gray-400 hover:text-white'"
                                class="w-full text-left p-4 rounded-2xl border transition-all duration-200 cursor-pointer flex items-start gap-4 group"
                            >
                                <!-- Play icon / active state indicator -->
                                <div class="w-8 h-8 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors"
                                     :class="activeLessonId === lesson.id ? 'bg-indigo-500 text-white' : 'bg-slate-900 text-gray-500 group-hover:bg-slate-800'">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>

                                <div class="flex-grow min-w-0">
                                    <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider block" x-text="'Materi ' + lesson.index"></span>
                                    <span class="text-xs font-bold block truncate mt-1" :class="activeLessonId === lesson.id ? 'text-white' : 'text-gray-300'" x-text="lesson.title"></span>
                                    <span class="text-[10px] text-gray-500 block mt-1" x-text="lesson.duration + ' Mins'"></span>
                                </div>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
