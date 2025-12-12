@extends('template.mainAdmin')
@section('Title', 'Manage Menus')

@section('Content')
<div class="p-12 min-h-0">
    <div class="flex items-center justify-between mb-4 gap-2">
        <a href="{{ route('admin.manage') }}" class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            <span class="hidden sm:inline">Back</span>
        </a>

        <h1 class="text-lg sm:text-2xl md:text-3xl font-bold text-blue-800 text-center flex-1">
            Manage Menus
        </h1>

        <a href="{{ route('menus.create') }}" class="btn btn-primary rounded-xl text-sm sm:text-base md:text-lg px-3 sm:px-4">
            <i class="fa-solid fa-plus mr-1"></i>
            <span class="hidden sm:inline">Add</span>
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
        <table class="table w-full">
            <!-- head -->
            <thead class="border-b-4 border-gray-800">
                <tr class="text-black">
                    <th class="text-xl text-center">No.</th>
                    <th class="text-xl">Gambar</th>
                    <th class="text-xl text-center">Harga</th>
                    <th class="text-xl">Nama</th>
                    <th class="text-xl text-center">Nama Kantin</th>
                    <th class="text-xl">Deskripsi</th>
                    <th class="text-xl text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($menus as $key => $menu)
                    <tr class="text-black hover:bg-gray-200 transition duration-200">
                        <td class="text-black text-bold text-center font-bold">
                            {{ $menus->firstItem() + $key }}
                        </td>

                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-12 w-12 flex items-center justify-center bg-gray-50">
                                        @if(!empty($menu->image_path))
                                            <img
                                                src="{{ asset('storage/' . $menu->image_path) }}"
                                                alt="Gambar {{ $menu->name }}"
                                                class="h-full w-full object-cover"
                                            >
                                        @else
                                            <i class="fa-solid fa-utensils text-xl text-gray-600"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="text-center font-medium">
                            Rp {{ number_format($menu->price ?? 0,0,',','.') }}
                        </td>

                        <td>
                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-bold">{{ $menu->name }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Nama Kantin: gunakan relation location --}}
                        <td class="text-center">
                            <span class="badge badge-ghost badge-lg max-w-[150px] truncate inline-block whitespace-nowrap">
                                {{ $menu->location?->name ?? '-' }}
                            </span>
                        </td>

                        <td class="text-sm text-gray-600">
                            {{ \Illuminate\Support\Str::limit($menu->description, 80) }}
                        </td>

                        <td class="flex justify-around gap-2">
                            <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-l bg-blue-800 hover:bg-blue-900 hover:text-white">
                                <i class="fa-solid fa-circle-info mr-1"></i>
                                Details
                            </a>

                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-l bg-amber-500 hover:bg-amber-700 hover:text-white">
                                <i class="fa-solid fa-pen-to-square mr-1"></i>
                                Update
                            </a>

                            {{-- modal delete trigger --}}
                            <label for="deleteModal_{{ $menu->id }}" class="btn btn-l bg-red-500 hover:bg-red-700 hover:text-white">
                                <i class="fa-solid fa-trash mr-1"></i>
                                Delete
                            </label>

                            {{-- Delete modal markup --}}
                            <input type="checkbox" id="deleteModal_{{ $menu->id }}" class="modal-toggle" />
                            <div class="modal">
                                <div class="modal-box bg-white text-black rounded-xl">
                                    <h3 class="font-bold text-xl mb-4 text-red-600">
                                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                                        Konfirmasi Penghapusan
                                    </h3>

                                    <p class="mb-6">
                                        Apakah Anda Yakin Ingin Menghapus
                                        <span class="font-bold">{{ $menu->name }}</span>?
                                    </p>

                                    <div class="modal-action flex justify-end gap-3">
                                        <label for="deleteModal_{{ $menu->id }}" class="btn btn-ghost rounded-xl">Cancel</label>

                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white rounded-xl">
                                                Ya, Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-600">
                            No menus found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- pagination --}}
        <div class="p-4">
            {{ $menus->links() }}
        </div>
    </div>
</div>
@endsection
