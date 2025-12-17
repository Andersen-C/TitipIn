@extends('template.mainAdmin')
@section('Title', 'Manage Users')

@section('Content')
<div class="p-12 min-h-screen">
    <div class="flex items-center justify-between mb-4 gap-2">
        <a href="{{ route('admin.manage') }}" class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            <span class="hidden sm:inline">{{ __('admin.Back') }}</span>
        </a>

        <h1 class="text-lg sm:text-2xl md:text-3xl font-bold text-blue-800 text-center flex-1">
            {{ __('admin.UserTable.Title') }}
        </h1>

        <a href="{{ route('users.create') }}" class="btn btn-primary rounded-xl text-sm sm:text-base md:text-lg px-3 sm:px-4">
            <i class="fa-solid fa-plus mr-1"></i> 
            <span class="hidden sm:inline">{{ __('admin.Add') }}</span>
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-4">
            <div class="flex items-center">
                <i class="fa-solid fa-circle-check mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif
    
    <div class="overflow-x-auto bg-white rounded-xl">
        <table class="table">
            <!-- head -->
            <thead class="border-b-4 border-gray-800">
                <tr class="text-black">
                    <th class="text-xl text-center">{{__('admin.UserTable.No')}}</th>
                    <th class="text-xl">{{__('admin.UserTable.Name')}}</th>
                    <th class="text-xl text-center">{{__('admin.UserTable.Role')}}</th>
                    <th class="text-xl text-center">{{__('admin.UserTable.AvgRating')}}</th>
                    <th class="text-xl text-center">{{__('admin.UserTable.Action')}}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $key => $user)
                    <tr class="text-black hover:bg-gray-200 transition duration-200">
                            <td class="text-black text-bold text-center font-bold">
                                {{ $key+1 }}
                            </td>

                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-12 w-12 flex items-center justify-center">
                                        @if($user->profile_pic)
                                            <img 
                                                src="{{ asset('storage/' . $user->profile_pic) }}" 
                                                alt="Avatar" 
                                                class="h-full w-full object-cover"
                                            >
                                        @else
                                            <i class="fa-solid fa-user text-xl text-gray-600"></i>
                                        @endif
                                    </div>
                                </div>
                                    
                                <div>
                                    <div class="font-bold">{{$user->name}}</div>
                                    
                                </div>
                            </div>
                        </td>

                        <td class="text-center">
                                <span class="badge badge-ghost badge-lg">{{ ucfirst($user->role) }}</span>
                            </td>

                            <td class="text-xl text-center font-bold">
                                <i class="fa-solid fa-star text-xl text-yellow-400"></i>
                                {{ number_format($user->avg_rating, 1)}}
                            </td>

                            <td class="flex justify-around gap-2">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-l bg-blue-800 hover:bg-blue-900 hover:text-white">
                                    <i class="fa-solid fa-circle-info mr-1"></i>
                                    {{__('admin.Details')}}
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-l bg-amber-500 hover:bg-amber-700 hover:text-white">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i>
                                    {{__('admin.Update')}}
                                </a>
                                <label for="deleteModal_{{ $user->id }}" class="btn btn-l bg-red-500 hover:bg-red-700 hover:text-white">
                                    <i class="fa-solid fa-trash mr-1"></i>
                                    {{__('admin.Delete')}}
                                </label>
                            </td>
                        </tr>
                        
                        <input type="checkbox" id="deleteModal_{{ $user->id }}" class="modal-toggle" />
                        <div class="modal">
                            <div class="modal-box bg-white text-black rounded-xl">
                                
                                <h3 class="font-bold text-xl mb-4 text-red-600">
                                    <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                                    {{ __('admin.UserDeleteModal.Title') }}
                                </h3>
                    
                                <p class="mb-6">
                                    {{ __('admin.UserDeleteModal.Message1') }}
                                    <span class="font-bold">{{ $user->name }}</span>? 
                                    {{ __('admin.UserDeleteModal.Message2') }}
                                </p>
                    
                                <div class="modal-action flex justify-end gap-3">
                                    
                                    {{-- Cancel Button --}}
                                    <label for="deleteModal_{{ $user->id }}" class="btn btn-ghost rounded-xl">
                                        {{ __('admin.UserDeleteModal.Cancel') }}
                                    </label>
                    
                                    {{-- Confirm Delete --}}
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                    
                                        <button type="submit" 
                                                class="btn bg-red-600 hover:bg-red-700 text-white rounded-xl">
                                            {{ __('admin.Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection