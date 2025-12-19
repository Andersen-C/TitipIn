{{-- resources/views/titiper/menu/show.blade.php --}}
@extends('template.afterLogin.TitiperAfterLogin')

@section('Title', $menu->name ?? 'Menu Detail')

@section('Content')
<div class="max-w-7xl mx-auto px-6 py-10">
  <div class="bg-white rounded-lg p-8 shadow-sm border">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">{{__('titiper.MenuDetailPage.Title')}}</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
      
      {{-- LEFT: IMAGE --}}
      <div class="lg:col-span-1">
        <div class="bg-white rounded-lg p-4 border shadow-sm">
          @php
            $placeholder = 'https://via.placeholder.com/800x600';
            $imgUrl = $placeholder;

            if (!empty($menu->image)) {
                // full absolute URL?
                if (Str::startsWith($menu->image, ['http://', 'https://'])) {
                    $imgUrl = $menu->image;
                }
                // already contains /storage or storage/
                elseif (Str::startsWith($menu->image, ['/storage/', 'storage/'])) {
                    $imgUrl = asset(ltrim($menu->image, '/'));
                }
                else {
                    // assume stored on public disk (storage/app/public/...)
                    $imgUrl = asset('storage/' . ltrim($menu->image, '/'));
                }
            }
          @endphp

          <img src="{{ $imgUrl }}"
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

            {{-- LOCATION (with SVG icon) --}}
            @if($menu->location)
              <div class="mt-1 flex items-center gap-2 text-sm text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M12 2C8.14 2 5 5.14 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.86-3.14-7-7-7zm0 9.5c-1.38 
                           0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/>
                </svg>
                <span class="leading-tight">{{ $menu->location->name }}</span>
              </div>
            @endif

            {{-- RATING + NOTES --}}
            <div class="mt-4 flex items-center gap-3">

              <div class="inline-flex items-center gap-2 px-3 py-1 rounded bg-yellow-50 text-yellow-800 text-sm">
                ⭐ {{ number_format($rating ?? 0, 1) }}
              </div>

              <button id="openNotesBtn"
                class="px-3 py-1 text-sm border rounded bg-slate-50 text-slate-700 hover:bg-slate-100">
                {{__('titiper.MenuDetailPage.Notes')}}
              </button>
            </div>

            {{-- DESCRIPTION --}}
            <p class="mt-4 text-slate-600 max-w-3xl">
              {{ $menu->description ?? 'Deskripsi tidak tersedia.' }}
            </p>

            {{-- ETA --}}
            <div class="mt-4">
              <div class="inline-flex items-center gap-1 text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded-md w-fit">
                ⏱ {{ $estMinutes ?? 20 }} {{__('titiper.MenuDetailPage.Time')}}
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
                <label class="block text-sm text-slate-600 mb-2">{{__('titiper.MenuDetailPage.Amount')}}</label>

                <div class="flex items-center gap-3">
                  <button type="button" id="qtyMinus"
                    class="w-10 h-10 cursor-pointer hover:bg-slate-200 bg-slate-100 text-slate-700 rounded-lg flex items-center justify-center text-lg font-bold"
                    aria-label="Kurangi jumlah">
                    −
                  </button>

                  <input type="text" id="qty" name="qty" value="1" readonly
                    class="w-16 text-center border rounded-lg py-2 bg-white text-slate-800 font-semibold shadow-sm">

                  <button type="button" id="qtyPlus"
                    class="w-10 h-10 cursor-pointer hover:bg-slate-200 bg-slate-100 text-slate-700 rounded-lg flex items-center justify-center text-lg font-bold"
                    aria-label="Tambah jumlah">
                    +
                  </button>
                </div>
              </div>

              {{-- BUTTON --}}
              <button type="button" id="titipSekarangBtn"
                class="w-full bg-blue-700 hover:bg-blue-800 cursor-pointer text-white py-3 rounded-xl text-lg font-semibold shadow-md  transition">
                {{__('titiper.MenuDetailPage.TitipNow')}}
              </button>

            </form>

            <div class="mt-4 text-center">
              <a href="{{ route('titiper.menu.index') }}" class="text-sm text-slate-500 underline">
                {{ __('titiper.MenuDetailPage.Back') }}
              </a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

