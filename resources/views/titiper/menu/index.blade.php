{{-- resources/views/titiper/menu/index.blade.php --}}
@extends('template.afterLogin.TitiperAfterLogin')

@section('Title', 'Menu')

@section('Content')
<div class="max-w-7xl mx-auto px-6 py-10">
  <div class="bg-white rounded-lg p-8 shadow-sm border">
    <h1 class="text-4xl font-extrabold text-sky-700 mb-6">Menu</h1>

    <!-- Search -->
    <form method="GET" action="{{ url('titiper/menu') }}" class="mb-4">
      <div class="flex gap-3 items-center">
        <input
          type="search"
          name="q"
          value="{{ $q }}"
          placeholder="Lagi mau makan apa?"
          class="flex-1 border rounded-lg px-4 py-3 shadow-sm"
        />
        <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-md">Cari</button>
      </div>
    </form>

    <!-- Category filters -->
    <div class="flex flex-wrap gap-2 mb-6">
      <a href="{{ route('titiper.menu.index') }}"
         class="px-3 py-1 rounded-md border {{ !$category ? 'bg-sky-600 text-white' : 'text-slate-600' }}">
         Semua
      </a>

      @foreach($categories as $cat)
        <a href="{{ route('titiper.menu.index', ['category' => $cat]) }}"
           class="px-3 py-1 rounded-md border {{ ($category == $cat) ? 'bg-sky-600 text-white' : 'text-slate-600' }}">
          {{ $cat }}
        </a>
      @endforeach
    </div>

    <!-- Menu Grid -->
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($menus as $menu)
        <div class="bg-white rounded-xl shadow p-4">
          <div class="w-full h-36 bg-slate-100 rounded overflow-hidden mb-3">
            <img src="{{ $menu->image ?? 'https://via.placeholder.com/400x300' }}" 
                 class="w-full h-full object-cover">
          </div>

          <div class="font-semibold text-sm">{{ $menu->name }}</div>
          <div class="text-xs text-slate-500 mb-2">Rp. {{ number_format($menu->price, 0, ',', '.') }}</div>

          <form action="{{ route('titiper.menu.createOrder', $menu->id) }}" method="POST">
            @csrf
            <button class="w-full bg-sky-600 text-white py-2 rounded">Titip</button>
          </form>
        </div>
      @endforeach
    </div>

    <!-- pagination -->
    <div class="mt-6">
      {{ $menus->links('pagination::tailwind') }}
    </div>

  </div>
</div>
@endsection
