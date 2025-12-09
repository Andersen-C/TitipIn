@extends('template.mainBeforeLogin')
@section('Title', 'Login')

@section('Content')
<div class="container">
    <div class="p-8 sm:p-12 md:p-16">
        <h1 class="text-3xl font-bold text-blue-900 mb-8">Login</h1>
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf 
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                type="email" 
                name="email" 
                id="email" 
                placeholder="Masukkan Email" 
                class="mt-1 block w-full text-black px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                >
                @error('email')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    placeholder="Masukkan Password" 
                    class="mt-1 block w-full text-black px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                >
                @error('password')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <button 
                type="submit" 
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Login
            </button>
        </form>

        <div class="text-center mt-6 text-sm space-y-2">
            <a href="/forgot-password" class="font-medium text-blue-600 hover:text-blue-500">
                Lupa Password?
            </a>
            <p class="text-gray-600">
                Belum punya akun? 
                <a href="/register" class="font-bold text-amber-500 hover:text-amber-600">
                    Daftar
                </a>
            </p>
        </div>
    </div>
</div>

@endsection