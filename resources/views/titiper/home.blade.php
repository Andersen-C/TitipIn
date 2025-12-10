{{-- resources/views/pembeli/home.blade.php --}}
@extends('template.afterLogin.TitiperAfterLogin')

@section('Title', 'Home Page (Pembeli)')

@section('Content')
    @php
        // fallback jika controller belum mengirim data
        $latestOrders =
            $latestOrders ??
            collect([
                (object) [
                    'menu_name' => 'Nasi Goreng',
                    'status' => 'Pending',
                    'time' => '14:22',
                    'note' => 'Sedang dibelikan',
                ],
                (object) ['menu_name' => 'Kopi Hitam', 'status' => 'Selesai', 'time' => '12:10', 'note' => 'Selesai'],
            ]);
        $bestMenu = $bestMenu ?? (object) ['name' => 'Sushi Jepun', 'price' => 25000, 'image' => null];
        $recommended =
            $recommended ??
            collect([
                (object) ['id' => 1, 'name' => 'Nasi Goreng', 'price' => 15000, 'image' => null],
                (object) ['id' => 2, 'name' => 'Mie Goreng', 'price' => 20000, 'image' => null],
                (object) ['id' => 3, 'name' => 'Bakmie Effata', 'price' => 22000, 'image' => null],
                (object) ['id' => 4, 'name' => 'Bakmie Effata', 'price' => 22000, 'image' => null],
                (object) ['id' => 5, 'name' => 'Nasi Goreng', 'price' => 15000, 'image' => null],
                (object) ['id' => 6, 'name' => 'Mie Goreng', 'price' => 20000, 'image' => null],
            ]);
    @endphp

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="bg-white rounded-lg p-8 shadow-sm border">
            <div class="grid lg:grid-cols-3 gap-8 items-start">
                <!-- LEFT: hero + cards -->
                <div class="lg:col-span-12">
                    <div class="flex items-start gap-8">
                        <div class="flex-1">
                            <!-- Logo kecil -->
                            <div class="mb-4">
                                <span class="text-2xl font-extrabold text-sky-700">Titip<span
                                        class="text-yellow-400">In</span></span>
                            </div>

                            <!-- Hero heading -->
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

                        <!-- Right area (title Rekomendasi) visible inline on lg
                      <div class="hidden lg:block w-80">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 center">Rekomendasi Menu</h3>
                        <div class="space-y-4">
                          @foreach ($recommended->take(3) as $menuCard)
    <div class="bg-white rounded-xl shadow p-3 flex items-center gap-3">
                              <div class="w-16 h-16 bg-slate-100 rounded-md overflow-hidden flex-shrink-0">
                                <img src="{{ $menuCard->image ?? 'https://via.placeholder.com/64' }}" alt="" class="w-full h-full object-cover">
                              </div>
                              <div class="flex-1">
                                <div class="text-sm font-medium">{{ $menuCard->name }}</div>
                                <div class="text-xs text-slate-500">Rp. {{ number_format($menuCard->price ?? 0, 0, ',', '.') }}</div>
                                <a href="{{ url('menu/' . $menuCard->id ?? '#') }}" class="mt-2 inline-block px-3 py-1 bg-sky-600 text-white rounded text-xs">Titip</a>
                              </div>
                            </div>
    @endforeach
                        </div>
                      </div> -->
                    </div>

                    <!-- Cards row -->
                    <div class="mt-8 grid md:grid-cols-2 gap-6">
                        <!-- Pesanan Terbaru -->
                        <div class="bg-white rounded-xl shadow p-5 border">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h4 class="text-md font-semibold text-slate-800">Pesanan Terbaru <span
                                            class="text-sm text-slate-400">({{ $latestOrders->count() }})</span></h4>
                                    <p class="text-xs text-slate-500">Ringkasan pesanan terbaru kamu</p>
                                </div>
                                <div class="text-sm text-slate-400"> </div>
                            </div>

                            <div class="space-y-3">
                                @foreach ($latestOrders as $o)
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-sm font-medium">
                                                {{ $o->menu_name ?? ($o->menu->name ?? 'Menu') }}</div>
                                            <div class="text-xs text-slate-500">{{ $o->note ?? '' }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-xs text-slate-400">
                                                {{ $o->time ?? optional($o->created_at)->format('H:i') }}</div>
                                            <div class="mt-1">
                                                @if (($o->status ?? '') == 'Pending' || ($o->status ?? '') == 'pending')
                                                    <span
                                                        class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">Pending</span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-700">{{ ucfirst($o->status ?? 'Selesai') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-5 text-center">
                                <a href="{{ url('orders') }}"
                                    class="inline-block px-4 py-2 border rounded-md text-sky-600">Lihat Detail</a>
                            </div>
                        </div>


                        <!-- RIGHT: rekomendasi grid & tombol -->
                        <aside class="space-y-12">
                            <div class="bg-white rounded-xl shadow p-4">
                                <h3 class="text-lg font-semibold text-slate-800 mb-4">Rekomendasi Menu</h3>

                                <div class="grid grid-cols-1 gap-8">
                                    @foreach ($recommended as $menu)
                                        <div class="bg-slate-50 rounded-xl p-3 shadow-sm flex items-center gap-3">
                                            <div class="w-20 h-20 bg-white rounded-lg overflow-hidden flex-shrink-0">
                                                <img src="{{ $menu->image ?? 'https://via.placeholder.com/120' }}"
                                                    alt="" class="w-full h-full object-cover">
                                            </div>
                                            <div class="flex-1">
                                                <div class="font-medium text-sm">{{ $menu->name }}</div>
                                                <div class="text-xs text-slate-500">Rp.
                                                    {{ number_format($menu->price ?? 0, 0, ',', '.') }}</div>
                                                <div class="mt-2">
                                                    <a href="{{ url('menu/' . $menu->id ?? '#') }}"
                                                        class="px-3 py-1 bg-sky-600 text-white rounded text-xs">Titip</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-4">
                                    <a href="{{ url('menu') }}"
                                        class="w-full block text-center bg-sky-600 text-white py-3 rounded-full">Selengkapnya</a>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
    </main>
@endsection
