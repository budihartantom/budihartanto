@extends('layouts.app')

@section('title', 'Client Dashboard - Budi Hartanto Platform')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-8 border-b border-gray-900 mb-10" data-aos="fade-down">
            <div>
                <h1 class="text-3xl font-extrabold text-white heading-font">Pelacak Proyek Agensi</h1>
                <p class="text-gray-400 mt-1">Pantau status pengerjaan sistem dan detail pembayaran secara real-time</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <span class="text-xs px-3 py-1.5 rounded-lg bg-gray-800 text-indigo-400 border border-gray-700 font-semibold uppercase tracking-wider">
                    Klien / Client
                </span>
            </div>
        </div>

        <div class="space-y-12" data-aos="fade-up" data-aos-delay="100">
            @forelse($orders as $order)
                @php
                    // Map status to numeric step index
                    $statusSteps = [
                        'pending' => 1,
                        'designing' => 2,
                        'developing' => 3,
                        'completed' => 4,
                    ];
                    $currentStep = $statusSteps[$order->project_status] ?? 1;
                @endphp
                
                <div class="glass p-8 rounded-3xl border border-gray-800/80 space-y-8">
                    
                    <!-- Order Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-gray-900">
                        <div>
                            <span class="text-xs text-gray-500 font-bold uppercase tracking-wider block">Nomor Invoice</span>
                            <span class="font-mono text-lg font-bold text-white mt-1 block">{{ $order->invoice_number }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 font-bold uppercase tracking-wider block">Layanan Dipesan</span>
                            <span class="text-base font-semibold text-indigo-400 mt-1 block">{{ $order->webService->package_name }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 font-bold uppercase tracking-wider block">Nilai Kontrak</span>
                            <span class="text-base font-semibold text-white mt-1 block">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 font-bold uppercase tracking-wider block">Pembayaran</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold mt-2.5
                                {{ $order->payment_status === 'paid' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : '' }}
                                {{ $order->payment_status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : '' }}
                                {{ $order->payment_status === 'cancelled' ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : '' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Visual Step-Wizard -->
                    <div class="space-y-4">
                        <span class="text-xs text-gray-500 uppercase tracking-widest block font-bold">Progres Proyek Aktif</span>
                        
                        <div class="relative pt-6 pb-2">
                            <!-- Progress connecting line -->
                            <div class="absolute top-[38px] left-0 right-0 h-1 bg-gray-900 -z-10 rounded-full"></div>
                            <div class="absolute top-[38px] left-0 h-1 bg-indigo-500 -z-10 rounded-full transition-all duration-500" 
                                 style="width: {{ (($currentStep - 1) / 3) * 100 }}%"></div>

                            <div class="flex items-center justify-between">
                                <!-- Step 1: Pending -->
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all duration-300
                                        {{ $currentStep >= 1 ? 'bg-indigo-600 border-indigo-500 shadow-[0_0_15px_rgba(99,102,241,0.5)] text-white' : 'bg-slate-950 border-gray-800 text-gray-600' }}">
                                        @if($currentStep > 1)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        @else
                                            <span class="text-xs font-bold">1</span>
                                        @endif
                                    </div>
                                    <span class="text-xs font-bold mt-3 {{ $currentStep >= 1 ? 'text-white' : 'text-gray-500' }}">Order Diterima</span>
                                    <span class="text-[10px] text-gray-500 mt-1">Pending</span>
                                </div>

                                <!-- Step 2: Designing -->
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all duration-300
                                        {{ $currentStep >= 2 ? 'bg-indigo-600 border-indigo-500 shadow-[0_0_15px_rgba(99,102,241,0.5)] text-white' : 'bg-slate-950 border-gray-800 text-gray-600' }}">
                                        @if($currentStep > 2)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        @else
                                            <span class="text-xs font-bold">2</span>
                                        @endif
                                    </div>
                                    <span class="text-xs font-bold mt-3 {{ $currentStep >= 2 ? 'text-white' : 'text-gray-500' }}">Desain UI/UX</span>
                                    <span class="text-[10px] text-gray-500 mt-1">Designing</span>
                                </div>

                                <!-- Step 3: Developing -->
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all duration-300
                                        {{ $currentStep >= 3 ? 'bg-indigo-600 border-indigo-500 shadow-[0_0_15px_rgba(99,102,241,0.5)] text-white' : 'bg-slate-950 border-gray-800 text-gray-600' }}">
                                        @if($currentStep > 3)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        @else
                                            <span class="text-xs font-bold">3</span>
                                        @endif
                                    </div>
                                    <span class="text-xs font-bold mt-3 {{ $currentStep >= 3 ? 'text-white' : 'text-gray-500' }}">Pengembangan</span>
                                    <span class="text-[10px] text-gray-500 mt-1">Developing</span>
                                </div>

                                <!-- Step 4: Completed -->
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all duration-300
                                        {{ $currentStep >= 4 ? 'bg-emerald-600 border-emerald-500 shadow-[0_0_15px_rgba(16,185,129,0.5)] text-white' : 'bg-slate-950 border-gray-800 text-gray-600' }}">
                                        @if($currentStep >= 4)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        @else
                                            <span class="text-xs font-bold">4</span>
                                        @endif
                                    </div>
                                    <span class="text-xs font-bold mt-3 {{ $currentStep >= 4 ? 'text-white' : 'text-gray-500' }}">Selesai & Rilis</span>
                                    <span class="text-[10px] text-gray-500 mt-1">Completed</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="glass p-12 rounded-3xl border border-gray-800 text-center text-gray-500">
                    Anda belum memiliki pesanan layanan pengembangan sistem agensi saat ini.
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
