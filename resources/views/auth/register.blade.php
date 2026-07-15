@extends('layouts.app')

@section('title', 'Daftar Akun - Budi Hartanto Platform')

@section('content')
<section class="min-h-[85vh] flex items-center justify-center py-16 relative">
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full bg-indigo-600/10 blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-md px-4 relative z-10" data-aos="zoom-in" data-aos-duration="600">
        <div class="glass rounded-3xl p-8 border border-gray-800 shadow-2xl">
            <div class="text-center mb-8">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg mx-auto mb-4">
                    <span class="text-white font-extrabold text-2xl heading-font">B</span>
                </div>
                <h2 class="text-2xl font-bold text-white heading-font">Buat Akun Baru</h2>
                <p class="text-gray-400 text-sm mt-2">Daftar sekarang untuk memulai perjalanan belajar atau agensi Anda</p>
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

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full px-4 py-3 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm" 
                           placeholder="Nama Lengkap Anda">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-3 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm" 
                           placeholder="nama@email.com">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Peran Akun (Role)</label>
                    <select name="role" required class="w-full px-4 py-3 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm">
                        <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student LMS (Mau Belajar Coding)</option>
                        <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client Agensi (Mau Pesan Aplikasi/Web)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Kata Sandi</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm" 
                           placeholder="Minimal 8 karakter">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-3 bg-slate-950/80 border border-gray-800 rounded-xl focus:border-indigo-500 focus:outline-none text-white text-sm" 
                           placeholder="Ketik ulang kata sandi">
                </div>

                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-sm font-bold rounded-xl hover:scale-[1.01] active:scale-[0.99] transition-all duration-200 cursor-pointer">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-900 text-center text-sm text-gray-400">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold">Masuk di Sini</a>
            </div>
        </div>
    </div>
</section>
@endsection
