@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Order')

@section('Content')
<div class="w-screen flex justify-center">
<div class="container sm:flex sm:flex-row py-5 sm:py-10  px-3 sm:px-2  sm:gap-10">
    <div class="container flex flex-col  w-full  ">
        {{-- div atas kanan --}}
        <div class=" ">
            <div>
                {{-- nama --}}
                <h1 class="text-3xl text-blue-800 font-extrabold">Hi, Budi</h1>
            </div>
            <div class="flex flex-col gap-5 sm:gap-10 ">
                <div>
                    {{-- ada titipan baru --}}
                    <h3 class="text-lg">Ada pesanan baru nih</h3>
                </div>
                <div class="">
                    {{-- code + food name + amount --}}
                    <h1 class='font-semibold text-lg'>#ORBR-27312 . Sushi jepun . 1x</h1>
                </div>
            </div>

        </div>

        <div class='py-6'>
        {{-- div tengah --}}
        <div class="px-6 py-2  shadow-[0_0_10px_rgba(0,0,0,0.3)] rounded-lg">
                <div>
                    {{-- atas --}}
                    <div>
                        {{-- pertama --}}
                        <h1 class='font-semibold'>Lokasi Pengambilan</h1>
                    </div>
                    <div>
                        {{-- kedua --}}
                        <h1 class='font-semibold'>Kantin Sushi Binusian - Meja 3</h1>
                    </div>
                </div>
                <div>
                    {{-- tengah --}}
                    <div>
                        {{-- pertama --}}
                        <h1 class="opacity-80">Binus anggrek - Lantai 1</h1>
                    </div>
                    <div>
                        {{-- kedua --}}
                        <h1 class="opacity-80">Estimasi Makanan Siap : 10 menit</h1>
                    </div>
                </div>
                <div class="mt-5 sm:mt-16 text-sm">
                    {{-- bawah --}}
                    <h1>perjalanan ke kantin 4 menit</h1>
                </div>
        </div>
        </div>
        {{-- div bawah --}}
        <div class="px-6 py-2  shadow-[0_0_10px_rgba(0,0,0,0.3)] rounded-lg">
            <div>
                {{-- atas --}}
                <div>
                    <h1 class="font-semibold">lokasi pengantaran</h1>
                </div>

                <div>
                    <h1 class="font-semibold">kelas 5139 - Area lift</h1>
                </div>
            </div>
            <div>
                {{-- bawah --}}
                <div>
                    <h1 class="opacity-80">binus anggrek - lantai 5</h1>
                </div>

                <div>
                    <h1 class="opacity-80">pembayaran COD</h1>
                </div>

                 <div class="sm:mt-17 text-sm">
                    {{-- bawah --}}
                </div>
            </div>
        </div>
    </div>

    {{-- div kanan --}}

        
    <div class="container flex flex-col  sm:h-full w-full  mt-8 sm:mt-0 px-8 shadow-[0_0_10px_rgba(0,0,0,0.3)] rounded-md ">
        <div class="px-2 sm:h-full flex flex-col">
        <div class="py-10  ">
            {{-- atas --}}
            <div class="flex flex-row justify-between">
                <div class="">
                    <h1 class="font-semibold text-xl">Biaya Pesanan</h1>
                </div>
                <div>
                    <h1 class="font-semibold text-xl">Rp.5000</h1>
                </div>
            </div>

            <div class="flex flex-row justify-between">
                <div>
                    <h1 class="font-semibold text-xl">Pendapatan</h1>
                </div>
                <div>
                    <h1 class="font-semibold text-xl">Rp.5000</h1>
                </div>
            </div>
            <div class="flex flex-row justify-between">
                <div>
                    <h1 class="font-semibold text-xl">total</h1>
                </div>
                <div>
                    <h1 class="font-semibold text-xl">Rp.10000</h1>
                </div>
            </div>

            <div class='border-4  border-gray-400 rounded sm:mt-5'>
                {{-- for the line --}}
            </div>
        </div>

        <div class="flex flex-col -sm:py-20">
            {{-- tengah --}}
            <div class="flex justify-center">
                <h1 class="text-5xl font-bold flex items-center mb-5">Ayo terima</h1>
            </div>
            <div class="flex justify-center">
                {{-- <h1 class="items-center text-lg">waktu tersisa untuk konfirmasi</h1> --}}
            </div>

            <div class="  rounded-xl hover:bg-blue-500 transition duration-200 bg-blue-700 flex justify-center sm:my-2 lg:mx-15">
                <a href="#" class="text-white items-center text-4xl font-[450]  p-2">Terima Pesanan</a>
            </div>
        </div>

        <div class="mt-auto pb-4 flex  justify-center">
            {{-- bawah --}}
            <h1 class="opacity-70">pesanan akan otomatis dialokasikan ke runner lain jika tidak ada respon</h1>
        </div>
        </div>
    </div>
</div>
</div>

@endsection