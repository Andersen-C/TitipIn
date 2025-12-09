@extends('template.mainBeforeLogin')
@section('Title', 'Landing Page')

@section('Content')
<div class="container mx-auto py-16 px-8 lg:py-24"> 
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class='space-y-6'>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                <span class="text-blue-700">Titip Makanan Antar Lantai Kampus,</span>
                <br>
                <span class="text-amber-500">Mudah & Cepat!</span>
            </h1>
            <p class="text-gray-600 text-lg md:text-xl">
                Buat pesanan, pilih teman kampus yang siap bantu beli, dan tunggu pesananmu sampai ke lantai kamu.
            </p>
            <div class="flex space-x-4 pt-4">
                <a href="{{ route('login') }}"><button class="btn btn-primary bg-blue-700 hover:bg-blue-800 text-white border-blue-700 btn-lg">
                    Login
                </button></a>

                <a href="{{ route('register') }}"><button class="btn btn-outline border-gray-300 text-gray-700 hover:bg-gray-100 btn-lg">
                    Register
                </button></a>
            </div>
        </div>
    </div>
    {{-- <div class="hidden lg:block">
        <img 
            src="{{ asset('Gambar Home page.png') }}" 
            alt="TitipIn" 
            class="w-lg h-auto"
        />
    </div> --}}
</div>
@endsection