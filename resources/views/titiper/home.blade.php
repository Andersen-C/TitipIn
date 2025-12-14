@extends('template.afterLogin.TitiperAfterLogin')

@section('Title', 'Home Page (Pembeli)')

@section('Content')
    @php
        $latestOrders =
            $latestOrders ??
            collect([
                (object) [
                    'menu_name' => 'Nasi Goreng',
                    'status' => 'Pending',
                    'time' => '14:22',
                    'note' => 'Sedang dibelikan',
                ],
                (object) [
                    'menu_name' => 'Kopi Hitam',
                    'status' => 'Selesai',
                    'time' => '12:10',
                    'note' => 'Selesai',
                ],
            ]);

        $recommended =
            $recommended ??
            collect([
                (object) ['id' => 1, 'name' => 'Nasi Goreng', 'price' => 15000, 'image' => null],
                (object) ['id' => 2, 'name' => 'Mie Goreng', 'price' => 20000, 'image' => null],
                (object) ['id' => 3, 'name' => 'Bakmie Effata', 'price' => 22000, 'image' => null],
                (object) ['id' => 4, 'name' => 'Pisang Goreng', 'price' => 8000, 'image' => null],
            ]);
    @endphp

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="bg-white rounded-lg p-8 shadow-sm border">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <div class="lg:col-span-2">
                    <div class="flex flex-col gap-6">
                        <div>
                            <div class="mb-4">
                                <span class="text-2xl font-extrabold text-sky-700">Titip<span
                                        class="text-yellow-400">In</span></span>
                            </div>

                            <h1 class="text-5xl font-extrabold leading-tight text-sky-700">
                                Selamat Datang <br> di Titip<span class="text-yellow-400">In</span>
                            </h1>
                            <p class="mt-4 text-slate-600 max-w-xl">
                                Titip makanan dengan cepat dan mudah.
                            </p>

                            <div class="mt-6">
                                <a href="{{ url('titip/create') }}"
                                    class="inline-block bg-sky-600 hover:bg-sky-700 text-white px-6 py-3 rounded-md shadow">Mulai
                                    Titip Sekarang</a>
                            </div>
                        </div>

                        <div class="mt-8 grid md:grid-cols-2 gap-6">
                            <div class="bg-white rounded-xl shadow p-5 border flex flex-col">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h4 class="text-md font-semibold text-slate-800">Pesanan Terbaru <span
                                                class="text-sm text-slate-400">({{ $latestOrders->count() }})</span></h4>
                                        <p class="text-xs text-slate-500">Ringkasan pesanan terbaru kamu</p>
                                    </div>
                                </div>

                                <div class="space-y-3 flex-1">
                                    @foreach ($latestOrders as $o)
                                        <div
                                            class="flex items-center justify-between border-b border-slate-50 pb-2 last:border-0">
                                            <div>
                                                <div class="text-sm font-medium text-slate-800">
                                                    @if (isset($o->menu_name))
                                                        {{ $o->menu_name }}
                                                    @else
                                                        @php
                                                            $firstItem = $o->orderItems->first();
                                                            $menuName = $firstItem
                                                                ? $firstItem->menu->name ?? 'Menu Dihapus'
                                                                : 'Item Kosong';
                                                            $moreItems = $o->orderItems->count() - 1;
                                                        @endphp

                                                        {{ $menuName }}

                                                        @if ($moreItems > 0)
                                                            <span class="text-xs text-slate-500">(+{{ $moreItems }}
                                                                lainnya)</span>
                                                        @endif
                                                    @endif
                                                </div>

                                                <div class="text-xs text-slate-500">{{ $o->note ?? '' }}</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xs text-slate-400">
                                                    {{ isset($o->time) ? $o->time : optional($o->created_at)->format('H:i') }}
                                                </div>
                                                <div class="mt-1">
                                                    @if (($o->status ?? '') == 'Pending' || ($o->status ?? '') == 'pending' || ($o->status ?? '') == 'waiting_runner')
                                                        <span
                                                            class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">Pending</span>
                                                    @else
                                                        <span
                                                            class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-700">
                                                            {{ ucfirst(str_replace('_', ' ', $o->status ?? 'Selesai')) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-5 text-center pt-2">
                                    <a href="{{ route('titiper.orders.index') }}"
                                        class="inline-block px-4 py-2 border rounded-md text-sky-600 hover:bg-sky-50 text-sm">
                                        Lihat Semua Pesanan
                                    </a>
                                </div>
                            </div>

                            <div
                                class="bg-slate-200 rounded-xl p-6 border border-slate-300 text-center select-none cursor-not-allowed h-full flex flex-col justify-center items-center">
                                <div class="flex justify-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-2 8H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v6a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <p class="text-slate-600 text-sm font-medium">Voucher belum tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="space-y-6">
                    <div class="bg-white rounded-xl shadow p-4">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4">Rekomendasi Menu</h3>

                        <div class="space-y-4">
                            @foreach ($recommended->take(3) as $menu)
                                @php
                                    $rawImg = $menu->image ?? ($menu->image_path ?? ($menu->image_url ?? null));

                                    $placeholder = 'https://via.placeholder.com/120?text=No+Image';

                                    $isAbsolute = $rawImg
                                        ? \Illuminate\Support\Str::startsWith($rawImg, ['http://', 'https://'])
                                        : false;

                                    if ($rawImg) {
                                        $imgUrl = $isAbsolute ? $rawImg : asset('storage/' . ltrim($rawImg, '/'));
                                    } else {
                                        $imgUrl = $placeholder;
                                    }
                                @endphp

                                <div class="flex items-center gap-3 p-3 rounded-lg bg-slate-50">
                                    <div class="w-20 h-20 bg-white rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="{{ $imgUrl }}" alt="{{ $menu->name }}"
                                            class="w-full h-full object-cover">
                                    </div>

                                    <div class="flex-1">
                                        <div class="text-slate-800 font-semibold text-sm leading-tight">
                                            {{ $menu->name }}
                                        </div>
                                        <div class="text-xs text-slate-500 mt-1">
                                            Rp. {{ number_format($menu->price ?? 0, 0, ',', '.') }}
                                        </div>

                                        <div class="mt-2">
                                            <a href="{{ route('titiper.menu.show', $menu->id) }}"
                                                class="inline-block px-3 py-1 bg-sky-600 text-white rounded text-xs">Titip</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('titiper.menu.index') }}"
                                class="w-full block text-center bg-sky-600 text-white py-3 rounded-full">Selengkapnya</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection
