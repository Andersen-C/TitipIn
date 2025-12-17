@extends('template.mainBeforeLogin')
@section('Title', 'Register')

@section('Content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-xl border border-gray-200">
        <h1 class="text-3xl text-center font-bold text-blue-700 mb-8">{{ __('auth.TitleRegister') }}</h1>
        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf 
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{__('auth.Username')}}</label>
                <input 
                type="text" 
                name="name" 
                id="name" 
                placeholder="{{__('auth.UsernamePlaceH')}}" 
                class="mt-1 block w-full text-black px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                >
                @error('name')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-700">{{__('auth.Phone')}}</label>
                <input 
                type="tel" 
                name="phone_number" 
                id="phone_number" 
                placeholder="{{__('auth.PhonePlaceH')}}" 
                class="mt-1 block w-full text-black px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                >
                @error('phone_number')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{__('auth.Email')}}</label>
                <input 
                type="email" 
                name="email" 
                id="email" 
                placeholder="{{__('auth.EmailPlaceH')}}" 
                class="mt-1 block w-full text-black px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                >
                @error('email')
                    <div class="text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">{{__('auth.Password')}}</label>
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

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{__('auth.PasswordConf')}}</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    placeholder="{{ __('auth.PassConfPlaceH') }}" 
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
                {{__('auth.RegButton')}}
            </button>
        </form>

        <div class="text-center mt-6 text-sm space-y-2">
            <p class="text-gray-600">
                {{__('auth.AlreadyReg')}}
                <a href="{{ route('loginPage') }}" class="font-bold text-amber-500 hover:text-amber-600">
                    {{__('auth.TitleLogin')}}
                </a>
            </p>
        </div>
    </div>
</div>

@endsection