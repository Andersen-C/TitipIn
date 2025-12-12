{{-- resources/views/admin/menus/createMenu.blade.php --}}
@extends('template.mainAdmin')
@section('Title', 'Create Menu')

@section('Content')
<div class="p-8 flex justify-center">
  <div class="w-full max-w-3xl">

    {{-- Header (Back + Title) — OUTSIDE card --}}
    <div class="relative mb-6 flex items-center justify-center">
      {{-- Back button pinned to the far left --}}
      <a href="{{ route('menus.index') }}"
         class="absolute left-0 inline-flex items-center gap-2 bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-full shadow">
        <i class="fa-solid fa-backward"></i>
        <span class="hidden sm:inline font-medium">Back</span>
      </a>

      {{-- Title centered --}}
      <h1 class="text-center text-2xl sm:text-3xl font-bold text-blue-700">
        Create Menu
      </h1>
    </div>

    {{-- Card --}}
    <div class="bg-white shadow-lg rounded-2xl p-8">

      {{-- Validation errors --}}
      @if($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-100 text-red-700 rounded-xl">
          <strong>Periksa input:</strong>
          <ul class="mt-2 list-disc list-inside">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Nama --}}
        <div>
          <label class="block mb-2 text-sm font-semibold text-gray-700">Nama Makanan</label>
          <input type="text" name="name" value="{{ old('name') }}"
                 placeholder="Masukkan Nama Makanan"
                 class="input-light w-full rounded-xl px-4 py-3"
                 required aria-label="Nama menu">
          @error('name') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
        </div>

        {{-- Harga --}}
        <div>
          <label class="block mb-2 text-sm font-semibold text-gray-700">Harga (Rp)</label>
          <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                 placeholder="Masukkan Harga"
                 class="input-light w-full rounded-xl px-4 py-3"
                 required aria-label="Harga menu">
          @error('price') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
        </div>

        {{-- Category & Location (two columns) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block mb-2 text-sm font-semibold text-gray-700">Kategori</label>
            <select name="category_id" class="input-light w-full rounded-xl px-4 py-3" aria-label="Kategori">
              <option value="">-- Pilih Kategori --</option>
              @isset($categories)
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                  </option>
                @endforeach
              @endisset
            </select>
            @error('category_id') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
          </div>

          <div>
            <label class="block mb-2 text-sm font-semibold text-gray-700">Nama Kantin / Lokasi</label>
            <select name="location_id" class="input-light w-full rounded-xl px-4 py-3" aria-label="Nama Kantin">
              <option value="">-- Pilih Kantin --</option>
              @isset($locations)
                @foreach($locations as $loc)
                  <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>
                    {{ $loc->name }}
                  </option>
                @endforeach
              @endisset
            </select>
            @error('location_id') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
          </div>
        </div>

        {{-- Deskripsi --}}
        <div>
          <label class="block mb-2 text-sm font-semibold text-gray-700">Deskripsi</label>
          <textarea name="description" rows="4"
                    placeholder="Masukkan Deskripsi"
                    class="input-light w-full rounded-xl px-4 py-3"
                    aria-label="Deskripsi">{{ old('description') }}</textarea>
          @error('description') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
        </div>

        {{-- Upload Gambar (custom, filename + button) --}}
        <div>
          <label class="block mb-2 text-sm font-semibold text-gray-700">Upload Gambar</label>

          <div class="file-wrap flex items-center justify-between border border-gray-300 rounded-xl overflow-hidden">
            {{-- left text --}}
            <div id="fileLabel" class="flex-1 px-4 py-3 text-gray-500">
              Tidak ada File
            </div>

            {{-- button on right --}}
            <label for="profileFileInput" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-r-xl cursor-pointer">
              Pilih File
            </label>

            {{-- hidden actual input --}}
            <input id="profileFileInput" type="file" name="image" accept="image/*" class="hidden" />
          </div>

          @error('image') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
        </div>

        {{-- Buttons (Submit centered) --}}
        <div class="flex justify-center pt-4">
          <button type="submit" class="btn-submit px-6 py-2 rounded-xl text-white font-semibold shadow">
            Submit
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

{{-- Styles to match screenshot --}}
<style>
/* light rounded inputs */
.input-light {
  background: #f8fafc; /* very light */
  border: 1.5px solid #0f1724; /* dark thin border to match screenshot */
  color: #0f1724;
  box-shadow: none;
  transition: box-shadow .15s, border-color .15s;
}

/* inner rounded border a bit larger */
.input-light:focus {
  outline: none;
  box-shadow: 0 3px 10px rgba(2,6,23,0.06);
  border-color: #0f1724;
}

/* file wrapper */
.file-wrap {
  background: #f8fafc;
  border-right: none; /* right side covered by button */
}

/* ensure the right-side button is visually connected */
.file-wrap label {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 92px;
  border-left: 1px solid rgba(255,255,255,0.06);
}

/* submit button */
.btn-submit {
  background: linear-gradient(180deg,#2563eb,#1e40af); /* blue gradient */
  padding: 10px 26px;
  border-radius: 12px;
  box-shadow: 0 6px 14px rgba(37,99,235,0.18);
}

/* small devices make spacing comfortable */
@media (max-width: 640px) {
  .file-wrap { flex-direction: row; }
  .file-wrap #fileLabel { padding-left: 12px; padding-right: 8px; }
}
</style>

{{-- JS to update filename text when user picks a file --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('profileFileInput');
  const label = document.getElementById('fileLabel');

  if (!input || !label) return;

  input.addEventListener('change', function (e) {
    const f = e.target.files && e.target.files[0];
    if (!f) {
      label.textContent = 'Tidak ada File';
      return;
    }

    label.textContent = f.name;
  });
});
</script>

@endsection