{{-- NOTES MODAL --}}
<div id="notesModal"
  class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

  <div id="notesModalBox" class="bg-white rounded-lg w-full max-w-2xl p-6 mx-4 shadow-xl relative">

    <div class="flex justify-between items-start">
      <h3 class="text-lg font-semibold text-slate-800">{{__('titiper.MenuDetailPage.NotesModalTitle')}}</h3>
      <button id="closeNotesBtn" class="text-slate-400 hover:text-slate-600" aria-label="Close notes">✕</button>
    </div>

    <hr class="my-4">

    <textarea id="modalNoteTextarea"
      class="w-full min-h-[160px] border-b border-slate-300 pb-4 text-slate-700 focus:outline-none"
      placeholder="{{__('titiper.MenuDetailPage.NotesModalPlaceholder')}}"
      maxlength="200"></textarea>

    <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
        <span class="text-xs text-slate-400 order-2 sm:order-1"><span id="charCount">0</span>/200</span>
    
        <div class="flex items-center gap-3 order-1 sm:order-2 w-full sm:w-auto">
            <button type="button" id="modalSkipBtn" 
            class="flex-1 sm:flex-none px-4 py-2 border border-slate-300 text-slate-600 rounded-md hover:bg-slate-50 font-medium transition">
            {{__('titiper.MenuDetailPage.NotesModalButton1')}}
            </button>

            <button type="button" id="modalSaveBtn" 
            class="flex-1 sm:flex-none px-6 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 font-semibold shadow transition">
            {{__('titiper.MenuDetailPage.NotesModalButton2')}}
            </button>
        </div>
    </div>

  </div>
</div>

{{-- JS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const plus = document.getElementById("qtyPlus");
  const minus = document.getElementById("qtyMinus");
  const qty = document.getElementById("qty");
  
  const orderForm = document.getElementById('orderForm');
  const noteInput = document.getElementById('noteInput');
  const titipSekarangBtn = document.getElementById('titipSekarangBtn'); 

  const openNotesBtn = document.getElementById("openNotesBtn"); 
  const notesModal = document.getElementById("notesModal");
  const closeNotesBtn = document.getElementById("closeNotesBtn");
  
  // Modal Action Buttons
  const saveBtn = document.getElementById("modalSaveBtn");
  const skipBtn = document.getElementById("modalSkipBtn");
  
  const noteText = document.getElementById("modalNoteTextarea");
  const charCount = document.getElementById("charCount");

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

  function showModal() {
    noteText.value = noteInput.value || '';
    charCount.innerText = noteText.value.length;
    
    notesModal.classList.remove('hidden');
    notesModal.classList.add('flex');
    noteText.focus();
  }

  function closeModal() {
    notesModal.classList.add('hidden');
    notesModal.classList.remove('flex');
  }

  if(titipSekarangBtn) {
    titipSekarangBtn.addEventListener('click', function() {
      showModal();
    });
  }

  if(openNotesBtn) {
    openNotesBtn.addEventListener('click', function() {
      showModal();
    });
  }

  if(closeNotesBtn) closeNotesBtn.addEventListener('click', closeModal);
  
  if(notesModal) {
    notesModal.addEventListener('click', function(e) {
      if (e.target === notesModal) closeModal();
    });
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && notesModal && !notesModal.classList.contains('hidden')) closeModal();
  });

  if(noteText) {
    noteText.addEventListener('input', () => {
      charCount.innerText = noteText.value.length;
    });
  }

  if(saveBtn) {
    saveBtn.addEventListener('click', () => {
      noteInput.value = noteText.value.trim();
      orderForm.submit();
    });
  }

  if(skipBtn) {
    skipBtn.addEventListener('click', () => {
      noteInput.value = ''; 
      orderForm.submit();
    });
  }

  if(orderForm) {
    orderForm.addEventListener('submit', function () {
      const q = parse(qty.value);
      if (q < 1) qty.value = '1';
      if (q > 99) qty.value = '99';
    });
  }
});
</script>

@endsection
