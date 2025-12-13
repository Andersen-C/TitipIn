@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Detail Pesanan')

@section('Content')
<div class="w-screen flex justify-center">
    {{-- Container Utama --}}
    <div class="container sm:flex sm:flex-row py-5 sm:py-10 px-3 sm:px-2 sm:gap-10">
        
        {{-- KOLOM KIRI (Info Order) --}}
        <div class="container flex flex-col w-full">
            
            {{-- Header Kiri --}}
            <div class="">
                <div>
                    {{-- Nama Runner yang Login --}}
                    <h1 class="text-3xl text-blue-800 font-extrabold">Hi, {{ Auth::user()->name }}</h1>
                </div>
                <div class="flex flex-col gap-5 sm:gap-10 ">
                    <div>
                        <h3 class="text-lg">Ada pesanan baru nih</h3>
                    </div>
                    <div>
                        {{-- Logic: Order ID + Nama Menu Loop + Jumlah --}}
                        <h1 class='font-semibold text-lg'>
                            #ORBR-{{ $order->id }} . 
                            @foreach($order->orderItems as $item)
                                {{ $item->menu->name ?? 'Menu' }} . {{ $item->quantity }}x
                            @endforeach
                        </h1>
                    </div>
                </div>
            </div>

            <div class='py-6'>
                {{-- Card Lokasi Pickup --}}
                <div class="px-6 py-2 shadow-[0_0_10px_rgba(0,0,0,0.3)] rounded-lg">
                    <div>
                        <div>
                            <h1 class='font-semibold'>Lokasi Pengambilan</h1>
                        </div>
                        <div>
                            {{-- Nama Lokasi Pickup --}}
                            <h1 class='font-semibold text-blue-800'>{{ $order->pickupLocation->name ?? 'Lokasi Awal' }}</h1>
                        </div>
                    </div>
                    <div>
                        <div>
                            {{-- Detail Lantai Pickup --}}
                            <h1 class="opacity-80">{{ $order->pickupLocation->description ?? 'Area Kampus' }}</h1>
                        </div>
                        <div>
                            <h1 class="opacity-80">Estimasi Makanan Siap : 10 menit</h1>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-16 text-sm">
                        <h1>perjalanan ke kantin 4 menit</h1>
                    </div>
                </div>
            </div>

            {{-- Card Lokasi Delivery --}}
            <div class="px-6 py-2 shadow-[0_0_10px_rgba(0,0,0,0.3)] rounded-lg">
                <div>
                    <div>
                        <h1 class="font-semibold">lokasi pengantaran</h1>
                    </div>
                    <div>
                        {{-- Nama Lokasi Delivery --}}
                        <h1 class="font-semibold text-green-700">{{ $order->deliveryLocation->name ?? 'Lokasi Tujuan' }}</h1>
                    </div>
                </div>
                <div>
                    <div>
                        {{-- Detail Lantai Delivery --}}
                        <h1 class="opacity-80">{{ $order->deliveryLocation->description ?? 'Area Kampus' }}</h1>
                    </div>
                    <div>
                        {{-- Metode Pembayaran --}}
                        <h1 class="opacity-80">pembayaran {{ $order->payment_method ?? 'COD' }}</h1>
                    </div>
                    {{-- Catatan --}}
                    @if($order->notes)
                    <div class="mt-2 text-sm text-red-500 italic">
                         Note: "{{ $order->notes }}"
                    </div>
                    @endif
                    <div class="sm:mt-17 text-sm"></div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN (Harga & Tombol) --}}
        <div class="container flex flex-col sm:h-full w-full mt-8 sm:mt-0 px-8 shadow-[0_0_10px_rgba(0,0,0,0.3)] rounded-md ">
            <div class="px-2 sm:h-full flex flex-col">
                <div class="py-10">
                    <div class="flex flex-row justify-between">
                        <div>
                            <h1 class="font-semibold text-xl">Bayaran</h1>
                        </div>
                        <div>
                            {{-- Logic Harga (Service Fee) --}}
                            <h1 class="font-semibold text-xl">Rp.{{ number_format($order->service_fee, 0, ',', '.') }}</h1>
                        </div>
                    </div>

                    <div class="flex flex-row justify-between">
                        <div>
                            <h1 class="font-semibold text-xl">kompensasi</h1>
                        </div>
                        <div>
                            <h1 class="font-semibold text-xl">Rp.0</h1>
                        </div>
                    </div>

                    <div class='border-4 border-gray-400 rounded sm:mt-5'></div>
                </div>

                <div class="flex flex-col -sm:py-20">
                    {{-- Timer Statis --}}
                    <div class="flex justify-center">
                        <h1 class="text-5xl font-bold items-center">00:21</h1>
                    </div>
                    <div class="flex justify-center">
                        <h1 class="items-center text-lg">waktu tersisa untuk konfirmasi</h1>
                    </div>

                    {{-- LOGIC TOMBOL TERIMA --}}
                    @if($order->runner_id == null)
                        {{-- Jika Order Belum Diambil: Tampilkan Tombol Terima --}}
                        <form action="{{ route('runner.orders.accept', $order->id) }}" method="POST" class="w-full">
                            @csrf
                            {{-- Saya ubah tag <a> jadi <button> tapi class-nya SAMA PERSIS --}}
                            <button type="submit" class="w-full rounded-xl hover:bg-blue-500 transition duration-200 bg-blue-700 flex justify-center sm:my-2 lg:mx-15 text-white items-center text-4xl font-[450] p-2">
                                Terima Pesanan
                            </button>
                        </form>
                    
                    @elseif($order->runner_id == Auth::id())
                        {{-- Jika Order Punya Saya --}}
                        <div class="rounded-xl bg-gray-400 flex justify-center sm:my-2 lg:mx-15">
                             <h1 class="text-white items-center text-2xl font-[450] p-2">Milik Anda</h1>
                        </div>
                    
                    @else
                        {{-- Jika Diambil Orang Lain --}}
                        <div class="rounded-xl bg-red-500 flex justify-center sm:my-2 lg:mx-15">
                             <h1 class="text-white items-center text-2xl font-[450] p-2">Sudah Diambil</h1>
                        </div>
                    @endif
                </div>

                <div class="mt-auto pb-4 flex justify-center">
                    <h1 class="opacity-70 text-center">pesanan akan otomatis dialokasikan ke runner lain jika tidak ada respon</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection