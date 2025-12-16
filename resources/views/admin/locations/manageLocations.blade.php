@extends('template.mainAdmin')
@section('Title', 'Manage Location')

@section('Content')
<div class="p-12 min-h-screen">
    <div class="flex items-center justify-between mb-4 gap-2">
        <a href="{{ route('admin.manage') }}" class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            <span class="hidden sm:inline">{{__('admin.Back')}}</span>
        </a>

        <h1 class="text-lg sm:text-2xl md:text-3xl font-bold text-blue-800 text-center flex-1">
            {{ __('admin.LocTable.Title') }}
        </h1>

        <label for="addLocationModal" class="btn btn-primary rounded-xl text-sm sm:text-base md:text-lg px-3 sm:px-4 cursor-pointer">
            <i class="fa-solid fa-plus mr-1"></i> 
            <span class="hidden sm:inline">{{ __('admin.Add') }}</span>
        </label>
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
                    <th class="text-xl text-center">{{ __('admin.LocTable.No') }}</th>
                    <th class="text-xl">{{ __('admin.LocTable.Name') }}</th>
                    <th class="text-xl text-center">{{ __('admin.LocTable.Floor') }}</th>
                    <th class="text-xl text-center">{{ __('admin.LocTable.Action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($locations as $key => $loc)
                    <tr class="text-black hover:bg-gray-200 transition duration-200">
                            <td class="text-black text-bold text-center font-bold">
                                {{ $key+1 }}
                            </td>

                        <td>
                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-bold">{{ ucfirst($loc->name)}}</div>    
                                </div>
                            </div>
                        </td>

                        <td class="text-center">
                            <span class="badge badge-ghost badge-lg">{{ $loc->formatted_floor }}</span>
                        </td>

                        <td class="flex justify-around gap-2">
                            <label for="updateModal-{{ $loc->id }}" class="btn btn-l bg-amber-500 hover:bg-amber-700 hover:text-white">
                                <i class="fa-solid fa-pen-to-square mr-1"></i>
                                {{ __('admin.Update') }}
                            </label>
                            <label for="deleteModal_{{ $loc->id }}" class="btn btn-l bg-red-500 hover:bg-red-700 hover:text-white">
                                <i class="fa-solid fa-trash mr-1"></i>
                                {{ __('admin.Delete') }}
                            </label>
                        </td>
                    </tr>
                        
                    {{-- Delete Modal --}}
                    <input type="checkbox" id="deleteModal_{{ $loc->id }}" class="modal-toggle" />
                    <div class="modal">
                        <div class="modal-box bg-white text-black rounded-xl">
                            
                            <h3 class="font-bold text-xl mb-4 text-red-600">
                                <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                                {{ __('admin.LocDeleteModal.Title') }}
                            </h3>
                
                            <p class="mb-6">
                                {{ __('admin.LocDeleteModal.Message1') }}
                                <span class="font-bold">{{ $loc->name }}</span>? 
                                {{ __('admin.LocDeleteModal.Message2') }}
                            </p>
                
                            <div class="modal-action flex justify-end gap-3">
                                
                                {{-- Cancel Button --}}
                                <label for="deleteModal_{{ $loc->id }}" class="btn btn-ghost rounded-xl">
                                    {{ __('admin.LocDeleteModal.Cancel') }}
                                </label>
                
                                {{-- Confirm Delete --}}
                                <form action="{{ route('locations.destroy', $loc->id) }}" method="POST">
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

                    {{-- Update Modal --}}
                    <input type="checkbox" id="updateModal-{{ $loc->id }}" class="modal-toggle" />
                    <div class="modal">
                        <div class="modal-box bg-white text-gray-900 rounded-xl max-w-lg">
                            <h3 class="font-bold text-xl mb-4 text-blue-800">
                                Update Location
                            </h3>

                            <form action="{{ route('locations.update', $loc->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                
                                <div>
                                    <label class="block mb-l.5 text-sm font-bold
                                    {{ $errors->{"update-$loc->id"}->has('name') ? 'text-red-600' : 'text-gray-900' }}">{{ __('admin.LocUpdateModal.Name.Title')}}</label>
                                    <input type="text" name="name" value="{{ $errors->{"update-$loc->id"}->has('name') ? old('name') : $loc->name }}" placeholder="{{ __('admin.LocUpdateModal.Name.Placeholder')}}"
                                        class="w-full border border-default-medium rounded-xl px-3 py-2 {{ $errors->{"update-$loc->id"}->has('name') ? 'border-red-600 text-red-600 placeholder:text-red-400' : 'border-default-medium' }}">
                                    @error('name', "update-$loc->id")
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-l.5 text-sm font-bold
                                    {{ $errors->{"update-$loc->id"}->has('floor_number') ? 'text-red-600' : 'text-gray-900' }}">{{ __('admin.LocUpdateModal.Floor.Title')}}</label>
                                    <input type="number" name="floor_number" value="{{ $errors->{"update-$loc->id"}->has('floor_number') ? old('floor_number') : $loc->floor_number }}" placeholder="{{ __('admin.LocUpdateModal.Floor.Placeholder')}}"
                                        class="w-full border border-default-medium rounded-xl px-3 py-2 {{ $errors->{"update-$loc->id"}->has('floor_number') ? 'border-red-600 text-red-600 placeholder:text-red-400' : 'border-default-medium' }}">
                                    @error('floor_number', "update-$loc->id")  
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="modal-action justify-end gap-3">
                                    <label for="updateModal-{{ $loc->id }}" class="btn btn-ghost rounded-xl">{{ __('admin.LocDeleteModal.Cancel') }}</label>
                                    <button type="submit" class="btn bg-blue-700 text-sm rounded-xl hover:bg-blue-900">{{__('admin.CreateUserForm.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if ($errors->hasBag("update-$loc->id"))
                        <script>
                            document.getElementById("updateModal-{{ $loc->id }}").checked = true;
                        </script>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Add Location Modal --}}
<input type="checkbox" id="addLocationModal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box bg-white text-gray-900 rounded-xl max-w-lg">
        <h3 class="font-bold text-xl mb-4 text-blue-800">
            {{ __('admin.LocAddModal.Title') }}
        </h3>

        <form action="{{ route('locations.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-l.5 text-sm font-bold
                {{ $errors->add->has('name') ? 'text-red-600' : 'text-gray-900' }}">{{__('admin.LocUpdateModal.Name.Title')}}</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="{{__('admin.LocUpdateModal.Name.Placeholder')}}"
                       class="w-full border rounded-xl px-3 py-2 {{ $errors->add->has('name') ? 'border-red-600 text-red-600' : 'border-default-medium' }}">
                @error('name', 'add')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror 
            </div>

            <div>
                <label class="block mb-l.5 text-sm font-bold
                {{ $errors->add->has('floor_number') ? 'text-red-600' : 'text-gray-900' }}">{{__('admin.LocUpdateModal.Floor.Title')}}</label>
                <input type="number" name="floor_number" value="{{ old('floor_number') }}" placeholder="{{__('admin.LocUpdateModal.Floor.Placeholder')}}"
                       class="w-full border rounded-xl px-3 py-2 {{ $errors->add->has('floor_number') ? 'border-red-600 text-red-600' : 'border-default-medium' }}">
                @error('floor_number', 'add')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-action justify-end gap-3">
                <label for="addLocationModal" class="btn btn-ghost rounded-xl">{{__('admin.LocDeleteModal.Cancel')}}</label>
                <button type="submit" class="btn bg-blue-700 text-sm rounded-xl hover:bg-blue-900">{{__('admin.CreateUserForm.Submit')}}</button>
            </div>
        </form>
    </div>
</div>

@if ($errors->hasBag('add'))
<script>
    document.getElementById("addLocationModal").checked = true;
</script>
@endif

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        background: inherit !important;
        border: none;
        width: 16px;
        height: 100%;
    }

    input[type=number] {
        -moz-appearance: textfield;
        background-color: inherit !important;
    }
</style>
@endsection