{{-- resources/views/admin/menus/createMenu.blade.php --}}
@extends('template.mainAdmin')
@section('Title', 'Create Menu')

@section('Content')
{{-- dibungkus dengan max width agar card tidak full width (mirip Create User) --}}
<div class="max-w-4xl mx-auto p-6">

    <div class="flex items-center justify-between mb-6 gap-2">
        <a href="{{ route('menus.index') }}" class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            <span class="hidden sm:inline">Back</span>
        </a>

        <h1 class="text-lg sm:text-2xl md:text-3xl font-bold text-blue-800 text-center flex-1">
            Create Menu
        </h1>

        <div class="w-40"></div>
    </div>

    <div class="bg-white rounded-xl p-8 shadow">
        {{-- validation errors --}}
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-100 text-red-700 rounded">
                <strong>Periksa input:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block mb-1 font-medium text-black">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" class="input w-full" required>
                @error('name') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label class="block mb-1 font-medium text-black">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" step="0.01" class="input w-full" required>
                @error('price') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Category & Location --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-medium text-black">Kategori</label>
                    <select name="category_id" class="input w-full">
                        <option value="">-- Pilih Kategori --</option>
                        @isset($categories)
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        @endisset
                    </select>
                    @error('category_id') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium text-black">Nama Kantin / Lokasi</label>
                    <select name="location_id" class="input w-full">
                        <option value="">-- Pilih Kantin --</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>
                                {{ $loc->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('location_id') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block mb-1 font-medium text-black">Deskripsi</label>
                <textarea name="description" class="input w-full" rows="3">{{ old('description') }}</textarea>
                @error('description') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Gambar --}}
            <div>
                <label class="block mb-1 font-medium text-black">Gambar</label>

                {{-- custom upload control --}}
                <div class="flex items-center gap-3">
                    <label for="imageInput"
                           class="inline-flex items-center gap-2 cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                        <i class="fa-solid fa-image"></i>
                        <span>Pilih Gambar</span>
                    </label>

                    <span id="fileName" class="text-gray-700 truncate max-w-[60%]">
                        Belum ada file dipilih
                    </span>
                </div>

                {{-- actual hidden input --}}
                <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" aria-label="Upload gambar menu">

                {{-- preview + clear --}}
                <div id="previewWrap" class="mt-3 hidden flex items-center gap-3">
                    <img id="imagePreview" src="#" alt="Preview" class="w-40 h-28 object-cover rounded shadow border">
                    <div>
                        <div class="flex gap-2">
                            <button type="button" id="clearPreview" class="btn btn-ghost text-red-600 hover:text-red-800">
                                Hapus
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Preview file yang dipilih</p>
                    </div>
                </div>

                @error('image') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- submit --}}
            <div class="flex items-center gap-3">
                <button type="submit" class="btn btn-primary px-6">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Inline script (langsung dieksekusi; tidak butuh @stack di layout) --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('imageInput');
    const fileName = document.getElementById('fileName');
    const previewWrap = document.getElementById('previewWrap');
    const imgPreview = document.getElementById('imagePreview');
    const clearBtn = document.getElementById('clearPreview');

    if (!input) {
        console.warn('imageInput not found on page');
        return;
    }

    input.addEventListener('change', function(e) {
        const file = e.target.files && e.target.files[0];

        if (!file) {
            if (fileName) fileName.textContent = "Belum ada file dipilih";
            if (previewWrap) previewWrap.classList.add('hidden');
            return;
        }

        // show filename
        if (fileName) fileName.textContent = file.name;

        // preview only if image
        if (file.type && file.type.startsWith('image/')) {
            const url = URL.createObjectURL(file);
            if (imgPreview) {
                imgPreview.src = url;
                imgPreview.alt = file.name;
            }
            if (previewWrap) previewWrap.classList.remove('hidden');
        } else {
            // non-image: show filename but hide preview
            if (imgPreview) imgPreview.src = '#';
            if (previewWrap) previewWrap.classList.add('hidden');
        }
    });

    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            input.value = "";
            if (fileName) fileName.textContent = "Belum ada file dipilih";
            if (previewWrap) previewWrap.classList.add('hidden');
            if (imgPreview) imgPreview.src = '#';
        });
    }
});
</script>

@endsection
