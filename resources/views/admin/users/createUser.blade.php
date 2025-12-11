@extends('template.mainAdmin')
@section('Title', 'Create User')

@section('Content')
<div class="p-12 min-h-screen">
    <div class="relative mb-4 flex items-center">
        <a href="{{ route('users.index') }}" 
           class="btn btn-secondary rounded-xl text-sm sm:text-lg z-10">
            <i class="fa-solid fa-backward"></i>
            Back
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2 
                   text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">
            Create User
        </h2>
    </div>

    <div class="max-w-3xl mx-auto p-6">
        
        {{-- Card --}}
        <div class="card bg-white shadow-xl rounded-2xl p-6">

            <form action="{{ route('users.store') }}" 
                method="POST" 
                enctype="multipart/form-data" 
                class="space-y-5">
                @csrf

                {{-- Nama --}}
                <div class="form-control">
                    <label class="font-semibold text-gray-700">Name</label>
                    <input type="text" name="name" class="input input-bordered w-full rounded-xl">
                </div>

                {{-- Email --}}
                <div class="form-control">
                    <label class="font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" class="input input-bordered w-full rounded-xl">
                </div>

                {{-- Phone Number --}}
                <div class="form-control">
                    <label class="font-semibold text-gray-700">Phone Number</label>
                    <input type="text" name="phone_number" class="input input-bordered w-full rounded-xl">
                </div>

                {{-- Role --}}
                <div class="form-control">
                    <label class="font-semibold text-gray-700">Role</label>
                    <select name="role" class="select select-bordered w-full rounded-xl">
                        <option value="user">User</option>
                        <option value="runner">Runner</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                {{-- Mode (Only for Runner or Optional) --}}
                <div class="form-control">
                    <label class="font-semibold text-gray-700">Mode</label>
                    <select name="mode" class="select select-bordered w-full rounded-xl">
                        <option value="online">Online</option>
                        <option value="offline">Offline</option>
                    </select>
                </div>

                {{-- Password --}}
                <div class="form-control">
                    <label class="font-semibold text-gray-700">Password</label>
                    <input type="password" name="password"
                        class="input input-bordered w-full rounded-xl">
                </div>

                {{-- Profile Picture --}}
                <div class="form-control">
                    <label class="font-semibold text-gray-700">Profile Picture</label>
                    <input type="file" name="profile_pic"
                        class="file-input file-input-bordered w-full rounded-xl">
                </div>

                {{-- Buttons --}}
                <div class="flex justify-center gap-4 pt-4">
                    <button type="submit"
                            class="btn bg-blue-700 hover:bg-blue-800 text-white rounded-xl">
                        <i class="fa-solid fa-check mr-1"></i>
                        Create User
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection