@extends('template.mainAdmin')
@section('Title', 'Update Menu')

@section('Content')
<div class="p-12 min-h-screen bg-gray-50">

    {{-- HEADER (Back kiri, Title center) --}}
    <div class="relative mb-4 flex items-center">
        <a href="{{ route('menus.index') }}"
           class="btn btn-secondary rounded-xl text-sm sm:text-lg z-10 inline-flex items-center gap-2">
            <i class="fa-solid fa-backward"></i>
            {{ __('admin.Back') }}
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2
                   text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">
            {{ __('admin.MenuUpdatePage.Title') }}
        </h2>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl p-8">

            <form action="{{ route('menus.update', $menu->id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label class="block mb-1.5 text-sm font-bold text-gray-900">
                        {{ __('admin.MenuUpdatePage.Name.Title') }}
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name', $menu->name) }}"
                           placeholder="{{ __('admin.MenuUpdatePage.Name.Placeholder') }}"
                           class="block w-full rounded-xl px-4 py-2.5
                                  bg-gray-50 border
                                  text-gray-900
                                  {{ $errors->has('name') ? 'border-red-600' : 'border-default-medium' }}">
                    @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block mb-1.5 text-sm font-bold text-gray-900">
                        {{ __('admin.MenuUpdatePage.Price.Title') }}
                    </label>
                    <input type="number"
                           name="price"
                           value="{{ old('price', $menu->price) }}"
                           placeholder="{{ __('admin.MenuUpdatePage.Price.Placeholder') }}"
                           class="block w-full rounded-xl px-4 py-2.5
                                  bg-gray-50 border
                                  text-gray-900
                                  {{ $errors->has('price') ? 'border-red-600' : 'border-default-medium' }}">
                    @error('price') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Category & Location --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-900">
                            {{ __('admin.MenuUpdatePage.Category.Title') }}
                        </label>
                        <select name="category_id"
                                class="block w-full rounded-xl
                                       bg-gray-50 px-4 py-2.5 border
                                       text-gray-900">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $menu->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-bold text-gray-900">
                           {{ __('admin.MenuUpdatePage.Location.Title') }}
                        </label>
                        <select name="location_id"
                                class="block w-full rounded-xl
                                       bg-gray-50 px-4 py-2.5 border
                                       text-gray-900">
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}"
                                    {{ old('location_id', $menu->location_id) == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block mb-1.5 text-sm font-bold text-gray-900">
                        {{ __('admin.MenuUpdatePage.Desc.Title') }}
                    </label>
                    <textarea name="description"
                              rows="4"
                              placeholder="{{ __('admin.MenuUpdatePage.Desc.Placeholder') }}"
                              class="block w-full rounded-xl px-4 py-2.5
                                     bg-gray-50 border
                                     text-gray-900">{{ old('description', $menu->description) }}</textarea>
                </div>

                {{-- Upload Gambar (Custom seperti Create Menu) --}}
                <div class="relative space-y-1">
                    <label class="block text-sm font-bold text-gray-900">
                        {{ __('admin.MenuUpdatePage.Image.Title') }}
                    </label>

                    {{-- input asli --}}
                    <input
                        type="file"
                        name="image"
                        id="imageInput"
                        accept="image/*"
                        class="hidden"
                    />

                    {{-- custom box --}}
                    <div class="flex items-center justify-between
                                bg-gray-50
                                border border-default-medium
                                rounded-xl
                                px-4 py-2.5">
                        <span id="fileName" class="text-gray-600 text-sm">
                            {{ __('admin.MenuUpdatePage.Image.NoImg') }}
                        </span>

                        <button type="button"
                                onclick="document.getElementById('imageInput').click()"
                                class="px-4 py-1.5
                                       bg-blue-700 hover:bg-blue-900
                                       text-white text-sm
                                       rounded-lg cursor-pointer">
                            {{ __('admin.MenuUpdatePage.Image.Choose') }}
                        </button>
                    </div>

                    @error('image')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="flex justify-center pt-4">
                    <button type="submit"
                            class="btn bg-blue-700 text-white rounded-xl hover:bg-blue-900 px-6 py-2">
                        {{ __('admin.Update') }}
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('imageInput');
    const label = document.getElementById('fileName');

    if (!input || !label) return;

    input.addEventListener('change', function () {
        label.textContent = input.files.length
            ? input.files[0].name
            : __('admin.MenuUpdatePage.Image.NoImg');
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
