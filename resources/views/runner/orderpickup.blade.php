@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Order Pickup')

@section('Content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-sans">
    
    <div class="mb-6">
        <h1 class=" text-md sm:text-xl font-bold">Progress Pesanan • #ORD-27112025-002</h1>
    </div>

    {{-- top part so this part is done, but dont forget to change the next page --}}
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
                    <img src="{{ asset('storage/hand_stuff.png') }}" alt="">
                </div>
                <div class="text-blue-700 font-medium t">
                    Mengambil<br>Titipan
                </div>
            </div>

             <div class="flex-1 h-[2px] bg-slate-200 mx-4"></div>

            <div class="flex items-center gap-3 opacity-50">
                <div class="w-12 h-12 rounded-full flex items-center justify-center bg-slate-300 mx-4 text-white shadow-lg shadow-blue-200">
                    <img src="{{ asset('storage/im_on_the_way.png') }}" alt="">
                </div>
                <div class="text-slate-500 font-medium text-sm">
                    Sedang<br>diantarkan
                </div>
            </div>

             <div class="flex-1 h-[2px] bg-slate-200 mx-4"></div>

            <div class="flex items-center gap-3 opacity-50">
                <div class="w-12 h-12 rounded-full flex items-center justify-center bg-slate-300 mx-4 text-white shadow-lg shadow-blue-200">
                    <img src="{{ asset('storage/check.png') }}" alt="">
                </div>
                <div class="text-slate-500 font-medium text-sm">
                    Selesai
                </div>
            </div>

        </div>
    </div>

    {{-- for mobile --}}
    <div class="sm:hidden  bg-white rounded-2xl shadow-sm border border-slate-100 p-8 mb-3 overflow-x-auto ">
        <div class="flex items-center justify-between">
            
            <div class="flex  items-center justify-center gap-3">
                <div class="w-12 h-12  rounded-full bg-blue-700 flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <img src="{{ asset('storage/hand_stuff.png') }}" alt="">
                </div>
                <div class="text-blue-700 font-semibold text-lg hover:bg-blue-950">
                    Mengambil Titipan
                </div>
            </div>

        </div>
    </div>

    {{-- middle man --}}
    <div class="flex flex-col  lg:flex-row gap-6  items-start">

        {{-- left side --}}
        <div class="w-full lg:flex-1 bg-white   rounded-2xl shadow-sm border border-slate-100 p-2 sm:p-6 md:p-8">
            
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-2">Konfirmasi sudah mengambil makanan?</h2>
                <p class="opacity-75 font-semibold mb-6 ">Konfirmasi ke Titipers kalo kamu sudah mengambil pesanan</p>
                
                <div class=" flex flex-col justify-center items-center  ">
                    <a href="{{ route('runner.orders.deliver',$order->id) }}" class="w-full bg-blue-700  hover:bg-blue-800 items-center justify-center flex text-white font-semibold py-4 px-6 rounded-lg transition duration-200 "  method="POST">
                        Konfirmasi sudah mengambil
                    </a>
                </div>
            </div>

            <div class="border-b-4 border-gray-300 my-2"></div>

            <div class="mt-6">
                <h3 class="font-semibold  text-lg mb-4">Lokasi Pengantaran</h3>
                <p class="font-medium ">Kelas 513 - Area Lift a/n Mikwok</p>
                <p class="opacity-90" >Binus anggrek - Lantai 5</p>
                <p class="opacity-75 font-medium">Pembayaran : COD</p>
            </div>
        </div>
        {{-- right side --}}
        <div class="w-full lg:w-[400px] flex flex-col gap-6">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-xl  font-bold mb-1">Sushi Jepun</h3>
                <p class="text-slate-600  mb-4">1x • Rp 25.000</p>
                
                <div class="border-b-4 border-gray-300 my-2 "></div>
                
                <div class="mb-4">
                    <p class="font-semibold  mb-1">Lokasi Pengambilan</p>
                    <p class=" font-medium ">Kantin Sushi Binusian - Meja 3</p>
                    <p class="opacity-80  text-md">Binus anggrek - Lantai 1</p>
                </div>

                <div class="border-b-4 border-gray-300 my-2 sm:mt-10"></div>

                <div class=" p-3 text-sm  text-center  font-bold ">
                    Kantin sedang menyiapkan titipan
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col gap-2">
                
                <a href="#" class="flex items-center gap-3 text-left hover:bg-slate-50 p-2 rounded-lg transition">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center">
                        <img src="{{ asset('storage/chat.png') }}" alt="">
                    </div>
                    <span class="text-md font-semibold ">Chat Titipers</span>
                </a>

                <a href="#" class="flex items-center gap-3 text-left hover:bg-slate-50 p-2 rounded-lg transition">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center">
                        <img src="{{ asset('storage/call.png') }}" alt="">
                    </div>
                    <span class=" text-md font-semibold ">Telepon Titipers</span>
                </a>

                <a href="#" class="flex items-center  text-left hover:bg-slate-50 p-2 rounded-lg transition">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center">
                        <img src="{{ asset('storage/report.png') }}" alt="">
                    </div>
                    <span class="font-semibold text-md ">Laporkan Masalah</span>
                </a>

            </div>
        </div>
    </div>
</div>

@endsection