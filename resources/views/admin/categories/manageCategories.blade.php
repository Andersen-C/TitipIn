@extends('template.mainAdmin')
@section('Title', 'Manage Categories')

@section('Content')
<div class="p-12 min-h-screen">
    <div class="flex items-center justify-between mb-4 gap-2">
        <a href="{{ route('admin.manage') }}" class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            <span class="hidden sm:inline">{{ __('admin.Back')}}</span>
        </a>

        <h1 class="text-lg sm:text-2xl md:text-3xl font-bold text-blue-800 text-center flex-1">
            {{ __('admin.CatTable.Title') }}
        </h1>

        <label for="addCategoryModal" class="btn btn-primary rounded-xl text-sm sm:text-base md:text-lg px-3 sm:px-4 cursor-pointer">
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
                    <th class="text-xl text-center">{{__('admin.CatTable.No')}}</th>
                    <th class="text-xl">{{__('admin.CatTable.Name')}}</th>
                    <th class="text-xl text-center">{{__('admin.CatTable.Group')}}</th>
                    <th class="text-xl text-center">{{__('admin.CatTable.Action')}}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $key => $cat)
                    <tr class="text-black hover:bg-gray-200 transition duration-200">
                            <td class="text-black text-bold text-center font-bold">
                                {{ $key+1 }}
                            </td>

                        <td>
                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-bold">{{ ucfirst($cat->name)}}</div>    
                                </div>
                            </div>
                        </td>

                        <td class="text-center">
                            <span class="badge badge-ghost badge-lg">{{ $cat->group ? ucfirst($cat->group) : __('admin.CatTable.NoGroup') }}</span>
                        </td>

                        <td class="flex justify-around gap-2">
                            <label for="updateModal-{{ $cat->id }}" class="btn btn-l bg-amber-500 hover:bg-amber-700 hover:text-white">
                                <i class="fa-solid fa-pen-to-square mr-1"></i>
                                {{ __('admin.Update') }}
                            </label>
                            <label for="deleteModal_{{ $cat->id }}" class="btn btn-l bg-red-500 hover:bg-red-700 hover:text-white">
                                <i class="fa-solid fa-trash mr-1"></i>
                                {{ __('admin.Delete') }}
                            </label>
                        </td>
                    </tr>
                        
                    {{-- Delete Modal --}}
                    <input type="checkbox" id="deleteModal_{{ $cat->id }}" class="modal-toggle" />
                    <div class="modal">
                        <div class="modal-box bg-white text-black rounded-xl">
                            
                            <h3 class="font-bold text-xl mb-4 text-red-600">
                                <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                                {{ __('admin.UserDeleteModal.Title') }}
                            </h3>
                
                            <p class="mb-6">
                                {{ __('admin.UserDeleteModal.Message1') }}
                                <span class="font-bold">{{ $cat->name }}</span>? 
                                {{ __('admin.UserDeleteModal.Message2') }}
                            </p>
                
                            <div class="modal-action flex justify-end gap-3">
                                
                                {{-- Cancel Button --}}
                                <label for="deleteModal_{{ $cat->id }}" class="btn btn-ghost rounded-xl">
                                    {{ __('admin.UserDeleteModal.Cancel') }}
                                </label>
                
                                {{-- Confirm Delete --}}
                                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST">
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
                    <input type="checkbox" id="updateModal-{{ $cat->id }}" class="modal-toggle" />
                    <div class="modal">
                        <div class="modal-box bg-white text-gray-900 rounded-xl max-w-lg">
                            <h3 class="font-bold text-xl mb-4 text-blue-800">
                                {{ __('admin.CatUpdateModal.Title') }}
                            </h3>

                            <form action="{{ route('categories.update', $cat->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block mb-l.5 text-sm font-bold
                                    {{ $errors->{"update-$cat->id"}->has('name') ? 'text-red-600' : 'text-gray-900' }}">{{__('admin.CatUpdateModal.Name.Title')}}</label>
                                    <input type="text" name="name" value="{{ $errors->{"update-$cat->id"}->has('name') ? old('name') : $cat->name }}" placeholder="{{__('admin.CatUpdateModal.Name.Placeholder')}}"
                                        class="w-full border border-default-medium rounded-xl px-3 py-2 {{ $errors->{"update-$cat->id"}->has('name') ? 'border-red-600 text-red-600 placeholder:text-red-400' : 'border-default-medium' }}">
                                    @error('name', "update-$cat->id")
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-l.5 text-sm font-bold
                                    {{ $errors->{"update-$cat->id"}->has('group') ? 'text-red-600' : 'text-gray-900' }}">{{__('admin.CatUpdateModal.Group.Title')}}</label>
                                    <input type="text" name="group" value="{{ $errors->{"update-$cat->id"}->has('group') ? old('group') : $cat->group }}" placeholder="{{__('admin.CatUpdateModal.Group.Placeholder')}}"
                                        class="w-full border border-default-medium rounded-xl px-3 py-2 {{ $errors->{"update-$cat->id"}->has('group') ? 'border-red-600 text-red-600 placeholder:text-red-400' : 'border-default-medium' }}">
                                    @error('group', "update-$cat->id")  
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="modal-action justify-end gap-3">
                                    <label for="updateModal-{{ $cat->id }}" class="btn btn-ghost rounded-xl">{{ __('admin.UserDeleteModal.Cancel') }}</label>
                                    <button type="submit" class="btn bg-blue-700 text-sm rounded-xl hover:bg-blue-900">{{__('admin.CreateUserForm.Submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if ($errors->hasBag("update-$cat->id"))
                        <script>
                            document.getElementById("updateModal-{{ $cat->id }}").checked = true;
                        </script>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Add Category Modal --}}
<input type="checkbox" id="addCategoryModal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box bg-white text-gray-900 rounded-xl max-w-lg">
        <h3 class="font-bold text-xl mb-4 text-blue-800">
            {{ __('admin.CatAddModal.Title') }}
        </h3>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-l.5 text-sm font-bold
                {{ $errors->add->has('name') ? 'text-red-600' : 'text-gray-900' }}">{{__('admin.CatUpdateModal.Name.Title')}}</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="{{__('admin.CatUpdateModal.Name.Placeholder')}}"
                       class="w-full border rounded-xl px-3 py-2 {{ $errors->add->has('name') ? 'border-red-600 text-red-600' : 'border-default-medium' }}">
                @error('name', 'add')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror 
            </div>

            <div>
                <label class="block mb-l.5 text-sm font-bold
                {{ $errors->add->has('group') ? 'text-red-600' : 'text-gray-900' }}">{{__('admin.CatUpdateModal.Group.Title')}}</label>
                <input type="text" name="group" value="{{ old('group') }}" placeholder="{{__('admin.CatUpdateModal.Group.Placeholder')}}"
                       class="w-full border rounded-xl px-3 py-2 {{ $errors->add->has('group') ? 'border-red-600 text-red-600' : 'border-default-medium' }}">
                @error('group', 'add')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-action justify-end gap-3">
                <label for="addCategoryModal" class="btn btn-ghost rounded-xl">{{ __('admin.LocDeleteModal.Cancel') }}</label>
                <button type="submit" class="btn bg-blue-700 text-sm rounded-xl hover:bg-blue-900">{{ __('admin.CreateUserForm.Submit') }}</button>
            </div>
        </form>
    </div>
</div>

@if ($errors->hasBag('add'))
<script>
    document.getElementById("addCategoryModal").checked = true;
</script>
@endif
@endsection