{{-- resources/views/titiper/menu/show.blade.php --}}
@extends('template.afterLogin.TitiperAfterLogin')

@section('Title', $menu->name ?? 'Detail Menu')

@section('Content')
@php
    // pick image: prefer $menu->image (full URL or path), else $menu->image_path (local storage path)
    $rawImage = $menu->image ?? $menu->image_path ?? null;

    // if it's a storage path (not full URL), convert to asset('storage/...')
    $imgSrc = null;
    if ($rawImage) {
        // if already looks like a full URL
        if (str_starts_with($rawImage, 'http://') || str_starts_with($rawImage, 'https://')) {
            $imgSrc = $rawImage;
        } else {
            // assume it's a storage path (e.g. "menus/abc.jpg" or "storage/menus/abc.jpg")
            // normalize: if it already starts with "storage/" strip it
            $p = preg_replace('#^storage/#', '', $rawImage);
            $imgSrc = asset('storage/' . $p);
        }
    }

    // final fallback
    $placeholder = 'https://via.placeholder.com/800x600?text=No+Image';
@endphp

<div class="max-w-7xl mx-auto px-6 py-10">
  <div class="bg-white rounded-lg p-8 shadow-sm border">
    <h2 class="text-2xl font-semibold text-sky-700 mb-6">Detail Menu</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

      {{-- LEFT: IMAGE --}}
      <div class="lg:col-span-1">
        <div class="bg-white rounded-lg p-4 border shadow-sm">
          <img
            src="{{ $imgSrc ?? $placeholder }}"
            alt="{{ $menu->name }}"
            class="w-full h-64 object-cover rounded-md"
            onerror="this.onerror=null;this.src='{{ $placeholder }}';"
          >
        </div>
      </div>

      {{-- RIGHT --}}
      <div class="lg:col-span-2">
        <div class="flex flex-col lg:flex-row lg:items-start gap-6">

          {{-- LEFT TEXT --}}
          <div class="flex-1">
            <h1 class="text-3xl font-bold text-slate-900">
              {{ $menu->name }}
            </h1>

            <div class="mt-2 text-slate-600 text-lg">
              Rp. {{ number_format($menu->price ?? 0, 0, ',', '.') }}
            </div>

            {{-- CATEGORY --}}
            @if($menu->category)
              <div class="mt-3 flex items-center gap-2 text-sm text-slate-500">
                <span class="w-3 h-3 rounded-full bg-slate-300 inline-block"></span>
                {{ $menu->category->name }}
              </div>
            @endif

            {{-- LOCATION (baru ditambahkan) --}}
            @if(isset($menu->location) && $menu->location)
              @php
                $loc = $menu->location;
                $hasCoords = !empty($loc->lat) && !empty($loc->lng);
                // google maps link if coordinates exist, else null
                $mapsLink = $hasCoords ? "https://www.google.com/maps/search/?api=1&query={$loc->lat},{$loc->lng}" : null;
              @endphp

              <div class="mt-3 flex items-start gap-3 text-sm text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 mt-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.05 8.05a7 7 0 119.9 0L10 18.99 5.05 8.05zM10 10.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" clip-rule="evenodd"/>
                </svg>

                <div class="flex flex-col">
                  {{-- name (link ke halaman lokasi jika ada route locations.show) --}}
                  @if(Route::has('locations.show'))
                    <a href="{{ route('locations.show', $loc->id) }}" class="font-medium text-slate-800 hover:underline">
                      {{ $loc->name }}
                    </a>
                  @else
                    <div class="font-medium text-slate-800">
                      {{ $loc->name }}
                    </div>
                  @endif

                  {{-- optional address --}}
                  @if(!empty($loc->address))
                    <div class="text-xs text-slate-500">{{ $loc->address }}</div>
                  @endif

                  {{-- maps link if coords exist --}}
                  @if($mapsLink)
                    <a href="{{ $mapsLink }}" target="_blank" rel="noopener noreferrer"
                       class="text-xs text-sky-600 hover:underline mt-1 inline-flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M12.9 2.1L18 7.2l-1.4 1.4-3.5-3.5-5.4 5.4-1.4-1.4L12.9 2.1z"/>
                        <path d="M3 8v9h9l-1.2-1.2H4V9.2L3 8z"/>
                      </svg>
                      Lihat di Maps
                    </a>
                  @endif
                </div>
              </div>
            @endif
            {{-- end LOCATION --}}

            {{-- RATING + NOTES --}}
            <div class="mt-4 flex items-center gap-3">
              <div class="inline-flex items-center gap-2 px-3 py-1 rounded bg-yellow-50 text-yellow-800 text-sm">
                ⭐ {{ number_format($rating ?? 0, 1) }}
              </div>

              <button id="openNotesBtn"
                class="px-3 py-1 text-sm border rounded bg-slate-50 text-slate-700 hover:bg-slate-100">
                Notes
              </button>
            </div>

            {{-- DESCRIPTION --}}
            <p class="mt-4 text-slate-600 max-w-3xl">
              {{ $menu->description ?? 'Deskripsi tidak tersedia.' }}
            </p>

            {{-- ETA --}}
            <div class="mt-4">
              <div class="inline-flex items-center gap-1 text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded-md w-fit">
                ⏱ {{ $estMinutes ?? 20 }} min
              </div>
            </div>
          </div>

          {{-- RIGHT ORDER PANEL --}}
          <div class="w-full lg:w-72 mt-10 lg:mt-24">
            <form id="orderForm" action="{{ route('titiper.menu.createOrder', $menu->id) }}" method="POST">
              @csrf
              <input type="hidden" name="note" id="noteInput" value="">
              <div class="mb-6">
                <label class="block text-sm text-slate-600 mb-2">Jumlah</label>
                <div class="flex items-center gap-3">
                  <button type="button" id="qtyMinus"
                    class="w-10 h-10 bg-slate-100 text-slate-700 rounded-lg flex items-center justify-center text-lg font-bold"
                    aria-label="Kurangi jumlah">
                    −
                  </button>

                  <input type="text" id="qty" name="qty" value="1" readonly
                    class="w-16 text-center border rounded-lg py-2 bg-white text-slate-800 font-semibold shadow-sm">

                  <button type="button" id="qtyPlus"
                    class="w-10 h-10 bg-slate-100 text-slate-700 rounded-lg flex items-center justify-center text-lg font-bold"
                    aria-label="Tambah jumlah">
                    +
                  </button>
                </div>
              </div>

              <button type="submit"
                class="w-full bg-sky-600 hover:bg-sky-700 text-white py-3 rounded-xl text-lg font-semibold shadow-md">
                Titip Sekarang
              </button>
            </form>

            <div class="mt-4 text-center">
              <a href="{{ route('titiper.menu.index') }}" class="text-sm text-slate-500 underline">
                Kembali ke Menu
              </a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

