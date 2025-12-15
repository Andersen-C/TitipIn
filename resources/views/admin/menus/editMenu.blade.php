@extends('template.mainAdmin')
@section('Title', 'Update Menu')

@section('Content')
<div class="p-12 min-h-screen bg-gray-50">

    {{-- HEADER (Back kiri, Title center) --}}
    <div class="relative mb-4 flex items-center">
        <a href="{{ route('menus.index') }}"
           class="btn btn-secondary rounded-xl text-sm sm:text-lg z-10 inline-flex items-center gap-2">
            <i class="fa-solid fa-backward"></i>
            Back
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2
                   text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">
            Update Menu
        </h2>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl p-8">

            <form action="{{ route('menus.update', $menu->id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label class="block mb-1.5 text-sm font-bold text-gray-900">
                        Nama Makanan
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name', $menu->name) }}"
                           class="block w-full rounded-xl px-4 py-2.5
                                  bg-gray-50 border
                                  text-gray-900
                                  {{ $errors->has('name') ? 'border-red-600' : 'border-default-medium' }}">
                    @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block mb-1.5 text-sm font-bold text-gray-900">
                        Harga (Rp)
                    </label>
                    <input type="number"
                           name="price"
                           value="{{ old('price', $menu->price) }}"
                           class="block w-full rounded-xl px-4 py-2.5
                                  bg-gray-50 border
                                  text-gray-900
                                  {{ $errors->has('price') ? 'border-red-600' : 'border-default-medium' }}">
                    @error('price') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Category & Location --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-900">
                            Kategori
                        </label>
                        <select name="category_id"
                                class="block w-full rounded-xl
                                       bg-gray-50 px-4 py-2.5 border
                                       text-gray-900">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $menu->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-900">
                            Nama Kantin / Lokasi
                        </label>
                        <select name="location_id"
                                class="block w-full rounded-xl
                                       bg-gray-50 px-4 py-2.5 border
                                       text-gray-900">
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}"
                                    {{ old('location_id', $menu->location_id) == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block mb-1.5 text-sm font-bold text-gray-900">
                        Deskripsi
                    </label>
                    <textarea name="description"
                              rows="4"
                              class="block w-full rounded-xl px-4 py-2.5
                                     bg-gray-50 border
                                     text-gray-900">{{ old('description', $menu->description) }}</textarea>
                </div>

                {{-- Upload Gambar (Custom seperti Create Menu) --}}
                <div class="relative space-y-1">
                    <label class="block text-sm font-bold text-gray-900">
                        Upload Gambar <span class="text-gray-500">(opsional)</span>
                    </label>

                    {{-- input asli --}}
                    <input
                        type="file"
                        name="image"
                        id="imageInput"
                        accept="image/*"
                        class="hidden"
                    />

                    {{-- custom box --}}
                    <div class="flex items-center justify-between
                                bg-gray-50
                                border border-default-medium
                                rounded-xl
                                px-4 py-2.5">
                        <span id="fileName" class="text-gray-600 text-sm">
                            Tidak ada File
                        </span>

                        <button type="button"
                                onclick="document.getElementById('imageInput').click()"
                                class="px-4 py-1.5
                                       bg-blue-700 hover:bg-blue-900
                                       text-white text-sm
                                       rounded-lg">
                            Pilih File
                        </button>
                    </div>

                    @error('image')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="flex justify-center pt-4">
                    <button type="submit"
                            class="btn bg-blue-700 text-white rounded-xl hover:bg-blue-900 px-6 py-2">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- JS tampilkan nama file --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('imageInput');
    const label = document.getElementById('fileName');

    if (!input || !label) return;

    input.addEventListener('change', function () {
        label.textContent = input.files.length
            ? input.files[0].name
            : 'Tidak ada File';
    });
});
</script>
@endsection
