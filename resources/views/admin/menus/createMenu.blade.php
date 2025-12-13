{{-- resources/views/admin/menus/createMenu.blade.php --}}
@extends('template.mainAdmin')
@section('Title', 'Create Menu')

@section('Content')
<div class="p-12 min-h-screen bg-gray-50">

    {{-- Header (back di kiri, judul center) --}}
    <div class="relative mb-4 flex items-center">
        <a href="{{ route('menus.index') }}"
           class="btn btn-secondary rounded-xl text-sm sm:text-lg z-10 inline-flex items-center gap-2">
            <i class="fa-solid fa-backward"></i>
            Back
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2
                   text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">
            Create Menu
        </h2>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl p-8">

            <form id="createMenuForm" action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Nama --}}
                <div class="relative">
                    <label for="name" class="block mb-1.5 text-sm font-bold text-gray-900">Nama Makanan</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan Nama Makanan"
                        class="block w-full rounded-xl px-4 py-2.5 bg-gray-50 border {{ $errors->has('name') ? 'border-red-600' : 'border-default-medium' }} text-gray-900 text-sm">
                    @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Harga --}}
                <div class="relative">
                    <label for="price" class="block mb-1.5 text-sm font-bold text-gray-900">Harga (Rp)</label>
                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        id="price"
                        value="{{ old('price') }}"
                        placeholder="Masukkan Harga"
                        class="block w-full rounded-xl px-4 py-2.5 bg-gray-50 border {{ $errors->has('price') ? 'border-red-600' : 'border-default-medium' }} text-gray-900 text-sm">
                    @error('price') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Category & Location --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="relative">
                    <label for="category_id" class="block mb-1.5 text-sm font-bold text-gray-900">Kategori</label>
                    <select
                        name="category_id"
                        id="category_id"
                        class="block w-full rounded-xl bg-gray-50 text-gray-900 px-4 py-2.5 border {{ $errors->has('category_id') ? 'border-red-600' : 'border-default-medium' }}">
                      <option value="">-- Pilih Kategori --</option>
                      @isset($categories)
                        @foreach($categories as $cat)
                          <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                          </option>
                        @endforeach
                      @endisset
                    </select>
                    @error('category_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                  </div>

                  <div class="relative">
                    <label for="location_id" class="block mb-1.5 text-sm font-bold text-gray-900">Nama Kantin / Lokasi</label>
                    <select
                        name="location_id"
                        id="location_id"
                        class="block w-full rounded-xl bg-gray-50 text-gray-900 px-4 py-2.5 border {{ $errors->has('location_id') ? 'border-red-600' : 'border-default-medium' }}">
                      <option value="">-- Pilih Kantin --</option>
                      @isset($locations)
                        @foreach($locations as $loc)
                          <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>
                            {{ $loc->name }}
                          </option>
                        @endforeach
                      @endisset
                    </select>
                    @error('location_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                  </div>
                </div>

                {{-- Deskripsi --}}
                <div class="relative">
                    <label for="description" class="block mb-1.5 text-sm font-bold text-gray-900">Deskripsi</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        placeholder="Masukkan Deskripsi"
                        class="block w-full rounded-xl px-4 py-2.5 bg-gray-50 border {{ $errors->has('description') ? 'border-red-600' : 'border-default-medium' }} text-gray-900 text-sm">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Upload Gambar (nullable di controller) --}}
                <div class="relative space-y-1">
                    <label for="profileFileInput" class="block text-sm font-medium text-gray-900">Upload Gambar <span class="text-gray-500 text-sm">(opsional)</span></label>

                    <input
                        name="image"
                        id="profileFileInput"
                        type="file"
                        accept="image/*"
                        class="hidden"
                    />

                    <div class="flex bg-gray-50 items-center justify-between border {{ $errors->has('image') ? 'border-red-600' : 'border-default-medium' }} rounded-xl px-3 py-2.5 shadow-xs">
                        <span id="file_name" class="text-gray-600 text-sm">
                            {{ old('image') ? \Illuminate\Support\Str::afterLast(old('image'), '/') : 'Tidak ada File' }}
                        </span>

                        <button type="button" onclick="document.getElementById('profileFileInput').click()"
                            class="px-3 py-1.5 bg-blue-700 text-white text-sm rounded-lg hover:bg-blue-900 hover:cursor-pointer">
                            Pilih File
                        </button>
                    </div>

                    {{-- server-side error for image (e.g. bukan gambar atau terlalu besar) --}}
                    @error('image') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Submit --}}
                <div class="flex justify-center pt-4">
                    <button type="submit" class="btn bg-blue-700 text-white text-sm rounded-xl hover:bg-blue-900 px-6 py-2">
                        Submit
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- JS: tampilkan nama file ketika user pilih gambar --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('profileFileInput');
  const label = document.getElementById('file_name');

  if (!input || !label) return;

  input.addEventListener('change', function (e) {
    const f = e.target.files && e.target.files[0];
    label.textContent = f ? f.name : 'Tidak ada File';
  });
});
</script>

@endsection
