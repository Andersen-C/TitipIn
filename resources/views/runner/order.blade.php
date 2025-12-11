@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Order')

@section('Content')

<div class="py-8 px-4 max-w-7xl mx-auto">
    
    {{-- Menampilkan Pesan Sukses/Error --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class='items-center'>
        <h1 class="text-3xl sm:flex sm:flex-row font-bold text-blue-900 mb-6">Pesanan</h1>
        
        @forelse($orders as $order)
        <div class='container sm:mb-4'>

            <div class="flex flex-col p-4 border-2 border-zinc-500 rounded-lg sm:flex-row bg-white relative">
                
                {{-- GAMBAR --}}
                <div class="flex flex-col sm:justify-center w-full sm:w-1/4 sm:h-max">
                    <img class="justify-center rounded-md object-cover h-32 w-full" src="https://picsum.photos/200/100?random={{ $order->id }}" alt="Menu Image">
                </div>
                
                {{-- INFO PESANAN --}}
                <div class="flex flex-col sm:w-1/2 ml-0 p-6">
                    
                    {{-- 1. PERBAIKAN: MENGAMBIL NAMA MENU DARI RELASI ORDER ITEMS --}}
                    <h3 class="text-black font-bold text-xl">
                        @php
                            // 1. Kita kelompokkan item berdasarkan nama menu-nya
                            $groupedItems = $order->orderItems->groupBy(function($item) {
                                return $item->menu->name ?? $item->name ?? 'Unknown';
                            });
                        @endphp

                        @foreach($groupedItems as $name => $items)
                            {{-- 2. Tampilkan: "Jumlah x Nama Menu" (Contoh: 3x Es Jeruk) --}}
                            
                            <span class="block sm:inline">
                                {{ $items->count() }}x {{ $name }}
                            </span>

                            {{-- Tambahkan koma jika bukan item terakhir --}}
                            @if(!$loop->last), @endif
                        @endforeach
                    </h3>
                
                {{-- BAGIAN HARGA --}}
                <p class="text-black text-lg">
                    Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                </p>
                    
                    {{-- 3. PERBAIKAN: LOKASI DARI RELASI LOCATION --}}
                    <p class="text-gray-600 mt-4 sm:mt-auto">
                        {{-- Mengambil nama lokasi pickup --}}
                        <span class="font-semibold">{{ $order->pickupLocation->name ?? 'Lokasi Awal' }}</span> 
                        &rarr; 
                        {{-- Mengambil nama lokasi delivery --}}
                        <span class="font-semibold">{{ $order->deliveryLocation->name ?? 'Lokasi Tujuan' }}</span>
                    </p>

                    {{-- Menampilkan Catatan/Notes jika ada --}}
                    @if($order->notes)
                        <p class="text-xs text-gray-500 mt-1 italic">"{{ $order->notes }}"</p>
                    @endif
                </div>
                
                {{-- BAGIAN KANAN (STATUS & TOMBOL) --}}
                <div class="flex flex-col sm:w-1/4 justify-between sm:items-end w-full">
                        
                    {{-- BADGE STATUS --}}
                    <div class="flex flex-row mb-2 justify-end w-full">
                        @if($order->runner_id == null)
                            <div class="flex flex-col px-3 border-2 text-white font-semibold border-blue-500 bg-blue-500 rounded-md">
                                <h2>New Order</h2>
                            </div>
                        @elseif($order->runner_id == Auth::id())
                            <div class="flex flex-col px-3 border-2 text-yellow-600 font-semibold border-yellow-400 bg-yellow-100 rounded-md">
                                <h2>Sedang Diantar</h2>
                            </div>
                        @endif
                    </div>
                    
                    {{-- TOMBOL AKSI --}}
                    <div class="flex flex-row items-end w-full justify-between sm:justify-end gap-2">
                        <div class="flex flex-col">
                            @if($order->runner_id == null)
                                
                                {{-- TOMBOL LAMA (DIMENTION DULU BIAR AMAN) --}}
                                {{-- 
                                <form action="{{ route('runner.orders.accept', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 ...">Terima</button>
                                </form> 
                                --}}

                                {{-- TOMBOL BARU (NON-AKTIF / DISABLED) --}}
                                <button type="button" disabled class="bg-gray-300 text-gray-500 border-2 border-gray-300 rounded-md px-3 py-1 font-bold text-lg cursor-not-allowed">
                                    Terima (Maintenance)
                                </button>

                            @else
                                <span class="text-gray-400 px-2 py-1 font-semibold text-sm italic">Milik Anda</span>
                            @endif
                        </div>

                        <div class="flex flex-col justify-end">
                            {{-- Gunakan # dulu jika route show belum dibuat --}}
                            <a href="#" class='text-blue-800 hover:bg-blue-900 hover:text-white transition duration-200 font-semibold border-2 border-blue-800 rounded-md px-3 py-1'>
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="text-center py-10 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300">
                <p class="text-xl text-gray-500 font-semibold">Belum ada pesanan tersedia.</p>
            </div>
        @endforelse

    </div>   
</div>
@endsection