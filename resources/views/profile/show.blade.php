@extends($layout)

@section('Title', 'Profil Saya')

@section('Content')
    <div class="w-full bg-white">

        <div class="w-full bg-[#4338ca] text-white py-6 px-6 shadow-md">
            <div class="container mx-auto max-w-5xl flex flex-col md:flex-row items-center gap-6">

                <div class="avatar relative group">
                    <form id="form-update-photo" action="{{ route('profile.photo.manage') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="photo" id="photo-input" class="hidden"
                            accept="image/png, image/jpeg, image/jpg"
                            onchange="document.getElementById('form-update-photo').submit()">

                        <label for="photo-input" class="cursor-pointer block">
                            <div
                                class="w-24 h-24 rounded-full bg-gray-300 ring-4 ring-white/30 overflow-hidden relative md:w-32 md:h-32">
                                <img src="{{ Auth::user()->profile_pic ? asset('storage/' . Auth::user()->profile_pic) . '?v=' . time() : 'https://placehold.co/150?text=No+Image' }}"
                                    alt="Profile"
                                    class="object-cover w-full h-full transition-opacity group-hover:opacity-75" />

                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/30 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                        </label>
                    </form>
                </div>

                @error('photo')
                    <div class="text-red-500 text-xs mt-2 text-center">
                        {{ $message }}
                    </div>
                @enderror

                <div class="flex flex-col gap-1 text-center md:text-left items-center md:items-start">
                    <div class="flex flex-row items-center gap-2">
                        <h1 class="text-3xl font-bold">{{ Auth::user()->name }}</h1>

                        @if ($mode == 'runner')
                            <div class="flex items-center gap-1 bg-white/20 px-2 py-1 rounded-full backdrop-blur-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 fill-current"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <span class="font-bold text-sm">{{ number_format(Auth::user()->avg_rating, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <p class="text-white/80 text-sm mb-2">{{ Auth::user()->email }}</p>

                    <div class="flex flex-row gap-3">
                        <div class="dropdown">
                            <label tabindex="0"
                                class="btn btn-sm bg-white border-none hover:bg-gray-100 text-gray-800 normal-case rounded-md h-8 min-h-0 gap-2">
                                <span class="text-gray-500 font-normal text-xs">Mode:</span>
                                <span class="font-bold text-blue-700 text-xs">{{ ucfirst($mode) }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </label>
                            <ul tabindex="0"
                                class="dropdown-content menu p-1 shadow-lg bg-white rounded-box w-32 text-gray-800 mt-1 z-[50]">
                                <li><a href="{{ route('user.switch.mode', 'titiper') }}"
                                        class="{{ $mode == 'titiper' ? 'font-bold text-blue-700' : '' }}">Titiper</a></li>
                                <li><a href="{{ route('user.switch.mode', 'runner') }}"
                                        class="{{ $mode == 'runner' ? 'font-bold text-blue-700' : '' }}">Runner</a></li>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <label tabindex="0"
                                class="btn btn-sm bg-white border-none hover:bg-gray-100 text-gray-800 normal-case rounded-md h-8 min-h-0 gap-2">
                                <span class="text-gray-500 font-normal text-xs">Bahasa:</span>
                                <span
                                    class="font-bold text-blue-700 text-xs">{{ session('locale') == 'en' ? 'English' : 'Indonesia' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </label>
                            <ul tabindex="0"
                                class="dropdown-content menu p-1 shadow-lg bg-white rounded-box w-40 text-gray-800 mt-1 z-[50]">
                                <li><a href="{{ route('lang.switch', 'en') }}"
                                        class="{{ session('locale') != 'en' ? 'font-bold text-blue-700' : '' }}">Bahasa
                                        Indonesia</a></li>
                                <li><a href="{{ route('lang.switch', 'id') }}"
                                        class="{{ session('locale') == 'en' ? 'font-bold text-blue-700' : '' }}">English</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="ml-auto self-center md:self-end">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="btn btn-sm bg-white border-none hover:bg-red-100 text-red-600 normal-case rounded-md h-8 min-h-0 gap-2 px-4 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container mx-auto max-w-5xl px-6 py-8 pb-10">

            @if (session('success'))
                <div
                    class="alert alert-success shadow-sm mb-6 bg-green-100 border border-green-400 text-green-800 rounded-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="alert alert-error shadow-sm mb-6 bg-red-100 border border-red-400 text-red-800 rounded-md flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6 mt-0.5"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="flex flex-col">
                        <span class="font-bold text-sm">Gagal menyimpan perubahan!</span>
                        <ul class="list-disc list-inside text-xs mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if ($mode == 'runner')
                <div class="mb-10">
                    <div class="border-b border-gray-200 pb-2 mb-4">
                        <h3 class="text-blue-600 font-bold text-lg border-b-2 border-blue-600 inline-block pb-2 px-1">
                            Ulasan & Rating Saya
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div
                            class="card bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-md p-6 rounded-xl flex flex-col justify-center items-center">
                            <span class="text-4xl font-extrabold">{{ number_format(Auth::user()->avg_rating, 1) }}</span>
                            <div class="flex text-yellow-300 my-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 {{ round(Auth::user()->avg_rating) >= $i ? 'fill-current' : 'text-gray-300 fill-none' }}"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-sm opacity-90 text-blue-100">Berdasarkan {{ $reviews->count() ?? 0 }}
                                ulasan</span>
                        </div>

                        <div
                            class="card bg-white border border-gray-200 shadow-sm rounded-xl p-0 overflow-hidden h-48 md:h-auto overflow-y-auto">
                            @if (isset($reviews) && count($reviews) > 0)
                                <div class="divide-y divide-gray-100">
                                    @foreach ($reviews as $review)
                                        <div class="p-4 hover:bg-gray-50 transition">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="font-bold text-sm text-gray-800">
                                                        {{ $review->reviewer->name ?? 'Pengguna' }}</p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $review->created_at->diffForHumans() }}</p>
                                                </div>
                                                <div
                                                    class="flex items-center gap-1 bg-yellow-100 px-2 py-0.5 rounded text-xs text-yellow-800 font-bold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                                    </svg>
                                                    {{ $review->rating }}
                                                </div>
                                            </div>
                                            <p class="text-gray-600 text-sm mt-2 line-clamp-2">
                                                "{{ $review->comment ?? 'Tidak ada komentar' }}"</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center h-full text-gray-400 p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 opacity-50"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                    <p class="text-sm">Belum ada ulasan yang masuk.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="border-b border-gray-200 pb-2 mb-6">
                <h3 class="text-blue-600 font-bold text-lg border-b-2 border-blue-600 inline-block pb-2 px-1">Edit Profile
                </h3>
            </div>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="space-y-6">

                    <div class="grid grid-cols-1 md:grid-cols-12 items-start gap-4">
                        <label class="md:col-span-2 font-bold text-gray-700 text-sm mt-3">Nama</label>
                        <div class="md:col-span-10">
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                placeholder="Contoh: Budi Santoso"
                                class="input input-bordered w-full bg-white text-gray-900 rounded-md h-10 placeholder-gray-400
                            @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-blue-500 @enderror" />

                            @error('name')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 items-start gap-4">
                        <label class="md:col-span-2 font-bold text-gray-700 text-sm mt-3">Email</label>
                        <div class="md:col-span-10">
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                placeholder="Contoh: budi@gmail.com"
                                class="input input-bordered w-full bg-white text-gray-900 rounded-md h-10 placeholder-gray-400
                            @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-blue-500 @enderror" />

                            @error('email')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 items-start gap-4">
                        <label class="md:col-span-2 font-bold text-gray-700 text-sm mt-3">No.Telp</label>
                        <div class="md:col-span-10">
                            <input type="text" name="phone_number"
                                value="{{ old('phone_number', Auth::user()->phone_number) }}"
                                placeholder="Contoh: 081234567890"
                                class="input input-bordered w-full bg-white text-gray-900 h-10 min-h-0 rounded-md placeholder-gray-400
                            @error('phone_number') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-blue-500 @enderror" />

                            @error('phone_number')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="flex justify-center gap-4 mt-12">
                    <a href="{{ route($mode . '.home') }}"
                        class="btn btn-sm h-10 btn-outline border-gray-400 text-gray-600 hover:bg-gray-100 hover:text-gray-800 rounded-full px-10 normal-case font-normal">
                        Batal
                    </a>
                    <button type="submit"
                        class="btn btn-sm h-10 bg-blue-600 hover:bg-blue-700 text-white border-none rounded-full px-10 normal-case font-normal shadow-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
