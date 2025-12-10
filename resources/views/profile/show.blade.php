@extends($layout)

@section('Title', 'Profil Saya')

@section('Content')
    <div class="w-full bg-white">

        <div class="w-full bg-[#4338ca] text-white py-6 px-6 shadow-md">
            <div class="container mx-auto max-w-5xl flex flex-row items-center gap-6">

                <div class="avatar">
                    <div class="w-24 h-24 rounded-full bg-gray-300 ring-4 ring-white/30 overflow-hidden">
                        <img src="{{ Auth::user()->profile_photo_path ?? 'https://placehold.co/150' }}" alt="Profile"
                            class="object-cover w-full h-full" />
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <h1 class="text-3xl font-bold">{{ Auth::user()->name }}</h1>
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

                                <li>
                                    <a href="{{ route('user.switch.mode', 'titiper') }}"
                                        class="{{ $mode == 'titiper' ? 'font-bold text-blue-700' : '' }}">
                                        Titiper
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('user.switch.mode', 'runner') }}"
                                        class="{{ $mode == 'runner' ? 'font-bold text-blue-700' : '' }}">
                                        Runner
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="dropdown">
                            <label tabindex="0"
                                class="btn btn-sm bg-white border-none hover:bg-gray-100 text-gray-800 normal-case rounded-md h-8 min-h-0 gap-2">
                                <span class="text-gray-500 font-normal text-xs">Bahasa:</span>
                                <span class="font-bold text-blue-700 text-xs">
                                    {{ session('locale') == 'en' ? 'English' : 'Indonesia' }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </label>
                            <ul tabindex="0"
                                class="dropdown-content menu p-1 shadow-lg bg-white rounded-box w-40 text-gray-800 mt-1 z-[50]">
                                <li><a href="#"
                                        class="{{ session('locale') != 'en' ? 'font-bold text-blue-700' : '' }}">Bahasa
                                        Indonesia</a></li>
                                <li><a href="#"
                                        class="{{ session('locale') == 'en' ? 'font-bold text-blue-700' : '' }}">English</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="ml-auto self-end">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white/80 hover:text-white text-sm font-semibold hover:underline">logout</button>
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
