{{-- resources/views/titiper/menu/index.blade.php --}}
@extends('template.afterLogin.TitiperAfterLogin')

@section('Title', 'Menu')

@section('Content')
<div class="max-w-7xl mx-auto px-6 py-10">
  <div class="bg-white rounded-lg p-8 shadow-sm border">
    <h1 class="text-4xl font-extrabold text-sky-700 mb-6">Menu</h1>

    <!-- Search -->
    <form method="GET" action="{{ route('titiper.menu.index') }}" class="mb-4">
      <div class="flex gap-3 items-center">
        <div class="relative flex-1">
          {{-- Search icon (left) --}}
          <span class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l3.387 3.387a1 1 0 01-1.414 1.414l-3.387-3.387zM8 14a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
            </svg>
          </span>

          <input
            type="search"
            name="q"
            value="{{ request('q') }}"
            placeholder="Lagi mau makan apa?"
            class="w-full border rounded-lg pl-10 pr-10 py-3 shadow-sm placeholder:text-slate-400 text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-200"
            aria-label="Cari menu"
          />

          {{-- Clear button (X) - tampil kalau ada query --}}
          @if(request('q'))
            <a href="{{ route('titiper.menu.index', request()->except(['q','page'])) }}"
               class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600" aria-label="Hapus pencarian">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </a>
          @endif
        </div>

        <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-md">Cari</button>
      </div>
    </form>

    <!-- Group Pills -->
    <div class="flex gap-2 flex-wrap mb-6">
      @php $groupActive = request('group'); @endphp
      <a href="{{ route('titiper.menu.index', request()->except(['group','category','page'])) }}"
         class="px-4 py-2 rounded-full border {{ $groupActive ? 'text-slate-600' : 'bg-sky-600 text-white' }}">
         Semua
      </a>

      @foreach($groups as $g)
        @php $active = (string) request('group') === (string) $g; @endphp
        <a href="{{ route('titiper.menu.index', array_merge(request()->except('page'), ['group' => $g])) }}"
           class="px-4 py-2 rounded-full border {{ $active ? 'bg-sky-600 text-white' : 'text-slate-600' }}">
          {{ $g }}
        </a>
      @endforeach
    </div>

    <!-- Menu Grid -->
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @forelse($menus as $menu)
        <div class="bg-white rounded-xl shadow p-4">
          <!-- Image (clickable to detail) -->
          <a href="{{ route('titiper.menu.show', $menu->id) }}" class="block mb-3">
            <div class="w-full h-36 bg-slate-100 rounded overflow-hidden">
              @php
                $img = $menu->image ?? null;
                $placeholder = 'https://via.placeholder.com/400x300?text=No+Image';
                // cek apakah $img sudah URL absolute
                $isAbsolute = $img ? \Illuminate\Support\Str::startsWith($img, ['http://','https://']) : false;
                if ($img) {
                  $imgUrl = $isAbsolute ? $img : asset('storage/' . ltrim($img, '/'));
                } else {
                  $imgUrl = $placeholder;
                }
              @endphp

              <img src="{{ $imgUrl }}" class="w-full h-full object-cover" alt="{{ $menu->name }}">
            </div>
          </a>

          <!-- Title (clickable) -->
          <div class="text-slate-800 font-semibold text-sm mb-1">
            <a href="{{ route('titiper.menu.show', $menu->id) }}" class="hover:underline">
              {{ $menu->name }}
            </a>
          </div>

          <div class="text-xs text-slate-500 mb-3">
            Rp. {{ number_format($menu->price ?? 0, 0, ',', '.') }}
          </div>

          <!-- Titip button -> go to detail -->
          <a href="{{ route('titiper.menu.show', $menu->id) }}"
             class="w-full inline-block text-center bg-sky-600 text-white py-2 rounded">
            Titip
          </a>
        </div>
      @empty
        <div class="col-span-full text-center text-slate-500 py-10">
          Tidak ada menu ditemukan.
        </div>
      @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
      {{ $menus->appends(request()->query())->links('pagination::tailwind') }}
    </div>

  </div>
</div>
@endsection
