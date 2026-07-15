@extends('layouts.app')

@section('title', 'Admin Dashboard - Budi Hartanto Platform')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-8 border-b border-gray-900 mb-10" data-aos="fade-down">
            <div>
                <h1 class="text-3xl font-extrabold text-white heading-font">Panel Admin</h1>
                <p class="text-gray-400 mt-1">Kelola proyek agensi client dan pantau metrik platform</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <span class="text-xs px-3 py-1.5 rounded-lg bg-gray-800 text-indigo-400 border border-gray-700 font-semibold uppercase tracking-wider">
                    Dosen / Pengajar
                </span>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12" data-aos="fade-up">
            <div class="glass p-6 rounded-2xl border border-gray-800/80">
                <span class="text-xs text-gray-500 uppercase tracking-widest block font-bold">Total Siswa</span>
                <span class="text-3xl font-extrabold text-white heading-font mt-2 block">{{ $totalStudents }}</span>
            </div>
            <div class="glass p-6 rounded-2xl border border-gray-800/80">
                <span class="text-xs text-gray-500 uppercase tracking-widest block font-bold">Total Klien</span>
                <span class="text-3xl font-extrabold text-white heading-font mt-2 block">{{ $totalClients }}</span>
            </div>
            <div class="glass p-6 rounded-2xl border border-gray-800/80">
                <span class="text-xs text-gray-500 uppercase tracking-widest block font-bold">Pendapatan Proyek (Paid)</span>
                <span class="text-3xl font-extrabold text-emerald-400 heading-font mt-2 block">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Section Tabs (Alpine.js) -->
        <div x-data="{ activeTab: 'projects' }" class="space-y-8" data-aos="fade-up" data-aos-delay="100">
            <div class="flex gap-4 border-b border-gray-900 pb-2.5">
                <button @click="activeTab = 'projects'" 
                        :class="activeTab === 'projects' ? 'text-indigo-400 border-b-2 border-indigo-400 font-bold' : 'text-gray-400 font-medium'"
                        class="pb-2 text-sm uppercase tracking-wider transition-all duration-200 cursor-pointer">
                    Pelacakan Proyek Klien
                </button>
                <button @click="activeTab = 'courses'" 
                        :class="activeTab === 'courses' ? 'text-indigo-400 border-b-2 border-indigo-400 font-bold' : 'text-gray-400 font-medium'"
                        class="pb-2 text-sm uppercase tracking-wider transition-all duration-200 cursor-pointer">
                    Daftar Kursus LMS
                </button>
            </div>

            <!-- Tab 1: Projects Tracker Manager -->
            <div x-show="activeTab === 'projects'" class="space-y-6">
                <div class="glass rounded-3xl overflow-hidden border border-gray-800">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-900 text-left">
                            <thead class="bg-slate-950/40 text-gray-400 text-xs uppercase tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Invoice / Client</th>
                                    <th class="px-6 py-4">Layanan Agensi</th>
                                    <th class="px-6 py-4">Total Biaya</th>
                                    <th class="px-6 py-4">Status Proyek / Pembayaran</th>
                                    <th class="px-6 py-4 text-right">Aksi Simpan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-900 text-sm text-gray-300">
                                @forelse($orders as $order)
                                    <tr class="hover:bg-slate-950/10">
                                        <td class="px-6 py-5">
                                            <span class="font-mono font-bold text-white block">{{ $order->invoice_number }}</span>
                                            <span class="text-xs text-gray-500 mt-1 block">{{ $order->user->name }} ({{ $order->user->email }})</span>
                                        </td>
                                        <td class="px-6 py-5 font-semibold text-white">
                                            {{ $order->webService->package_name }}
                                        </td>
                                        <td class="px-6 py-5">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </td>
                                        <!-- Interactive selectors within table -->
                                        <td class="px-6 py-5">
                                            <form id="update-form-{{ $order->id }}" action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                                                @csrf
                                                <div class="flex flex-col sm:flex-row gap-2">
                                                    <div>
                                                        <span class="text-[10px] uppercase text-gray-500 font-bold block mb-1">Status Proyek</span>
                                                        <select name="project_status" class="bg-slate-950 border border-gray-800 rounded-lg text-xs px-2.5 py-1.5 focus:outline-none text-white">
                                                            <option value="pending" {{ $order->project_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="designing" {{ $order->project_status === 'designing' ? 'selected' : '' }}>Designing</option>
                                                            <option value="developing" {{ $order->project_status === 'developing' ? 'selected' : '' }}>Developing</option>
                                                            <option value="completed" {{ $order->project_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <span class="text-[10px] uppercase text-gray-500 font-bold block mb-1">Pembayaran</span>
                                                        <select name="payment_status" class="bg-slate-950 border border-gray-800 rounded-lg text-xs px-2.5 py-1.5 focus:outline-none text-white">
                                                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                                            <option value="cancelled" {{ $order->payment_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <button type="submit" form="update-form-{{ $order->id }}" class="inline-flex items-center px-4 py-2 text-xs font-bold text-white bg-indigo-500 hover:bg-indigo-600 rounded-xl hover:scale-105 transition-all cursor-pointer">
                                                Update
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                            Tidak ada data order proyek saat ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Courses List -->
            <div x-show="activeTab === 'courses'" class="grid grid-cols-1 md:grid-cols-3 gap-6" style="display: none;">
                @foreach($courses as $course)
                    <div class="glass rounded-2xl overflow-hidden border border-gray-800 flex flex-col h-full">
                        <div class="aspect-video relative">
                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="object-cover w-full h-full">
                            <span class="absolute top-3 right-3 text-[10px] font-bold px-2 py-1 rounded bg-slate-950 text-indigo-400">
                                {{ $course->lessons_count }} Lessons
                            </span>
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-base font-bold text-white mb-2 heading-font">{{ $course->title }}</h3>
                            <p class="text-gray-400 text-xs mb-4 flex-grow leading-relaxed">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                            <div class="pt-4 border-t border-gray-800 flex items-center justify-between text-xs mt-auto">
                                <span class="font-bold text-white">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                <span class="text-gray-500">ID: #{{ $course->id }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
