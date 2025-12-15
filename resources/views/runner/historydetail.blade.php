@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'History Detail')

@section('Content')


<div class="w-full flex justify-center bg-white min-h-screen">
    <div class="container max-w-7xl sm:flex sm:flex-row py-5 sm:py-10 px-4 sm:gap-12">
        
        {{-- KOLOM KIRI --}}
        <div class="flex flex-col w-full sm:w-7/12">
            
            {{-- Header Nama & Items --}}
            <div class="mb-8">
                
                {{-- back --}}
                <div class="">
                    <a href="{{ route('runner.history.index') }}" class=''>
                        <button class="flex items-center gap-3 rounded-full bg-blue-700 px-4 py-1 sm:px-7 sm:py-2 text-xl font-semibold text-white transition duration-200 hover:bg-blue-900">
                            <span> Back</span>
                        </button>
                    </a>
                </div>

                {{-- LOGIKA ITEM --}}
                <div class="flex flex-col gap-3 mt-6">
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
                        
                        <h1 class="text-gray-600 mt-1">
                            Waktu Pesan: 
                            <span class="font-semibold">
                                {{ $order->created_at->format('d M Y, H:i') }} WIB
                            </span>
                        </h1>
                    </div>
                    
                    {{-- Estimasi perjalanan dihapus sesuai permintaan --}}
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
                        
                        <h1 class="text-gray-600 mt-1">Waktu Selesai: 
                            <span class="font-semibold">
                                {{ $order->updated_at->format('d M Y, H:i') }} WIB
                            </span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        {{-- HARGA & ACTION --}}
        <div class="flex flex-col w-full sm:w-5/12 mt-10 sm:mt-26">
            
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

                {{-- SECTION ACTION (Logika Status) --}}
                <div class="flex flex-col items-center justify-center mt-4">
                    
                    <h1 class="text-2xl font-bold mb-6 text-center text-black">Status</h1>

                    @if($order->status == 'completed' || $order->status == 'Selesai')
                        <div class="w-full bg-green-400 text-white font-bold text-xl py-3 px-4 rounded-xl text-center shadow-md cursor-default">
                            Selesai
                        </div>
                    @elseif($order->status == 'canceled' || $order->status == 'Dibatalkan')
                        <div class="w-full bg-red-500 text-white font-bold text-xl py-3 px-4 rounded-xl text-center shadow-md cursor-default">
                            Dibatalkan
                        </div>
                        <p class="text-sm text-gray-400 mt-4 text-center px-2">
                            Pesanan ini telah dibatalkan.
                        </p>

                    @else
                        <div class="w-full bg-blue-500 text-white font-bold text-xl py-3 px-4 rounded-xl text-center shadow-md cursor-default capitalize">
                            {{ $order->status }}
                        </div>
                    @endif
                        
                </div>

            </div>
        </div>
        
    </div>
</div>

@endsection