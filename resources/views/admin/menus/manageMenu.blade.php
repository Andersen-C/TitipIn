@extends('template.mainAdmin')
@section('Title', 'Manage Menus')

@section('Content')
<div class="p-12 min-h-screen">
    <div class="flex items-center justify-between mb-4 gap-2">
        <a href="{{ route('admin.manage') }}"
           class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            Back
        </a>

        <h2 class="text-lg sm:text-2xl md:text-3xl font-bold text-blue-800 text-center flex-1">
            Manage Menus
        </h2>

        <a href="{{ route('menus.create') }}"
           class="btn btn-primary rounded-xl text-sm sm:text-base md:text-lg px-3 sm:px-4">
            <i class="fa-solid fa-plus"></i>
            Add
        </a>
    </div>

    {{-- SUCCESS --}}
    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-800 shadow">
            <i class="fa-solid fa-circle-check mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD --}}
    <div class="bg-white rounded-3xl shadow-xl p-8 overflow-x-auto">

        <table class="min-w-full text-sm text-gray-800">
            <thead>
                <tr class="text-gray-600">
                    <th class="py-4 px-4 text-center">No</th>
                    <th class="py-4 px-4">Gambar</th>
                    <th class="py-4 px-4 text-center">Harga</th>
                    <th class="py-4 px-4">Nama</th>
                    <th class="py-4 px-4 text-center">Nama Kantin</th>
                    <th class="py-4 px-4">Deskripsi</th>
                    <th class="py-4 px-4 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($menus as $index => $menu)
                <tr class="hover:bg-gray-50 transition">

                    {{-- NO --}}
                    <td class="py-5 px-4 text-center font-semibold">
                        {{ $menus->firstItem() + $index }}
                    </td>

                    {{-- GAMBAR --}}
                    <td class="py-5 px-4">
                        <div class="h-12 w-12 rounded-xl
                                    flex items-center justify-center
                                    bg-gray-100 overflow-hidden">
                            @if($menu->image_path)
                                <img src="{{ asset('storage/'.$menu->image_path) }}"
                                     class="h-full w-full object-cover">
                            @else
                                <i class="fa-solid fa-utensils text-gray-500"></i>
                            @endif
                        </div>
                    </td>

                    {{-- HARGA --}}
                    <td class="py-5 px-4 text-center font-medium">
                        Rp {{ number_format($menu->price,0,',','.') }}
                    </td>

                    {{-- NAMA --}}
                    <td class="py-5 px-4 font-semibold">
                        {{ $menu->name }}
                    </td>

                    {{-- KANTIN --}}
                    <td class="py-5 px-4 text-center">
                        <span class="px-3 py-1 rounded-full
                                     bg-gray-100 text-sm font-medium">
                            {{ $menu->location?->name ?? '-' }}
                        </span>
                    </td>

                    {{-- DESKRIPSI --}}
                    <td class="py-5 px-4 text-gray-600 max-w-sm truncate">
                        {{ Str::limit($menu->description, 20) }}
                    </td>

                    {{-- ACTION --}}
                    <td class="py-5 px-4 text-center space-x-2">
                        <a href="{{ route('menus.show', $menu->id) }}"
                           class="btn btn-l mb-2 bg-blue-800 hover:bg-blue-900 hover:text-white">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            Details
                        </a>

                        <a href="{{ route('menus.edit', $menu->id) }}"
                           class="btn btn-l mb-2 bg-amber-500 hover:bg-amber-700 hover:text-white">
                            <i class="fa-solid fa-pen"></i>
                            Update
                        </a>

                        <button
                            onclick="openDeleteModal({{ $menu->id }}, '{{ $menu->name }}')"
                            class="btn btn-l mb-2 bg-red-500 hover:bg-red-700 hover:text-white">
                            <i class="fa-solid fa-trash"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-gray-500">
                        No menus found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="mt-8 flex justify-end">
            {{ $menus->links('pagination::tailwind') }}
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div id="deleteModal"
     class="fixed inset-0 hidden z-50 flex items-center justify-center">

    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
         onclick="closeDeleteModal()"></div>

    <div class="relative bg-white rounded-2xl shadow-xl
                w-full max-w-md p-6 z-10">

        <h3 class="text-xl font-bold text-red-600 mb-4">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i>
            Konfirmasi Penghapusan
        </h3>

        <p class="mb-6 text-gray-700">
            Apakah Anda yakin ingin menghapus
            <span id="deleteName" class="font-semibold"></span>?
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()"
                    class="px-5 py-2 cursor-pointer rounded-lg border text-gray-700">
                Cancel
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2 rounded-lg
                               bg-red-600 hover:bg-red-700
                               text-white font-semibold cursor-pointer">
                    Ya, Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal(id, name) {
    document.getElementById('deleteForm').action = `/admin/menus/${id}`;
    document.getElementById('deleteName').textContent = name;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}
</script>
@endsection
