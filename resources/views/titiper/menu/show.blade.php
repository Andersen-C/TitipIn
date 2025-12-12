{{-- resources/views/titiper/menu/show.blade.php --}}
@extends('template.afterLogin.TitiperAfterLogin')

@section('Title', $menu->name ?? 'Detail Menu')

@section('Content')
<div class="max-w-7xl mx-auto px-6 py-10">
  <div class="bg-white rounded-lg p-8 shadow-sm border">
    <h2 class="text-2xl font-semibold text-sky-700 mb-6">Detail Menu</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
      
      {{-- LEFT: IMAGE --}}
      <div class="lg:col-span-1">
        <div class="bg-white rounded-lg p-4 border shadow-sm">
          <img src="{{ $menu->image ?? 'https://via.placeholder.com/800x600' }}"
               alt="{{ $menu->name }}"
               class="w-full h-64 object-cover rounded-md">
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
          <div class="w-full lg:w-72 mt-10 lg:mt-24"> {{-- diturunkan sedikit di lg --}}
            <form id="orderForm" action="{{ route('titiper.menu.createOrder', $menu->id) }}" method="POST">
              @csrf

              {{-- HIDDEN INPUT NOTE --}}
              <input type="hidden" name="note" id="noteInput" value="">

              {{-- QTY --}}
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

              {{-- BUTTON --}}
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

{{-- ===========================
       NOTES MODAL
   =========================== --}}
<div id="notesModal"
  class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

  <div id="notesModalBox" class="bg-white rounded-lg w-full max-w-2xl p-6 mx-4 shadow-xl relative">

    <div class="flex justify-between items-start">
      <h3 class="text-lg font-semibold text-slate-800">Add notes to your dish</h3>
      <button id="closeNotesBtn" class="text-slate-400 hover:text-slate-600" aria-label="Close notes">✕</button>
    </div>

    <hr class="my-4">

    <textarea id="modalNoteTextarea"
      class="w-full min-h-[160px] border-b border-slate-300 pb-4 text-slate-700 focus:outline-none"
      placeholder="Tambahin catatan (opsional)..."
      maxlength="200"></textarea>

    <div class="mt-4 flex items-center justify-between">
      <span class="text-xs text-slate-400"><span id="charCount">0</span>/200</span>
      <button id="modalSaveBtn" class="px-4 py-2 bg-sky-600 text-white rounded-md">
        Simpan
      </button>
    </div>

  </div>
</div>

{{-- ===========================
         JS
   =========================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

  // QTY BUTTONS
  const plus = document.getElementById("qtyPlus");
  const minus = document.getElementById("qtyMinus");
  const qty = document.getElementById("qty");
  const orderForm = document.getElementById('orderForm');
  const noteInput = document.getElementById('noteInput');

  // helper safe parse
  const parse = v => {
    const n = parseInt(v, 10);
    return isNaN(n) ? 1 : n;
  };

  plus.addEventListener("click", () => {
    qty.value = String(Math.min(99, parse(qty.value) + 1));
  });
  minus.addEventListener("click", () => {
    qty.value = String(Math.max(1, parse(qty.value) - 1));
  });

  // NOTES MODAL
  const openNotesBtn = document.getElementById("openNotesBtn");
  const notesModal = document.getElementById("notesModal");
  const notesModalBox = document.getElementById("notesModalBox");
  const closeNotesBtn = document.getElementById("closeNotesBtn");
  const saveBtn = document.getElementById("modalSaveBtn");
  const noteText = document.getElementById("modalNoteTextarea");
  const charCount = document.getElementById("charCount");

  // open modal, fill with current note
  openNotesBtn && openNotesBtn.addEventListener('click', () => {
    noteText.value = noteInput.value || '';
    charCount.innerText = noteText.value.length;
    notesModal.classList.remove('hidden');
    notesModal.classList.add('flex');
    noteText.focus();
  });

  // close
  closeNotesBtn && closeNotesBtn.addEventListener('click', closeModal);
  function closeModal() {
    notesModal.classList.add('hidden');
    notesModal.classList.remove('flex');
  }

  // click outside to close
  notesModal && notesModal.addEventListener('click', function(e) {
    if (e.target === notesModal) closeModal();
  });

  // esc to close
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !notesModal.classList.contains('hidden')) closeModal();
  });

  // save note to hidden input
  saveBtn && saveBtn.addEventListener('click', () => {
    noteInput.value = noteText.value.trim();
    closeModal();
  });

  // char counter
  noteText && noteText.addEventListener('input', () => {
    charCount.innerText = noteText.value.length;
  });

  // before submit, ensure note and qty are set in inputs (qty is already name="qty")
  orderForm && orderForm.addEventListener('submit', function () {
    // qty input named 'qty' already sent; ensure it's valid
    const q = parse(qty.value);
    if (q < 1) qty.value = '1';
    if (q > 99) qty.value = '99';

    // make sure noteInput contains final textarea value (if user didn't click Simpan)
    // If they typed in modal but didn't click Simpan, pick it up now:
    if (noteText && noteText.value.trim() && noteInput.value.trim() === '') {
      noteInput.value = noteText.value.trim();
    }
  });

});
</script>

@endsection
