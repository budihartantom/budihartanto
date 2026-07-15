@extends('layouts.app')

@section('title', 'Masuk - Budi Hartanto Platform')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center py-16 relative">
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full bg-indigo-600/10 blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-md px-4 relative z-10" data-aos="zoom-in" data-aos-duration="600">
        <div class="glass rounded-3xl p-8 border border-gray-800 shadow-2xl">
            <div class="text-center mb-8">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg mx-auto mb-4">
                    <span class="text-white font-extrabold text-2xl heading-font">B</span>
                </div>
                <h2 class="text-2xl font-bold text-white heading-font">Selamat Datang Kembali</h2>
                <p class="text-gray-400 text-sm mt-2">Masuk untuk mengakses LMS dan pelacak proyek Anda</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl border border-rose-500/20 bg-rose-500/10 text-rose-400 text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <p class="flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-rose-400"></span>
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm" 
                           placeholder="nama@email.com">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400">Kata Sandi</label>
                        <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300">Lupa Sandi?</a>
                    </div>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm" 
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-300 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-800 text-indigo-500 focus:ring-indigo-500/30 bg-slate-950">
                        <span>Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-sm font-bold rounded-xl hover:scale-[1.01] active:scale-[0.99] transition-all duration-200 cursor-pointer">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-900 text-center text-sm text-gray-400">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</section>
@endsection
