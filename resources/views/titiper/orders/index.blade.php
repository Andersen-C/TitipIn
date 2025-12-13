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
                    @endphp

                    <div
                        class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-start">

                        <div class="w-full md:w-32 h-28 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="{{ $imgUrl }}" alt="{{ $menuName }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1 w-full">
                            <div class="flex justify-between items-start">
                                <h3 class="text-xl font-bold text-slate-800">{{ $menuName }}
                                    @if ($order->orderItems->count() > 1)
                                        <span
                                            class="text-sm font-normal text-slate-500">(+{{ $order->orderItems->count() - 1 }}
                                            lainnya)</span>
                                    @endif
                                </h3>
                                <span
                                    class="md:hidden text-xs text-slate-400 font-medium">{{ $order->created_at->format('d F Y') }}</span>
                            </div>

                            <p class="text-slate-500 text-sm mt-1">Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                            </p>

                            <div
                                class="mt-4 text-sm text-slate-500 space-y-1 bg-slate-50 p-3 rounded-lg border border-slate-100 inline-block w-full md:w-auto">
                                <p class="font-bold text-slate-700">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="badge badge-xs bg-blue-100 border-none"></span>
                                    {{ $order->pickupLocation->name ?? '-' }} &rarr;
                                    {{ $order->deliveryLocation->name ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-end justify-between h-full gap-2 min-w-[180px] w-full md:w-auto">
                            <p class="hidden md:block text-xs text-slate-400 font-medium">
                                {{ $order->created_at->format('d F Y') }}</p>

                            @if ($order->status == 'waiting_runner')
                                <div class="flex flex-col items-end gap-2 w-full">
                                    <span
                                        class="px-4 py-1 bg-[#FDF6B2] text-[#9F580A] text-xs font-bold rounded-md uppercase tracking-wide">
                                        Menunggu
                                    </span>
                                    <button
                                        onclick="openCancelModal('{{ $order->id }}', '#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}')"
                                        class="w-full py-2 bg-[#EF4444] hover:bg-red-600 text-white text-sm font-bold rounded-lg transition shadow-sm">
                                        Batalkan Pesanan
                                    </button>
                                    <p class="text-xs text-slate-400 mt-1">Estimasi : {{ $estimasiStart }} -
                                        {{ $estimasiEnd }}</p>
                                </div>
                            @elseif (in_array($order->status, ['accepted', 'arrived_at_pickup', 'item_picked', 'on_delivery', 'delivered']))
                                <div class="w-full flex flex-col items-end">
                                    <button
                                        class="w-full md:w-48 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg cursor-default shadow-sm mb-1">
                                        Sedang Dibelikan
                                    </button>
                                    <span class="text-[10px] text-slate-400">Runner:
                                        {{ $order->runner->name ?? 'Mencari...' }}</span>
                                    <p class="text-xs text-right text-slate-400 mt-1">Estimasi : {{ $estimasiStart }} -
                                        {{ $estimasiEnd }}</p>
                                </div>
                            @elseif ($order->status == 'completed')
                                <div class="w-full flex flex-col items-end gap-2">
                                    <span
                                        class="inline-block px-4 py-2 bg-[#DEF7EC] text-[#03543F] text-sm font-bold rounded-lg">
                                        Selesai
                                    </span>

                                    @if (!$order->hasReview())
                                        <button
                                            onclick="openReviewModal('{{ $order->id }}', '{{ $order->runner->name ?? 'Runner' }}')"
                                            class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-yellow-900 text-sm font-bold rounded-lg transition shadow-sm flex items-center gap-2">
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
                                        class="px-4 py-2 bg-slate-200 text-slate-500 text-sm font-bold rounded-lg cursor-not-allowed">
                                        Dibatalkan
                                    </button>
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

    {{-- MODAL PEMBATALAN --}}
    <dialog id="cancel_modal"
        class="modal fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden backdrop-blur-sm transition-opacity">
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

    <div id="review_modal" class="hidden fixed inset-0 z-50 flex items-center justify-center">

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
                    class="w-full py-3 rounded-full bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg transition">
                    Kirim Penilaian
                </button>
            </form>
        </div>
    </div>

    <script>
        const cancelModal = document.getElementById('cancel_modal');
        const orderDisplay = document.getElementById('modal_order_display_id');
        const cancelForm = document.getElementById('cancelForm');

        function openCancelModal(id, orderNumber) {
            orderDisplay.innerText = orderNumber;
            cancelForm.action = "{{ url('titiper/orders') }}/" + id;

            cancelModal.classList.remove('hidden');
            if (typeof cancelModal.showModal === 'function') {
                cancelModal.showModal();
            }
        }

        function closeCancelModal() {
            cancelModal.classList.add('hidden');
            if (typeof cancelModal.close === 'function') {
                cancelModal.close();
            }
        }

        const reviewModal = document.getElementById('review_modal');
        const reviewRunnerName = document.getElementById('review_runner_name');
        const reviewForm = document.getElementById('reviewForm');

        function openReviewModal(orderId, runnerName) {
            reviewRunnerName.innerText = runnerName;
            let urlTemplate = "{{ route('titiper.reviews.store', ':id') }}";
            let finalUrl = urlTemplate.replace(':id', orderId);

            reviewForm.action = finalUrl;

            reviewModal.classList.remove('hidden');
        }

        function closeReviewModal() {
            reviewModal.classList.add('hidden');
        }

        if (reviewModal) {
            reviewModal.addEventListener('click', (e) => {});
        }
    </script>
@endsection
