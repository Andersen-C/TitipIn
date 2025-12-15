@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Order Complete')

@section('Content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-sans">
    
    <div class="mb-6">
        <h1 class=" text-md sm:text-xl font-bold">Progress Pesanan • #ORBR-{{ $order->id }}</h1>
    </div>

    {{-- PROGRESS BAR --}}
    <div class="hidden md:block bg-white rounded-2xl shadow-sm border border-slate-100 p-8 mb-6 overflow-x-auto ">
        <div class="flex items-center justify-between min-w-[600px]">
            
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-blue-700 flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <img src="{{ asset('storage/check.png') }}" alt="">
                </div>
                <div class="text-blue-700 font-semibold">
                    Tiba di<br>Kantin
                </div>
            </div>

            <div class="flex-1 h-[2px] bg-blue-700 mx-4"></div>

            <div class="flex items-center gap-3 ">
                 <div class="w-12 h-12 rounded-full bg-blue-700 flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <img src="{{ asset('storage/check.png') }}" alt="">
                </div>
                <div class="text-blue-700 font-medium">
                    Mengambil<br>Titipan
                </div>
            </div>

             <div class="flex-1 h-[2px] bg-blue-700 mx-4"></div>

            <div class="flex items-center gap-3 ">
                <div class="w-12 h-12 rounded-full flex items-center justify-center bg-blue-700  mx-4 text-white shadow-lg shadow-blue-200">
                    <img src="{{ asset('storage/check.png') }}" alt="">
                </div>
                <div class="text-blue-700 font-medium ">
                    Sedang<br>diantarkan
                </div>
            </div>

             <div class="flex-1 h-[2px] bg-blue-700 mx-4"></div>

            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full flex items-center justify-center bg-blue-700 mx-4 text-white shadow-lg shadow-blue-200">
                    <img src="{{ asset('storage/check.png') }}" alt="">
                </div>
                <div class="text-blue-700 font-medium">
                    Selesai
                </div>
            </div>

        </div>
    </div>

    {{-- Progress Mobile --}}
    <div class="sm:hidden  bg-white rounded-2xl shadow-sm border border-slate-100 p-8 mb-3 overflow-x-auto ">
        <div class="flex items-center justify-between">
            <div class="flex  items-center justify-center gap-3">
                <div class="w-12 h-12  rounded-full bg-blue-700 flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <img src="{{ asset('storage/check.png') }}" alt="">
                </div>
                <div class="text-blue-700 font-semibold text-lg hover:bg-blue-950">
                    Pesanan Selesai
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT UTAMA --}}
    <div class="flex flex-col  lg:flex-row gap-6  items-start">

        {{-- LEFT SIDE --}}
        <div class="w-full lg:flex-1 bg-white   rounded-2xl shadow-sm border border-slate-100 p-2 sm:p-6 md:p-8">
            
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-2">Pesanan Selesai!</h2>
                <p class="opacity-75 font-semibold mb-6 text-green-600">Terima kasih, pesanan telah berhasil diselesaikan.</p>
                
                <div class="flex flex-col gap-3">
                    <a href="{{ route('runner.orders.index') }}" class="w-full bg-blue-700 hover:bg-blue-800 text-white text-center font-semibold py-4 px-6 rounded-lg transition duration-200">
                        Cari Pesanan Lain
                    </a>
                    <a href="{{ route('runner.history.index') }}" class="w-full bg-white border-2 border-slate-100 hover:bg-slate-50 text-slate-600 text-center font-semibold py-3 px-6 rounded-lg transition duration-200">
                        Lihat Riwayat
                    </a>
                </div>
            </div>

            <div class="border-b-4 border-gray-300 my-2"></div>

            <div class="mt-6">
                <h3 class="font-semibold  text-lg mb-4">Lokasi Pengantaran</h3>
                {{-- Data Dinamis --}}
                <p class="font-medium ">{{ $order->deliveryLocation->name ?? '-' }}</p>
                <p class="opacity-90 ">
                    {{ $order->deliveryLocation->description ?? '' }}
                    @if(isset($order->deliveryLocation->formatted_floor))
                        {{ $order->deliveryLocation->formatted_floor }}
                    @endif
                </p>
                <p class="opacity-75 font-medium mt-2">Pembayaran : {{ $order->payment_method ?? 'COD' }}</p>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="w-full lg:w-[400px] flex flex-col gap-6">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                
                @php
                    $groupedItems = $order->orderItems->groupBy('menu_id');
                @endphp

                @foreach($groupedItems as $items)
                    @php
                        $firstItem = $items->first();
                        $totalQty = $items->count();
                    @endphp
                    <div class="mb-3">
                        <h3 class="text-xl font-bold mb-1">{{ $firstItem->menu->name }}</h3>
                        <p class="opacity-80 mb-4">{{ $totalQty }}x • Rp {{ number_format($firstItem->price, 0, ',', '.') }}</p>
                    </div>
                @endforeach
                
                <div class="border-b-4 border-gray-300 my-2 "></div>
                
                <div class="mb-4 pt-2">
                    <p class="font-semibold  mb-1">Lokasi Pengambilan</p>
                    <p class="font-medium text-blue-800">{{ $order->pickupLocation->name ?? '-' }}</p>
                    <p class="opacity-80 text-md">
                        {{ $order->pickupLocation->description ?? '' }}
                        @if(isset($order->pickupLocation->formatted_floor))
                            {{ $order->pickupLocation->formatted_floor }}
                        @endif
                    </p>
                </div>

                <div class="border-b-4 border-gray-300 my-2 sm:mt-10"></div>

                {{-- Status Bar --}}
                <div class=" p-3 text-sm  text-center font-bold text-white bg-green-500 rounded-lg shadow-sm">
                    Pesanan Berhasil Diselesaikan
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col gap-2">
                <div class="text-xs font-bold text-gray-400 uppercase mb-2">Kontak Pemesan</div>
                
                <a href="#" class="flex items-center gap-3 text-left hover:bg-slate-50 p-2 rounded-lg transition">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center">
                        <img src="{{ asset('storage/chat.png') }}" alt="">
                    </div>
                    <div>
                        <span class="text-md font-semibold block">Chat Titipers</span>
                        <span class="text-xs text-gray-400">{{ $order->titiper->name ?? 'User' }}</span>
                    </div>
                </a>

                <a href="#" class="flex items-center  text-left hover:bg-slate-50 p-2 rounded-lg transition">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center">
                        <img src="{{ asset('storage/report.png') }}" alt="">
                    </div>
                    <span class="font-semibold text-md">Laporkan Masalah</span>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection