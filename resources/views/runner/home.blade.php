@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Home')

@section('Content')
<div class="mx-auto py-8">
    <div class="container mx-auto">
        <div class="flex flex-col-reverse md:flex-row items-center justify-between mb-12">
            <div class="w-full  md:w-1/2 text-center md:text-center mt-8 md:mt-0">
                <h1 class="text-3xl md:text-5xl font-bold text-blue-900 mb-4 leading-tight">
                    Jadi Runner, dan <br>
                    Antarkan Pesanan
                </h1>
                <p class="text-gray-600 text-lg mb-6  mx-auto md:mx-0">
                    Antar makanan antar lantai kampus, <br>
                    tambah penghasilanmu.
                </p>
            </div>

            <div class="hidden w-full md:w-1/2  md:flex justify-center items-center md:justify-center ">
                <img src="{{ asset('storagerunnerhomepage.png') }}" alt="Runner Illustration"  class="w-4/4 md:w-110 max-w-md object-contain">
            </div>
        </div>

        <div class="grid grid-cols-1 px-2 md:grid-cols-3 gap-6 sm:py-12">
            
            <div class="bg-white rounded-xl border border-gray-300 p-6 shadow-sm flex flex-col justify-between">
                <div class="flex items-center mb-4">
                    <div class="h-8 w-8 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <span class="text-blue-600 text-3xl">📋</span>
                    </div>
                    <h3 class="text-xl font-medium text-black">Lihat Pesanan</h3>
                </div>
                
                <a href="#" class='w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 rounded-lg text-center transition duration-200 mt-4'>
                    Klik disini
                </a>
            </div>

            <div class="bg-white rounded-xl border border-gray-300 p-6 shadow-sm flex flex-col justify-between">
                <div>
                    <div class='flex items-center mb-0'>
                        <div class="text-green-500 mt-0">
                            <span class='text-3xl '>💵</span>
                        </div>
                        <h3 class="text-xl font-medium text-black">Total Penghasilan</h3>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 ml-11">
                        Rp{{ number_format($totalEarnings, 0, ',', '.') }}
                    </p>
                </div>

                <div class="flex gap-3 mt-4">
                    <a href="#" class="flex-1 bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 rounded-lg text-center transition duration-200">
                        Detail
                    </a>
                    <a href="#" class="flex-1 bg-white border border-blue-700 text-blue-500 hover:bg-blue-50 font-medium py-2 rounded-lg text-center transition duration-200">
                        Cairkan
                    </a>
                </div>
            </div>

            <div class='bg-white rounded-xl border border-gray-300 p-6 shadow-sm flex flex-col justify-between'>
                <div class="flex items-center mb-4"> 
                    <span class="text-3xl mr-2">⭐</span> 
                    <h3 class="text-xl font-medium text-black">Rating</h3> </div>
                <div class="flex self-center ">
                <div class="flex self-center">
                    {{-- <div class="text-yellow-400 mr-2">
                        <span class="text-3xl">⭐</span>
                    </div> --}}
                    <span class='text-2xl font-bold text-gray-800 xl:items-center sm:-translate-y-5'>
                        {{ number_format($rating, 1) }}/5.0
                    </span>
                </div>
                <div class="mt-4 h-10"></div> 
            </div>
        </div>
    </div>
</div>
@endsection


