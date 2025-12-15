@extends('template.afterLogin.TitiperAfterLogin')

@section('Title', 'Pesanan Saya')

@section('Content')
    <div class="bg-[#F9FAFB] min-h-screen pb-20 font-sans">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <div class="mb-6">
                <h1 class="text-4xl font-extrabold text-[#3B4D81]">Pesanan Saya</h1>
                <p class="text-slate-500 mt-2 text-lg">Lihat status pesananmu secara real-time.</p>
            </div>

            <div class="relative mb-8">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text" placeholder="Cek pesanan kamu disini"
                    class="w-full py-4 pl-12 pr-12 border border-slate-200 rounded-xl bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-700 placeholder-slate-400 shadow-sm transition-all">
            </div>

            <div class="flex flex-wrap gap-3 mb-8 overflow-x-auto pb-2">
                @php
                    $tabs = ['Semua', 'Menunggu', 'Sedang Dibelikan', 'Selesai', 'Dibatalkan'];
                @endphp

                @foreach ($tabs as $tab)
                    <a href="{{ route('titiper.orders.index', ['status' => $tab]) }}"
                        class="px-6 py-2 rounded-lg font-semibold text-sm transition-all whitespace-nowrap
                   {{ $currentStatus == $tab
                       ? 'bg-blue-600 text-white shadow-md'
                       : 'bg-slate-200 text-slate-600 hover:bg-slate-300' }}">
                        {{ $tab }}
                    </a>
                @endforeach
            </div>

            <div class="space-y-6">
                @forelse ($orders as $order)
                    @php
                        $firstItem = $order->orderItems->first();
                        $menu = $firstItem ? $firstItem->menu : null;

                        $imgUrl = 'https://via.placeholder.com/150';
                        if ($menu && !empty($menu->image)) {
                            if (\Illuminate\Support\Str::startsWith($menu->image, ['http://', 'https://'])) {
                                $imgUrl = $menu->image;
                            } elseif (\Illuminate\Support\Str::startsWith($menu->image, ['/storage/', 'storage/'])) {
                                $imgUrl = asset(ltrim($menu->image, '/'));
                            } else {
                                $imgUrl = asset('storage/' . ltrim($menu->image, '/'));
                            }
                        }

                        $menuName = $menu ? $menu->name : 'Item dihapus';
                        $estimasiStart = $order->created_at->addMinutes(15)->format('H:i');
                        $estimasiEnd = $order->created_at->addMinutes(45)->format('H:i');

                        $orderData = [
                            'id' => $order->id,
                            'display_id' => '#ORD-' . str_pad($order->id, 5, '0', STR_PAD_LEFT),
                            'img_url' => $imgUrl,
                            'menu_name' => $menuName,
                            'price' => number_format($firstItem->price ?? 0, 0, ',', '.'),
                            'qty' => $firstItem->quantity ?? 1,
                            'note' => $order->notes,
                            'pickup' => $order->pickupLocation->name ?? '-',
                            'delivery' =>
                                ($order->deliveryLocation->name ?? '-') .
                                ' (' .
                                ($order->deliveryLocation->formatted_floor ?? '') .
                                ')',
                            'subtotal' => number_format($order->subtotal, 0, ',', '.'),
                            'service_fee' => number_format($order->service_fee, 0, ',', '.'),
                            'total' => number_format($order->total_price, 0, ',', '.'),
                            'payment_method' => $order->payment_method == 'cash' ? 'Bayar di Tempat (COD)' : 'Transfer',
                            'status' => $order->status,
                            'cancel_reason' => $order->cancellation_reason ?? '-',
                            'cancel_note' => $order->cancellation_note ?? '',
                        ];
                    @endphp

                    <div onclick="openDetailModal({{ json_encode($orderData) }})"
                        class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-lg hover:border-blue-300 transition-all cursor-pointer flex flex-col md:flex-row gap-6 items-stretch group relative overflow-hidden">

                        @if ($order->status == 'cancelled')
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-red-400"></div>
                        @endif

                        <div
                            class="w-full md:w-48 bg-slate-50 rounded-xl overflow-hidden flex-shrink-0 relative min-h-[180px]">
                            <img src="{{ $imgUrl }}" alt="{{ $menuName }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500 {{ $order->status == 'cancelled' ? 'grayscale' : '' }}">
                        </div>

                        <div class="flex-1 flex flex-col justify-between py-1">
                            <div>
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3
                                            class="text-xl font-bold text-slate-800 group-hover:text-blue-700 transition leading-tight {{ $order->status == 'cancelled' ? 'line-through text-slate-400' : '' }}">
                                            {{ $menuName }}
                                            @if ($order->orderItems->count() > 1)
                                                <span
                                                    class="text-sm font-normal text-slate-500 block mt-1 no-underline">(+{{ $order->orderItems->count() - 1 }}
                                                    item lainnya)</span>
                                            @endif
                                        </h3>
                                        <p class="text-slate-600 font-medium mt-1">
                                            Rp. {{ number_format($firstItem->price ?? 0, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <div
                                        class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg font-bold text-sm border border-blue-100 shadow-sm">
                                        {{ $firstItem->quantity ?? 1 }}x
                                    </div>
                                </div>

                                @if ($order->status == 'cancelled')
                                    <div class="mt-3 bg-red-50 border border-red-100 rounded-lg p-2.5">
                                        <span
                                            class="text-[10px] font-bold text-red-500 uppercase tracking-wide block mb-0.5">Dibatalkan
                                            karena:</span>
                                        <p class="text-sm text-red-700 font-medium">
                                            {{ $order->cancellation_reason ?? 'Alasan tidak disebutkan' }}
                                            @if ($order->cancellation_note)
                                                <span
                                                    class="text-red-500 font-normal">({{ $order->cancellation_note }})</span>
                                            @endif
                                        </p>
                                    </div>
                                @else
                                    <div class="mt-3 bg-slate-50 border border-slate-100 rounded-lg p-2.5">
                                        <span
                                            class="text-[10px] font-bold text-slate-400 uppercase tracking-wide block mb-0.5">Note</span>
                                        <p class="text-sm text-slate-600 italic line-clamp-2 leading-snug">
                                            {{ $order->notes ?: 'Tidak ada catatan' }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <div
                                class="mt-4 pt-3 border-t border-slate-100 flex flex-wrap items-center gap-3 text-xs text-slate-500">
                                <span
                                    class="font-bold text-slate-400">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                <div class="flex items-center gap-1">
                                    <span
                                        class="font-semibold text-slate-600">{{ $order->pickupLocation->name ?? '-' }}</span>
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                    <span
                                        class="font-semibold text-blue-600">{{ $order->deliveryLocation->name ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-end justify-between h-auto gap-2 min-w-[180px] w-full md:w-auto border-t md:border-t-0 md:border-l border-slate-100 pt-4 md:pt-0 md:pl-6"
                            onclick="event.stopPropagation()">

                            <div class="text-right w-full">
                                <p class="text-xs text-slate-400 font-medium mb-1">
                                    {{ $order->created_at->format('d F Y, H:i') }}</p>
                                <p class="text-sm font-bold text-slate-700">Total: Rp.
                                    {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>

                            @if ($order->status == 'waiting_runner')
                                <div class="flex flex-col items-end gap-2 w-full">
                                    <span
                                        class="px-4 py-1 bg-[#FDF6B2] text-[#9F580A] text-xs font-bold rounded-md uppercase tracking-wide">
                                        Menunggu
                                    </span>
                                    <button
                                        onclick="openCancelModal('{{ $order->id }}', '#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}')"
                                        class="w-full py-2 bg-[#EF4444] hover:bg-red-600 text-white text-sm font-bold rounded-lg transition shadow-sm">
                                        Batalkan
                                    </button>
                                    <p class="text-[10px] text-slate-400 mt-1 text-center w-full">Estimasi:
                                        {{ $estimasiStart }} - {{ $estimasiEnd }}</p>
                                </div>
                            @elseif (in_array($order->status, ['accepted', 'arrived_at_pickup', 'item_picked', 'on_delivery', 'delivered']))
                                <div class="w-full flex flex-col items-end gap-2">
                                    <button
                                        class="w-full py-2 bg-blue-600 text-white text-sm font-bold rounded-lg cursor-default shadow-sm">
                                        Sedang Dibelikan
                                    </button>
                                    <div class="text-right">
                                        <span class="text-[10px] text-slate-400 block">Runner</span>
                                        <span
                                            class="text-xs font-bold text-slate-700">{{ $order->runner->name ?? 'Mencari...' }}</span>
                                    </div>
                                </div>
                            @elseif ($order->status == 'completed')
                                <div class="w-full flex flex-col items-end gap-2">
                                    <span
                                        class="inline-block px-4 py-2 bg-[#DEF7EC] text-[#03543F] text-sm font-bold rounded-lg w-full text-center">
                                        Selesai
                                    </span>
                                    @if (!$order->hasReview())
                                        <button
                                            onclick="openReviewModal('{{ $order->id }}', '{{ $order->runner->name ?? 'Runner' }}')"
                                            class="w-full px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-yellow-900 text-sm font-bold rounded-lg transition shadow-sm flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                </path>
                                            </svg>
                                            Nilai Runner
                                        </button>
                                    @endif
                                </div>
                            @elseif ($order->status == 'cancelled')
                                <div class="w-full text-right">
                                    <button
                                        class="w-full px-4 py-2 bg-slate-200 text-slate-500 text-sm font-bold rounded-lg cursor-not-allowed">
                                        Dibatalkan
                                    </button>
                                    <span class="text-[10px] text-red-500 font-medium block mt-1">
                                        {{ \Illuminate\Support\Str::limit($order->cancellation_reason, 20) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300">
                        <div class="flex justify-center mb-4">
                            <svg class="w-16 h-16 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <p class="text-slate-500 text-lg">Tidak ada pesanan di tab "{{ $currentStatus }}"</p>
                        <a href="{{ route('titiper.menu.index') }}"
                            class="text-blue-600 font-bold hover:underline mt-2 inline-block">Mulai Jajan Sekarang</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div id="detail_modal" class="fixed inset-0 z-[60] hidden transition-opacity duration-300">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeDetailModal()"></div>
        <div class="relative flex items-center justify-center min-h-screen px-4 py-6 pointer-events-none">
            <div
                class="bg-white w-full max-w-5xl rounded-3xl shadow-2xl overflow-hidden transform transition-all scale-100 relative pointer-events-auto max-h-[90vh] flex flex-col">

                <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-white flex-shrink-0">
                    <div>
                        <h2 class="text-2xl font-extrabold text-[#3B4D81]">Detail Pesanan</h2>
                        <p class="text-sm text-slate-400 mt-1" id="modal_display_id">#ORD-XXXX</p>
                    </div>
                    <button onclick="closeDetailModal()"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-400 hover:bg-slate-200 hover:text-slate-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div id="modal_cancel_alert"
                    class="hidden bg-red-50 border-b border-red-100 px-8 py-4 flex items-start gap-3">
                    <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h4 class="text-red-800 font-bold text-lg">Pesanan Dibatalkan</h4>
                        <p class="text-red-600 mt-1">Alasan: <span id="modal_cancel_reason" class="font-semibold"></span>
                        </p>
                        <p class="text-red-500 text-sm mt-1" id="modal_cancel_note"></p>
                    </div>
                </div>

                <div class="p-8 bg-[#F9FAFB] overflow-y-auto flex-1">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

                        {{-- KIRI --}}
                        <div class="lg:col-span-2 space-y-5">
                            <div
                                class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col sm:flex-row gap-6">
                                <div
                                    class="w-full sm:w-56 bg-slate-50 rounded-xl overflow-hidden flex-shrink-0 border border-slate-100 relative min-h-[180px]">
                                    <img id="modal_img" src="" alt="Menu"
                                        class="absolute inset-0 w-full h-full object-cover">
                                </div>
                                <div class="flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-2xl font-bold text-slate-800 leading-tight" id="modal_menu_name">
                                            Menu Name</h3>
                                        <div class="text-lg text-slate-600 mt-2 font-medium">
                                            Rp. <span id="modal_price">0</span>
                                        </div>
                                        <div class="mt-4 bg-slate-50 border border-slate-200 rounded-xl p-4">
                                            <span
                                                class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Notes</span>
                                            <p class="text-slate-700 text-sm italic" id="modal_note">Tidak ada catatan</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex justify-end">
                                        <div
                                            class="flex items-center gap-2 bg-blue-50 px-4 py-2 rounded-lg border border-blue-100">
                                            <span class="text-sm text-blue-600 font-bold">Jumlah:</span>
                                            <span class="text-lg font-extrabold text-blue-800" id="modal_qty">1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Lokasi
                                        Pengambilan (Resto)</label>
                                    <div
                                        class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                                        <div class="p-2 bg-white rounded-full text-slate-400 shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-slate-700 font-bold" id="modal_pickup">Lokasi A</span>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                    </svg>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Lokasi
                                        Tujuan (Kamu)</label>
                                    <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-xl border border-blue-200">
                                        <div class="p-2 bg-white rounded-full text-blue-500 shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                        </div>
                                        <span class="text-blue-900 font-bold" id="modal_delivery">Lokasi B</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-1 space-y-5">
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                                <h3 class="font-bold text-slate-800 mb-4">Metode Pembayaran</h3>
                                <div class="flex items-start gap-4 p-4 border rounded-xl bg-slate-50 border-slate-200">
                                    <div class="mt-1 text-blue-600">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="block font-bold text-slate-800 text-sm" id="modal_payment">Bayar di
                                            Tempat</span>
                                        <span class="text-xs text-slate-500 mt-1 block">Status: <span
                                                id="modal_status_text"
                                                class="uppercase font-bold text-blue-600">PENDING</span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                                <div class="space-y-3 text-sm text-slate-600 mb-6">
                                    <div class="flex justify-between">
                                        <span>Sub Total</span>
                                        <span class="font-medium text-slate-900">Rp. <span
                                                id="modal_subtotal">0</span></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Biaya Antar</span>
                                        <span class="font-medium text-slate-900">Rp. <span id="modal_fee">0</span></span>
                                    </div>
                                    <hr class="border-slate-200 my-3">
                                    <div class="flex justify-between font-extrabold text-xl text-slate-800">
                                        <span>Total</span>
                                        <span class="text-blue-700">Rp. <span id="modal_total">0</span></span>
                                    </div>
                                </div>
                                <button onclick="closeDetailModal()"
                                    class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-xl transition">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog id="cancel_modal"
        class="modal fixed inset-0 z-[70] flex items-center justify-center bg-black/50 hidden backdrop-blur-sm transition-opacity">
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 relative animate-in fade-in zoom-in duration-200 mx-4">
            <h3 class="text-2xl font-bold text-slate-900 mb-2">Konfirmasi Pembatalan</h3>
            <p class="text-slate-600 text-base mb-6">
                Kamu yakin ingin membatalkan pesanan <br>
                <span class="font-bold text-black" id="modal_order_display_id">#ORD-XXXX</span>?
            </p>
            <form id="cancelForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="mb-4">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alasan Pembatalan</label>
                    <div class="relative">
                        <select name="reason"
                            class="w-full appearance-none border border-slate-300 rounded-xl px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white font-medium">
                            <option>Salah pilih item</option>
                            <option>Ingin ganti alamat</option>
                            <option>Ingin ganti menu</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="mb-8">
                    <textarea name="detail"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 h-24 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-slate-400 resize-none"
                        placeholder="Tambahkan detail (opsional)"></textarea>
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="closeCancelModal()"
                        class="px-8 py-3 rounded-full border border-slate-300 text-slate-700 font-bold hover:bg-slate-50 transition">Batal</button>
                    <button type="submit"
                        class="px-6 py-3 rounded-full bg-[#EF4444] text-white font-bold hover:bg-red-600 shadow-lg transition">Batalkan
                        Pesanan</button>
                </div>
            </form>
        </div>
    </dialog>

    <div id="review_modal" class="hidden fixed inset-0 z-[70] flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeReviewModal()"></div>
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative animate-in fade-in zoom-in duration-200 mx-4 z-10">
            <button onclick="closeReviewModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <h3 class="text-xl font-bold text-slate-900 text-center mb-1">Beri Nilai Runner</h3>
            <p class="text-center text-slate-500 text-sm mb-6">Runner: <span id="review_runner_name"
                    class="font-bold text-slate-700"></span></p>
            <form action="" method="POST" id="reviewForm">
                @csrf
                <div class="flex flex-row-reverse justify-center gap-1 mb-6">
                    <input type="radio" id="star5" name="rating" value="5" class="peer hidden" />
                    <label for="star5"
                        class="cursor-pointer text-slate-200 peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400 text-4xl transition-colors">★</label>
                    <input type="radio" id="star4" name="rating" value="4" class="peer hidden" />
                    <label for="star4"
                        class="cursor-pointer text-slate-200 peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400 text-4xl transition-colors">★</label>
                    <input type="radio" id="star3" name="rating" value="3" class="peer hidden" />
                    <label for="star3"
                        class="cursor-pointer text-slate-200 peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400 text-4xl transition-colors">★</label>
                    <input type="radio" id="star2" name="rating" value="2" class="peer hidden" />
                    <label for="star2"
                        class="cursor-pointer text-slate-200 peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400 text-4xl transition-colors">★</label>
                    <input type="radio" id="star1" name="rating" value="1" class="peer hidden" />
                    <label for="star1"
                        class="cursor-pointer text-slate-200 peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400 text-4xl transition-colors">★</label>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Ulasan Anda</label>
                    <textarea name="review" rows="3"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-slate-400 resize-none"
                        placeholder="Tulis pengalamanmu..."></textarea>
                </div>
                <button type="submit"
                    class="w-full py-3 rounded-full bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg transition">Kirim
                    Penilaian</button>
            </form>
        </div>
    </div>

    <script>
        const detailModal = document.getElementById('detail_modal');
        const modalCancelAlert = document.getElementById('modal_cancel_alert');

        function openDetailModal(data) {
            document.getElementById('modal_display_id').innerText = data.display_id;
            document.getElementById('modal_img').src = data.img_url;
            document.getElementById('modal_menu_name').innerText = data.menu_name;
            document.getElementById('modal_price').innerText = data.price;
            document.getElementById('modal_qty').innerText = data.qty;
            document.getElementById('modal_pickup').innerText = data.pickup;
            document.getElementById('modal_delivery').innerText = data.delivery;
            document.getElementById('modal_subtotal').innerText = data.subtotal;
            document.getElementById('modal_fee').innerText = data.service_fee;
            document.getElementById('modal_total').innerText = data.total;
            document.getElementById('modal_payment').innerText = data.payment_method;
            document.getElementById('modal_status_text').innerText = data.status.replace('_', ' ');

            const noteEl = document.getElementById('modal_note');
            if (data.note && data.note.trim() !== '') {
                noteEl.innerText = data.note;
                noteEl.classList.remove('text-slate-400');
                noteEl.classList.add('text-slate-700');
            } else {
                noteEl.innerText = 'Tidak ada catatan';
                noteEl.classList.add('text-slate-400');
                noteEl.classList.remove('text-slate-700');
            }

            if (data.status === 'cancelled') {
                modalCancelAlert.classList.remove('hidden');
                document.getElementById('modal_cancel_reason').innerText = data.cancel_reason;
                document.getElementById('modal_cancel_note').innerText = data.cancel_note;
            } else {
                modalCancelAlert.classList.add('hidden');
            }

            detailModal.classList.remove('hidden');
        }

        function closeDetailModal() {
            detailModal.classList.add('hidden');
        }

        const cancelModal = document.getElementById('cancel_modal');
        const orderDisplay = document.getElementById('modal_order_display_id');
        const cancelForm = document.getElementById('cancelForm');

        function openCancelModal(id, orderNumber) {
            if (event) event.stopPropagation();
            orderDisplay.innerText = orderNumber;
            cancelForm.action = "{{ url('titiper/orders') }}/" + id;
            cancelModal.classList.remove('hidden');
            if (typeof cancelModal.showModal === 'function') cancelModal.showModal();
        }

        function closeCancelModal() {
            cancelModal.classList.add('hidden');
            if (typeof cancelModal.close === 'function') cancelModal.close();
        }

        const reviewModal = document.getElementById('review_modal');
        const reviewRunnerName = document.getElementById('review_runner_name');
        const reviewForm = document.getElementById('reviewForm');

        function openReviewModal(orderId, runnerName) {
            if (event) event.stopPropagation();
            reviewRunnerName.innerText = runnerName;
            let urlTemplate = "{{ route('titiper.reviews.store', ':id') }}";
            reviewForm.action = urlTemplate.replace(':id', orderId);
            reviewModal.classList.remove('hidden');
        }

        function closeReviewModal() {
            reviewModal.classList.add('hidden');
        }
    </script>
@endsection