{{-- NOTES MODAL --}}
<div id="notesModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
  <div id="notesModalBox" class="bg-white rounded-lg w-full max-w-2xl p-6 mx-4 shadow-xl relative">
    <div class="flex justify-between items-start">
      <h3 class="text-lg font-semibold text-slate-800">Add notes to your dish</h3>
      <button id="closeNotesBtn" class="text-slate-400 hover:text-slate-600" aria-label="Close notes">✕</button>
    </div>

    <hr class="my-4">
    <textarea id="modalNoteTextarea" class="w-full min-h-[160px] border-b border-slate-300 pb-4 text-slate-700 focus:outline-none"
      placeholder="Tambahin catatan (opsional)..." maxlength="200"></textarea>

    <div class="mt-4 flex items-center justify-between">
      <span class="text-xs text-slate-400"><span id="charCount">0</span>/200</span>
      <button id="modalSaveBtn" class="px-4 py-2 bg-sky-600 text-white rounded-md">Simpan</button>
    </div>
  </div>
</div>

{{-- JS (sama seperti sebelumnya) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  // qty, notes modal, etc. (kodemu sebelumnya - tidak saya ubah)
  const plus = document.getElementById("qtyPlus");
  const minus = document.getElementById("qtyMinus");
  const qty = document.getElementById("qty");
  const orderForm = document.getElementById('orderForm');
  const noteInput = document.getElementById('noteInput');
  const parse = v => { const n = parseInt(v, 10); return isNaN(n) ? 1 : n; };
  plus && plus.addEventListener("click", () => qty.value = String(Math.min(99, parse(qty.value) + 1)));
  minus && minus.addEventListener("click", () => qty.value = String(Math.max(1, parse(qty.value) - 1)));

  // notes modal
  const openNotesBtn = document.getElementById("openNotesBtn");
  const notesModal = document.getElementById("notesModal");
  const closeNotesBtn = document.getElementById("closeNotesBtn");
  const saveBtn = document.getElementById("modalSaveBtn");
  const noteText = document.getElementById("modalNoteTextarea");
  const charCount = document.getElementById("charCount");

  openNotesBtn && openNotesBtn.addEventListener('click', () => {
    noteText.value = noteInput.value || '';
    charCount.innerText = noteText.value.length;
    notesModal.classList.remove('hidden'); notesModal.classList.add('flex');
    noteText.focus();
  });
  closeNotesBtn && closeNotesBtn.addEventListener('click', closeModal);
  function closeModal() { notesModal.classList.add('hidden'); notesModal.classList.remove('flex'); }
  notesModal && notesModal.addEventListener('click', function(e) { if (e.target===notesModal) closeModal() });
  document.addEventListener('keydown', function(e){ if (e.key==='Escape' && !notesModal.classList.contains('hidden')) closeModal(); });
  saveBtn && saveBtn.addEventListener('click', () => { noteInput.value = noteText.value.trim(); closeModal(); });
  noteText && noteText.addEventListener('input', () => { charCount.innerText = noteText.value.length; });

  // ensure note and qty before submit
  orderForm && orderForm.addEventListener('submit', function () {
    const q = parse(qty.value);
    if (q < 1) qty.value = '1';
    if (q > 99) qty.value = '99';
    if (noteText && noteText.value.trim() && noteInput.value.trim() === '') noteInput.value = noteText.value.trim();
  });
});
</script>

@endsection
