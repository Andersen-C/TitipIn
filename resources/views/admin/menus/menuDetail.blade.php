@extends('template.mainAdmin')

@section('Title', 'Detail Menu')

@section('Content')
<div class="p-12 min-h-screen bg-gray-50">

    {{-- HEADER (Back kiri, Title center) --}}
    <div class="relative mb-6 flex items-center">
        <a href="{{ route('menus.index') }}"
           class="btn btn-secondary rounded-xl text-sm sm:text-lg z-10 inline-flex items-center gap-2">
            <i class="fa-solid fa-backward"></i>
            {{ __('admin.Back') }}
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2
                   text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">
            {{ __('admin.MenuDetailPage.Title') }}
        </h2>
    </div>

    <div class="max-w-6xl mx-auto">
        {{-- CARD --}}
        <div class="border-2 border-blue-400 rounded-2xl p-8 bg-white shadow">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

                {{-- IMAGE (kiri) --}}
                <div class="flex justify-center">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}"
                             class="w-64 h-64 object-cover rounded-xl border bg-white">
                    @else
                        <div class="w-64 h-64 flex items-center justify-center bg-gray-200 rounded-xl text-gray-400">
                            {{ __('admin.MenuDetailPage.NoImg') }}
                        </div>
                    @endif
                </div>

                {{-- INFO (kanan) --}}
                <div class="md:col-span-2 space-y-4 text-gray-800">

                    <div>
                        <p class="text-sm text-gray-500">{{__('admin.MenuTable.Name')}}</p>
                        <p class="font-semibold text-lg">{{ $menu->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">{{__('admin.MenuTable.Price')}}</p>
                        <p class="font-semibold text-lg">
                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">{{__('admin.MenuDetailPage.Category')}}</p>
                        <p class="font-semibold">
                            {{ $menu->category->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">{{__('admin.MenuTable.Location')}}</p>
                        <p class="font-semibold">
                            {{ $menu->location->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">{{__('admin.MenuTable.Desc')}}</p>
                        <p>
                            {{ $menu->description ?? '-' }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- ACTION (TANPA DELETE) --}}
            <div class="flex justify-end mt-8">
                <a href="{{ route('menus.edit', $menu->id) }}"
                   class="inline-flex items-center gap-2
                          bg-yellow-400 hover:bg-yellow-500
                          text-white font-semibold
                          px-6 py-2
                          rounded-lg
                          shadow
                          transition duration-200">
                    <i class="fa-solid fa-pen"></i>
                    {{ __('admin.Update')}}
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
