@extends('template.mainBeforeLogin')
@section('Title', 'Login')

@section('Content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-xl border border-gray-200">
        <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">{{ __('auth.TitleLogin') }}</h1>
        
        @if (session('failed'))
            <div class="alert alert-danger bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-4">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check mr-2"></i>
                    {{ session('failed') }}
                </div>
            </div>
        @endif
        
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf 
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('auth.Email') }}</label>
                <input 
                type="email" 
                name="email" 
                id="email" 
                placeholder="{{ __('auth.EmailPlaceH') }}" 
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
                    placeholder="{{ __('auth.PasswordPlaceH') }}" 
                    class="mt-1 block w-full text-black px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                >
                @error('password')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <button 
                type="submit" 
                class="w-full flex cursor-pointer justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                {{ __('auth.Button') }}
            </button>
        </form>

        <div class="text-center mt-6 text-sm space-y-2">
            <p class="text-gray-600">
                {{ __('auth.NotRegister') }}
                <a href="/register" class="font-bold text-amber-500 hover:text-amber-600">
                    {{ __('auth.RegButton') }}
                </a>
            </p>
        </div>
    </div>
</div>

@endsection