@extends('template.mainAdmin')
@section('Title', 'User Detail')

@section('Content')
<div class="p-4 sm:p-6 lg:p-12 min-h-screen">

    {{-- Tombol Back dan Judul --}}
    <div class="relative mb-8 flex items-center">
        <a href="{{ route('users.index') }}" 
           class="btn btn-secondary rounded-xl text-sm sm:text-lg z-10">
            <i class="fa-solid fa-backward"></i>
            Back
        </a>

        <h1 class="absolute left-1/2 -translate-x-1/2 
                   text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">
            User Detail
        </h1>
    </div>

    {{-- User Detail Card --}}
    <div class="card bg-white rounded-2xl border hover:border-blue-400 transition duration-200 hover:shadow-lg">
        <div class="flex flex-col lg:flex-row p-4 sm:p-6 gap-4 sm:gap-6">
            <figure class="flex items-center justify-center bg-gray-200 h-40 sm:h-52 lg:h-100 w-40 sm:w-52 lg:w-100 rounded-xl mx-auto lg:mx-0 overflow-hidden">
                @if($user->profile_pic)
                    <img 
                        src="{{ asset('storage/' . $user->profile_pic) }}" 
                        alt="Avatar" 
                        class="h-full w-full object-cover"
                    >
                @else
                    <i class="fa-solid fa-user text-5xl sm:text-6xl lg:text-7xl text-gray-500"></i>
                @endif
            </figure>

            <div class="flex-1 space-y-3 sm:space-y-4 text-black">

                <div>
                    <p class="text-gray-500 font-semibold text-sm sm:text-base">Name</p>
                    <p class="text-lg sm:text-xl font-bold">{{ $user->name }}</p>
                </div>

                <div>
                    <p class="text-gray-500 font-semibold text-sm sm:text-base">Role</p>
                    <p class="text-lg font-bold">{{ ucfirst($user->role) }}</p>
                </div>

                <div>
                    <p class="text-gray-500 font-semibold text-sm sm:text-base">Mode</p>
                    <p class="text-lg font-bold">{{ ucfirst($user->mode) }}</p>
                </div>

                <div>
                    <p class="text-gray-500 font-semibold text-sm sm:text-base">Email</p>
                    <p class="text-lg font-bold">{{ $user->email }}</p>
                </div>

                <div>
                    <p class="text-gray-500 font-semibold text-sm sm:text-base">Phone Number</p>
                    <p class="text-lg font-bold">{{ $user->phone_number ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-gray-500 font-semibold text-sm sm:text-base">Average Rating</p>
                    <p class="text-lg font-bold flex items-center gap-2">
                        <i class="fa-solid fa-star text-yellow-400 text-xl"></i>
                        {{ number_format($user->avg_rating, 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection