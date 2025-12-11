@extends('template.mainAdmin')
@section('Title', 'Manage')

@section('Content')
<div class="p-12 min-h-screen">
    <h1 class="text-3xl font-bold mb-4 text-blue-800">Hi, Admin</h1>
    
    <div class="grid gap-6 w-full grid-cols-1 mb-8 sm:grid-cols-[repeat(auto-fit,minmax(180px,1fr))] md:grid-cols-[repeat(auto-fit,minmax(250px,1fr))]"> 
        <!-- Manage Users Card -->
        <div class="w-full">
            <a href="{{ route('users.index') }}" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-user text-4xl md:text-5xl"></i>
                </div>

                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                Manage <br>Users
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    View, create, and manage all user accounts and roles.
                </p>
            </a>
        </div>

        <!-- Manage Locations Card -->
        <div class="w-full">
            <a href="#" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-location-dot text-4xl md:text-5xl"></i>
                </div>
                
                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    Manage <br>Locations
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    View, create, and manage all location in the system.
                </p>
            </a>
        </div>

        <!-- CARD 3 -->
        <div class="w-full">
            <a href="#" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-th text-4xl md:text-5xl"></i>
                </div>
                
                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    Manage <br>Categories
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    View, create, and manage all the categories in the system.
                </p>
            </a>
        </div>
    </div>


    <div class="grid gap-6 w-full grid-cols-1 mb-8 sm:grid-cols-[repeat(auto-fit,minmax(180px,1fr))] md:grid-cols-[repeat(auto-fit,minmax(250px,1fr))]"> 
        <!-- Manage Menus Card -->
        <div class="w-full">
            <a href="#" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-book text-4xl md:text-5xl"></i>
                </div>
                
                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    Manage <br>Menus
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    View, create, and manage all menus in the system.
                </p>
            </a>
        </div>

        <!-- Manage Orders Card -->
        <div class="w-full">
            <a href="#" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-cart-shopping text-4xl md:text-5xl"></i>
                </div>
                
                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    Manage <br>Orders
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    View and manage all orders and order items in the system.
                </p>
            </a>
        </div>

        <!-- Manage Menus Card -->
        <div class="w-full">
            <a href="#" class="block w-full h-full bg-white p-6 md:p-8 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl hover:border-blue-400 transition duration-300">
                <div class="flex justify-center items-center text-blue-600 mb-5">
                    <i class="fa-solid fa-star text-4xl md:text-5xl"></i>
                </div>
                
                <h5 class="mb-2 text-center text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                    Manage <br>Reviews
                </h5>
                
                <p class="text-center text-gray-500 text-sm md:text-base">
                    View and manage all the reviews in the system.
                </p>
            </a>
        </div>
    </div>
</div>
@endsection