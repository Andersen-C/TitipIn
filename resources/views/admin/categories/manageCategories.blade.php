@extends('template.mainAdmin')
@section('Title', 'Manage Categories')

@section('Content')
<div class="p-12 min-h-screen">
    <div class="flex items-center justify-between mb-4 gap-2">
        <a href="{{ route('admin.manage') }}" class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            <span class="hidden sm:inline">Back</span>
        </a>

        <h1 class="text-lg sm:text-2xl md:text-3xl font-bold text-blue-800 text-center flex-1">
            Manage Categories
        </h1>

        <label for="addCategoryModal" class="btn btn-primary rounded-xl text-sm sm:text-base md:text-lg px-3 sm:px-4 cursor-pointer">
            <i class="fa-solid fa-plus mr-1"></i> 
            <span class="hidden sm:inline">Add</span>
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
                    <th class="text-xl text-center">No.</th>
                    <th class="text-xl">Name</th>
                    <th class="text-xl text-center">Group</th>
                    <th class="text-xl text-center">Action</th>
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
                            <span class="badge badge-ghost badge-lg">{{ $cat->group ? ucfirst($cat->group) : 'No Group' }}</span>
                        </td>

                        <td class="flex justify-around gap-2">
                            <label for="updateModal-{{ $cat->id }}" class="btn btn-l bg-amber-500 hover:bg-amber-700 hover:text-white">
                                <i class="fa-solid fa-pen-to-square mr-1"></i>
                                Update
                            </label>
                            <label for="deleteModal_{{ $cat->id }}" class="btn btn-l bg-red-500 hover:bg-red-700 hover:text-white">
                                <i class="fa-solid fa-trash mr-1"></i>
                                Delete
                            </label>
                        </td>
                    </tr>
                        
                    {{-- Delete Modal --}}
                    <input type="checkbox" id="deleteModal_{{ $cat->id }}" class="modal-toggle" />
                    <div class="modal">
                        <div class="modal-box bg-white text-black rounded-xl">
                            
                            <h3 class="font-bold text-xl mb-4 text-red-600">
                                <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                                Konfirmasi Penghapusan
                            </h3>
                
                            <p class="mb-6">
                                Apakah Anda Yakin Ingin Menghapus
                                <span class="font-bold">{{ $cat->name }}</span>? 
                                Aksi Ini Bersifat Permanen
                            </p>
                
                            <div class="modal-action flex justify-end gap-3">
                                
                                {{-- Cancel Button --}}
                                <label for="deleteModal_{{ $cat->id }}" class="btn btn-ghost rounded-xl">
                                    Cancel
                                </label>
                
                                {{-- Confirm Delete --}}
                                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                
                                    <button type="submit" 
                                            class="btn bg-red-600 hover:bg-red-700 text-white rounded-xl">
                                        Ya, Delete
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
                                Update Categories
                            </h3>

                            <form action="{{ route('categories.update', $cat->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block mb-l.5 text-sm font-bold
                                    {{ $errors->{"update-$cat->id"}->has('name') ? 'text-red-600' : 'text-gray-900' }}">Nama Lokasi</label>
                                    <input type="text" name="name" value="{{ $errors->{"update-$cat->id"}->has('name') ? old('name') : $cat->name }}" placeholder="Enter Category Name"
                                        class="w-full border border-default-medium rounded-xl px-3 py-2 {{ $errors->{"update-$cat->id"}->has('name') ? 'border-red-600 text-red-600 placeholder:text-red-400' : 'border-default-medium' }}">
                                    @error('name', "update-$cat->id")
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-l.5 text-sm font-bold
                                    {{ $errors->{"update-$cat->id"}->has('group') ? 'text-red-600' : 'text-gray-900' }}">Group</label>
                                    <input type="text" name="group" value="{{ $errors->{"update-$cat->id"}->has('group') ? old('group') : $cat->group }}" placeholder="Enter the Group"
                                        class="w-full border border-default-medium rounded-xl px-3 py-2 {{ $errors->{"update-$cat->id"}->has('group') ? 'border-red-600 text-red-600 placeholder:text-red-400' : 'border-default-medium' }}">
                                    @error('group', "update-$cat->id")  
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="modal-action justify-end gap-3">
                                    <label for="updateModal-{{ $cat->id }}" class="btn btn-ghost rounded-xl">Cancel</label>
                                    <button type="submit" class="btn bg-blue-700 text-sm rounded-xl hover:bg-blue-900">Submit</button>
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
            Add New Categories
        </h3>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-l.5 text-sm font-bold
                {{ $errors->add->has('name') ? 'text-red-600' : 'text-gray-900' }}">Nama Lokasi</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Category Name"
                       class="w-full border rounded-xl px-3 py-2 {{ $errors->add->has('name') ? 'border-red-600 text-red-600' : 'border-default-medium' }}">
                @error('name', 'add')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror 
            </div>

            <div>
                <label class="block mb-l.5 text-sm font-bold
                {{ $errors->add->has('group') ? 'text-red-600' : 'text-gray-900' }}">Group</label>
                <input type="text" name="group" value="{{ old('group') }}" placeholder="Enter the Group"
                       class="w-full border rounded-xl px-3 py-2 {{ $errors->add->has('group') ? 'border-red-600 text-red-600' : 'border-default-medium' }}">
                @error('group', 'add')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-action justify-end gap-3">
                <label for="addCategoryModal" class="btn btn-ghost rounded-xl">Cancel</label>
                <button type="submit" class="btn bg-blue-700 text-sm rounded-xl hover:bg-blue-900">Submit</button>
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