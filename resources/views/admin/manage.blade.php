@extends('template.mainAdmin')
@section('Title', 'Manage')

@section('Content')
<div class="p-12 min-h-screen">
    <h1 class="text-3xl font-bold mb-4 text-blue-700">{{__('admin.Introduction')}}</h1>
    
    <div class="grid gap-6 w-full grid-cols-1 mb-12 sm:grid-cols-[repeat(auto-fit,minmax(180px,1fr))] md:grid-cols-[repeat(auto-fit,minmax(250px,1fr))]"> 
        <!-- Manage Users Card -->
        <div class="w-full">
            <a href="{{ route('users.index') }}" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-user text-4xl md:text-5xl"></i>
                </div>

                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                {{ __('admin.ManageUser.Title1') }} <br>{{ __('admin.ManageUser.Title2') }}
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    {{ __('admin.ManageUser.Desc') }}
                </p>
            </a>
        </div>

        <!-- Manage Locations Card -->
        <div class="w-full">
            <a href="{{ route('locations.index') }}" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-location-dot text-4xl md:text-5xl"></i>
                </div>
                
                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    {{ __('admin.ManageLocation.Title1') }} <br>{{ __('admin.ManageLocation.Title2') }} 
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    {{ __('admin.ManageLocation.Desc') }} 
                </p>
            </a>
        </div>

        <!-- CARD 3 -->
        <div class="w-full">
            <a href="{{ route('categories.index') }}" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-th text-4xl md:text-5xl"></i>
                </div>
                
                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    {{ __('admin.ManageCategory.Title1') }} <br>{{ __('admin.ManageCategory.Title2') }}
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                     {{ __('admin.ManageCategory.Desc') }}
                </p>
            </a>
        </div>
    </div>


    <div class="grid gap-6 w-full grid-cols-1 mb-8 sm:grid-cols-[repeat(auto-fit,minmax(180px,1fr))] md:grid-cols-[repeat(auto-fit,minmax(250px,1fr))]"> 
        <!-- Manage Menus Card -->
        <div class="w-full">
            <a href="{{ route('menus.index') }}" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-book text-4xl md:text-5xl"></i>
                </div>
                
                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                     {{ __('admin.ManageMenu.Title1') }} <br>{{ __('admin.ManageMenu.Title2') }}
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    {{ __('admin.ManageMenu.Desc') }}
                </p>
            </a>
        </div>

        <!-- Manage Orders Card -->
        <div class="w-full">
            <a href="{{route('orders.index')}}" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-cart-shopping text-4xl md:text-5xl"></i>
                </div>
                
                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    {{ __('admin.ManageOrders.Title1') }} <br>{{ __('admin.ManageOrders.Title2') }}
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    {{ __('admin.ManageOrders.Desc') }}
                </p>
            </a>
        </div>

        <!-- Manage Menus Card -->
        <div class="w-full">
            <a href="{{ route('reviews.index') }}" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-star text-4xl md:text-5xl"></i>
                </div>
                
                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    {{ __('admin.ManageReview.Title1') }} <br>{{ __('admin.ManageReview.Title2') }}
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    {{ __('admin.ManageReview.Desc') }}
                </p>
            </a>
        </div>
    </div>
</div>
@endsection