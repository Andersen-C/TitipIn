{{-- resources/views/titiper/menu/payment_summary.blade.php --}}
@extends('template.afterLogin.TitiperAfterLogin')

@section('Title', 'Payment Summary')

@section('Content')
    <div class="max-w-6xl mx-auto px-4 py-6">

        <h1 class="text-2xl font-extrabold text-blue-800 mb-4">{{__('titiper.PaymentSummaryPage.Title')}}</h1>

        <form id="mainOrderForm" action="{{ route('titiper.menu.storeOrder', $menu->id) }}" method="POST">
            @csrf

            {{-- Hidden Data --}}
            <input type="hidden" name="qty" id="hiddenQty" value="{{ $qty }}">
            <input type="hidden" name="note" id="hiddenNote" value="{{ $note }}">
            <input type="hidden" name="pickup_location_id" value="{{ $menu->location_id }}">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- === BAGIAN KIRI (2 Kolom) === --}}
                <div class="lg:col-span-2 space-y-4">

                    {{-- 1. Card Menu Item --}}
                    <div
                        class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 flex flex-col sm:flex-row gap-5 items-stretch">

                        {{-- GAMBAR: Diperbesar (w-52 h-auto) agar card jadi lebih tinggi menyamai kanan --}}
                        <div
                            class="w-full sm:w-52 bg-slate-100 rounded-lg overflow-hidden flex-shrink-0 relative min-h-[180px]">
                            <img src="{{ $imgUrl }}" alt="{{ $menu->name }}"
                                class="absolute inset-0 w-full h-full object-cover">
                        </div>

                        {{-- DETAIL --}}
                        <div class="flex-1 flex flex-col justify-between py-1">
                            <div>
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h2 class="text-xl font-bold text-slate-800 leading-tight">{{ $menu->name }}</h2>
                                        <div class="text-slate-600 mt-1 font-medium" data-price="{{ $menu->price }}"
                                            id="menuPriceDisplay">
                                            Rp. {{ number_format($menu->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Notes Box --}}
                                <div class="mt-3">
                                    <label class="text-xs font-bold text-slate-400 mb-1 block">{{__('titiper.PaymentSummaryPage.Notes')}}:</label>

                                    <div id="noteDisplayGroup"
                                        class="bg-slate-50 border rounded-lg p-2 text-sm text-slate-600 relative group min-h-[3rem]">
                                        <p id="noteTextDisplay" class="italic line-clamp-2">
                                            {{ $note ?: __('titiper.PaymentSummaryPage.NoNotes') }}</p>
                                    </div>

                                    {{-- Input Edit Note (Hidden) --}}
                                    <div id="noteInputGroup" class="hidden">
                                        <textarea id="noteTextarea" rows="2" maxlength="200"
                                            class="w-full border border-slate-300 rounded-lg p-2 text-sm text-slate-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-slate-400 resize-none">{{ $note }}</textarea>
                                        <div class="flex justify-end gap-2 mt-2">
                                            <button type="button" onclick="cancelEditNote()"
                                                class="text-xs px-3 py-1 bg-slate-200 rounded text-slate-600 hover:bg-slate-300">{{__('titiper.PaymentSummaryPage.Cancel')}}</button>
                                            <button type="button" onclick="saveNote()"
                                                class="text-xs px-3 py-1 bg-blue-600 rounded text-white hover:bg-blue-700">{{__('titiper.PaymentSummaryPage.Save')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Bottom Actions: Edit & Qty --}}
                            <div class="flex justify-between items-end mt-3">
                                <button type="button" onclick="toggleEditNote()"
                                    class="text-xs font-bold text-slate-500 hover:text-blue-600 flex items-center gap-1 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    {{__('titiper.PaymentSummaryPage.Edit')}}
                                </button>

                                {{-- Qty Selector --}}
                                <div class="flex items-center border border-slate-200 rounded-lg bg-white">
                                    <button type="button" onclick="updateQty(-1)"
                                        class="w-8 h-8 flex items-center justify-center text-slate-500 hover:bg-slate-100 hover:text-blue-600 rounded-l-lg transition">-</button>
                                    <input type="text" id="visibleQty" value="{{ $qty }}" readonly
                                        class="w-10 h-8 text-center text-sm font-bold text-slate-700 bg-white focus:outline-none border-x border-slate-100">
                                    <button type="button" onclick="updateQty(1)"
                                        class="w-8 h-8 flex items-center justify-center text-slate-500 hover:bg-slate-100 hover:text-blue-600 rounded-r-lg transition">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Card Lokasi --}}
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 space-y-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">{{__('titiper.PaymentSummaryPage.Pickup')}}</label>
                            <input type="text" value="{{ $menu->location->name ?? __('titiper.PaymentSummaryPage.PickupUnknown') }}"
                                readonly
                                class="w-full border border-slate-200 bg-slate-100 text-slate-500 rounded-lg px-3 py-2 text-sm focus:outline-none cursor-not-allowed">
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <label class="block text-xs font-bold text-slate-800">{{__('titiper.PaymentSummaryPage.Delivery')}}</label>
                                {{-- Quick Add Location Trigger --}}
                                <button type="button" onclick="openLocModal()"
                                    class="text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline flex items-center gap-1">
                                    + {{__('titiper.PaymentSummaryPage.AddLocation')}}
                                </button>
                            </div>

                            <select id="deliverySelect" name="delivery_location_id"
                                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-900 bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                @foreach ($locations as $loc)
                                    <option value="{{ $loc->id }}"
                                        {{ auth()->user()->location_id == $loc->id ? 'selected' : '' }}>
                                        {{ $loc->name }}
                                        ({{ $loc->formatted_floor ?? __('titiper.PaymentSummaryPage.floor') . $loc->floor_number }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-[10px] text-slate-400 mt-1">*{{__('titiper.PaymentSummaryPage.DeliveryNote')}}</p>
                        </div>
                    </div>

                </div>

                {{-- === BAGIAN KANAN (1 Kolom) === --}}
                <div class="lg:col-span-1 space-y-4">

                    {{-- 3. Card Metode Pembayaran --}}
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100">
                        <h3 class="font-bold text-slate-800 mb-3 text-sm">{{__('titiper.PaymentSummaryPage.PaymentMethod')}}</h3>

                        <label
                            class="flex items-start gap-3 p-3 border rounded-lg cursor-pointer hover:bg-blue-50 transition border-blue-500 bg-blue-50 relative">
                            <input type="radio" name="payment_method" value="cash" checked
                                class="mt-1 text-blue-600 focus:ring-blue-500">
                            <div>
                                <span class="block font-bold text-slate-800 text-sm">{{__('titiper.PaymentSummaryPage.CashOnDelivery')}}</span>
                                <span class="text-[10px] text-slate-500">{{__('titiper.PaymentSummaryPage.CashOnDeliverySub')}}</span>
                            </div>
                            <div class="absolute top-3 right-3 text-blue-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </label>

                        <div class="mt-2 p-3 border rounded-lg opacity-60 cursor-not-allowed bg-slate-50">
                            <div class="flex items-center gap-3">
                                <span class="block font-bold text-slate-500 text-sm">{{__('titiper.PaymentSummaryPage.BankTransfer')}}</span>
                            </div>
                            <span class="text-[10px] text-slate-400 mt-1 block">{{__('titiper.PaymentSummaryPage.PaymentNotes')}}</span>
                        </div>
                    </div>

                    {{-- 4. Card Summary & Button --}}
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100">
                        <div class="space-y-2 text-sm text-slate-600 mb-4">
                            <div class="flex justify-between">
                                <span>{{__('titiper.PaymentSummaryPage.Subtotal')}}</span>
                                <span id="subtotalDisplay">Rp. {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>{{__('titiper.PaymentSummaryPage.Service')}}</span>
                                <span>Rp. {{ number_format($serviceFee, 0, ',', '.') }}</span>
                            </div>
                            <hr class="border-slate-200 my-2">
                            <div class="flex justify-between font-bold text-lg text-slate-800">
                                <span>{{__('titiper.PaymentSummaryPage.Total')}}</span>
                                <span id="totalPriceDisplay">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 rounded-xl shadow-lg transition transform hover:-translate-y-0.5">
                            {{__('titiper.PaymentSummaryPage.TitipNow')}}
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    {{-- MODAL TAMBAH LOKASI --}}
    <div id="locModal"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 transition-opacity backdrop-blur-sm">
        <div class="bg-white rounded-xl w-full max-w-sm p-6 mx-4 shadow-2xl relative animate-fadeIn">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-slate-800">{{__('titiper.PaymentSummaryPage.AddNewLocations')}}</h3>
                <button type="button" onclick="closeLocModal()" class="text-slate-400 hover:text-slate-600">✕</button>
            </div>

            {{-- ALERT MESSAGE CONTAINER --}}
            <div id="modalAlert" class="hidden mb-4 p-3 rounded-lg text-sm font-medium"></div>

            <form id="quickLocForm">
                @csrf
                <div class="space-y-4">

                    {{-- INPUT NAMA --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1">{{__('titiper.PaymentSummaryPage.AddNewLocationName')}}</label>
                        <input type="text" name="name" id="newLocName" placeholder="{{__('titiper.PaymentSummaryPage.AddNewLocationNamePlaceholder')}}"
                            class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-slate-400 transition-colors">

                        {{-- Error Message Placeholders --}}
                        <p id="error-name" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>

                    {{-- INPUT LANTAI --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1">{{__('titiper.PaymentSummaryPage.AddNewLocationFloor')}}</label>
                        <input type="number" name="floor_number" id="newLocFloor" placeholder="{{__('titiper.PaymentSummaryPage.AddNewLocationFloorPlaceholder')}}"
                            class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-slate-400 transition-colors">

                        {{-- Error Message Placeholders --}}
                        <p id="error-floor_number" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="button" onclick="closeLocModal()"
                        class="flex-1 py-2 border border-slate-300 rounded-lg text-slate-600 text-sm font-semibold hover:bg-slate-50">{{__('titiper.PaymentSummaryPage.Cancel')}}</button>
                    <button type="submit" id="saveLocBtn"
                        class="flex-1 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 shadow-sm transition">{{__('titiper.PaymentSummaryPage.Save')}}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // --- DATA ---
        const basePrice = {{ $menu->price }};
        const serviceFee = {{ $serviceFee }};
        let currentQty = {{ $qty }};

        // --- ELEMENTS UTAMA ---
        const visibleQty = document.getElementById('visibleQty');
        const hiddenQty = document.getElementById('hiddenQty');
        const subtotalDisplay = document.getElementById('subtotalDisplay');
        const totalPriceDisplay = document.getElementById('totalPriceDisplay');
        const noteDisplayGroup = document.getElementById('noteDisplayGroup');
        const noteInputGroup = document.getElementById('noteInputGroup');
        const noteTextarea = document.getElementById('noteTextarea');
        const noteTextDisplay = document.getElementById('noteTextDisplay');
        const hiddenNote = document.getElementById('hiddenNote');

        // --- UTILS ---
        const formatRupiah = (num) => 'Rp. ' + new Intl.NumberFormat('id-ID').format(num);

        // --- LOGIC QTY & NOTE (Tetap Sama) ---
        function updateQty(change) {
            let newQty = currentQty + change;
            if (newQty < 1) newQty = 1;
            if (newQty > 99) newQty = 99;
            currentQty = newQty;
            visibleQty.value = currentQty;
            hiddenQty.value = currentQty;
            const newSubtotal = basePrice * currentQty;
            const newTotal = newSubtotal + serviceFee;
            subtotalDisplay.innerText = formatRupiah(newSubtotal);
            totalPriceDisplay.innerText = formatRupiah(newTotal);
        }

        function toggleEditNote() {
            noteDisplayGroup.classList.add('hidden');
            noteInputGroup.classList.remove('hidden');
            noteTextarea.focus();
        }

        function cancelEditNote() {
            noteTextarea.value = hiddenNote.value;
            noteInputGroup.classList.add('hidden');
            noteDisplayGroup.classList.remove('hidden');
        }

        function saveNote() {
            const newVal = noteTextarea.value.trim();
            hiddenNote.value = newVal;
            noteTextDisplay.innerText = newVal ? newVal : 'Tidak ada catatan';
            noteTextDisplay.classList.toggle('italic', !newVal);
            noteInputGroup.classList.add('hidden');
            noteDisplayGroup.classList.remove('hidden');
        }

        // --- MODAL LOKASI (Diperbarui dengan Error Handling & Alert) ---
        const locModal = document.getElementById('locModal');
        const locForm = document.getElementById('quickLocForm');
        const deliverySelect = document.getElementById('deliverySelect');
        const saveLocBtn = document.getElementById('saveLocBtn');
        const modalAlert = document.getElementById('modalAlert');

        function openLocModal() {
            locModal.classList.remove('hidden');
            locModal.classList.add('flex');

            // Bersihkan error dan alert setiap kali modal dibuka
            resetValidationErrors();
            modalAlert.classList.add('hidden');

            document.getElementById('newLocName').focus();
        }

        function closeLocModal() {
            locModal.classList.add('hidden');
            locModal.classList.remove('flex');
            // Reset form hanya jika sukses/cancel (dihandle manual nanti)
            // locForm.reset(); 
        }

        // Fungsi Helper untuk Reset Error UI
        function resetValidationErrors() {
            // Sembunyikan pesan error
            document.querySelectorAll('[id^="error-"]').forEach(el => {
                el.classList.add('hidden');
                el.innerText = '';
            });
            // Reset warna border input
            document.querySelectorAll('#quickLocForm input').forEach(el => {
                el.classList.remove('border-red-500', 'focus:ring-red-500');
                el.classList.add('border-slate-300', 'focus:ring-blue-500');
            });
        }

        // Fungsi Helper untuk Tampilkan Error pada Input Spesifik
        function showValidationError(field, message) {
            const inputEl = document.getElementById('newLoc' + (field === 'name' ? 'Name' : 'Floor'));
            const errorEl = document.getElementById('error-' + field);

            if (inputEl && errorEl) {
                // Ubah border jadi merah
                inputEl.classList.remove('border-slate-300', 'focus:ring-blue-500');
                inputEl.classList.add('border-red-500', 'focus:ring-red-500');

                // Tampilkan pesan teks
                errorEl.innerText = message;
                errorEl.classList.remove('hidden');
            }
        }

        // Fungsi Helper untuk Alert (Sukses/Gagal Global)
        function showAlert(type, message) {
            modalAlert.className =
                `mb-4 p-3 rounded-lg text-sm font-medium ${type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`;
            modalAlert.innerText = message;
            modalAlert.classList.remove('hidden');
        }

        // --- HANDLE SUBMIT AJAX ---
        locForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // 1. UI Loading State
            const originalText = saveLocBtn.innerText;
            saveLocBtn.innerText = 'Menyimpan...';
            saveLocBtn.disabled = true;
            resetValidationErrors();
            modalAlert.classList.add('hidden');

            const formData = new FormData(locForm);

            fetch("{{ route('titiper.location.quickStore') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json' 
                    }
                })
                .then(async response => {
                    const data = await response.json();

                    if (response.status === 422) {
                        for (const [field, messages] of Object.entries(data.errors)) {
                            showValidationError(field, messages[0]);
                        }
                        throw new Error('Cek kembali inputan kamu.');
                    }

                    if (!response.ok) {
                        throw new Error(data.message || 'Terjadi kesalahan server.');
                    }

                    return data;
                })
                .then(data => {
                    if (data.status === 'success') {
                        showAlert('success', data.message);

                        const newOption = new Option(`${data.location.name} (${data.formatted_floor})`, data
                            .location.id, true, true);
                        deliverySelect.add(newOption, undefined);
                        deliverySelect.value = data.location.id;

                        setTimeout(() => {
                            closeLocModal();
                            locForm.reset();
                            modalAlert.classList.add('hidden');
                        }, 1000);
                    } else {
                        showAlert('error', data.message);
                    }
                })
                .catch(err => {
                    showAlert('error', err.message);
                })
                .finally(() => {
                    saveLocBtn.innerText = originalText;
                    saveLocBtn.disabled = false;
                });
        });
    </script>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        background: inherit !important;
        border: none;
        width: 16px;
        height: 100%;
    }

    input[type=number] {
        -moz-appearance: textfield;
        background-color: inherit !important;
    }
</style>
@endsection
