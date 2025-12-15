@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Detail Pesanan')

@section('Content')
<div class="w-full flex justify-center bg-white min-h-screen">
    <div class="container max-w-7xl sm:flex sm:flex-row py-5 sm:py-10 px-4 sm:gap-12">
        
        {{-- KOLOM KIRI --}}
        <div class="flex flex-col w-full sm:w-7/12">
            
            {{-- Header Nama & Items --}}
            <div class="mb-8">
                <div class="mb-6">
                    {{-- Nama User --}}
                    <h1 class="text-3xl text-blue-800 font-extrabold mb-1">Hi, {{ Auth::user()->name }}</h1>
                    <h3 class="text-lg text-gray-600">Ada pesanan baru nih</h3>
                </div>
                
                {{-- LOGIKA ITEM --}}
                <div class="flex flex-col gap-3">
                    @php
                        $groupedItems = $order->orderItems->groupBy('menu_id');
                    @endphp

                    @forelse($groupedItems as $items)
                        @php
                            $firstItem = $items->first();
                            $totalQty = $items->count();
                        @endphp

                        <div class="py-2">
                            <h1 class='font-bold text-2xl text-black'>
                                <span class="text-gray-500 text-lg font-normal mr-2">#ORBR-{{ $order->id }} .</span>
                                {{ $firstItem->menu->name }} 
                                <span class="text-blue-700">({{ $totalQty }}x)</span>
                            </h1>
                        </div>
                    @empty
                        <h1 class="text-red-500 font-bold">Item Tidak Ditemukan</h1>
                    @endforelse
                </div>
            </div>

            <div class='flex flex-col gap-6'>
                {{-- CARD 1: LOKASI PENGAMBILAN --}}
                <div class="px-6 py-4 shadow-[0_0_10px_rgba(0,0,0,0.15)] rounded-lg border border-gray-100">
                    <div class="mb-2">
                        <h1 class='font-bold text-lg'>Lokasi Pengambilan</h1>
                    </div>
                    
                    <div class="mb-3">
                        <h1 class='font-bold text-xl text-black'>{{ $order->pickupLocation->name ?? 'Lokasi Jemput' }}</h1>
                        <h1 class="text-gray-600">
                            {{ $order->pickupLocation->description ?? 'Area Kampus' }} 
                            @if(isset($order->pickupLocation->formatted_floor))
                                - {{ $order->pickupLocation->formatted_floor }}
                            @endif
                        </h1>
                        <h1 class="text-gray-500 text-sm mt-1">Estimasi Makanan Siap : 10 menit</h1>
                    </div>
                    
                    <div class="text-sm text-gray-400">
                        <h1>perjalanan ke kantin 4 menit</h1>
                    </div>
                </div>

                {{-- CARD 2: LOKASI PENGANTARAN --}}
                <div class="px-6 py-4 shadow-[0_0_10px_rgba(0,0,0,0.15)] rounded-lg border border-gray-100">
                    <div class="mb-2">
                        <h1 class="font-bold text-lg">Lokasi Pengantaran</h1>
                    </div>
                    
                    <div class="mb-3">
                        <h1 class="font-bold text-xl text-green-700">{{ $order->deliveryLocation->name ?? 'Lokasi Tujuan' }}</h1>
                        <h1 class="text-gray-600">
                            {{ $order->deliveryLocation->description ?? 'Area Kampus' }} 
                            @if(isset($order->deliveryLocation->formatted_floor))
                                - {{ $order->deliveryLocation->formatted_floor }}
                            @endif
                        </h1>
                    </div>

                    <div class="flex flex-col gap-1">
                        <h1 class="text-gray-600">Pembayaran: <span class="font-semibold">{{ $order->payment_method ?? 'COD' }}</span></h1>
                        
                        @if($order->notes)
                            <div class="text-red-500 italic text-sm">
                                Note: "{{ $order->notes }}"
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- HARGA & ACTION --}}
        <div class="flex flex-col w-full sm:w-5/12 mt-10 sm:mt-31">
            <div class="px-6 py-8 shadow-[0_0_15px_rgba(0,0,0,0.1)] rounded-xl bg-gray-50 h-fit">
                
                {{-- SECTION HARGA --}}
                <div class="flex flex-col gap-3 mb-8">
                    <div class="flex flex-row justify-between text-lg">
                        <h1 class="font-medium text-gray-700">Biaya Pesanan</h1>
                        <h1 class="font-bold">Rp. {{ number_format($order->subtotal, 0, ',', '.') }}</h1>
                    </div>

                    <div class="flex flex-row justify-between text-lg">
                        <h1 class="font-medium text-gray-700">Pendapatan</h1>
                        <h1 class="font-bold text-green-600">Rp. {{ number_format($order->service_fee, 0, ',', '.') }}</h1>
                    </div>

                    <div class="border-b-4 border-gray-300 my-2"></div>

                    <div class="flex flex-row justify-between text-xl">
                        <h1 class="font-bold text-black">Total</h1>
                        <h1 class="font-bold text-black">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</h1>
                    </div>
                </div>

                {{-- SECTION ACTION --}}
                <div class="flex flex-col items-center justify-center mt-4">
                    
                    <h1 class="text-4xl font-bold mb-6 text-center text-black">Ayo terima</h1>

                    @if($order->runner_id == null)
                        <form action="{{ route('runner.orders.accept', $order->id) }}" method="POST" class="w-full">
                            @csrf
                            {{-- Button dibuat w-full tapi text centered --}}
                            <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold text-2xl py-3 px-4 rounded-xl shadow-lg transition duration-200 text-center">
                                Terima Pesanan
                            </button>
                        </form>
                    
                    @elseif($order->runner_id == Auth::id())
                        <div class="w-full bg-gray-400 text-white font-bold text-xl py-3 px-4 rounded-xl text-center shadow-md cursor-default">
                             Milik Anda
                        </div>
                    
                    @else
                        <div class="w-full bg-red-500 text-white font-bold text-xl py-3 px-4 rounded-xl text-center shadow-md cursor-default">
                             Sudah Diambil
                        </div>
                    @endif
                    
                    <p class="text-sm text-gray-400 mt-4 text-center px-2">
                        pesanan akan otomatis dialokasikan ke runner lain jika tidak ada respon
                    </p>
                </div>

            </div>
        </div>
        
    </div>
</div>
@endsection