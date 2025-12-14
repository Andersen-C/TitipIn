<div class="navbar shadow-sm bg-white px-8 text-black font-bold">
    <div class="navbar-start">
        <a href="{{ route('titiper.home') }}"
            class="text-3xl font-extrabold tracking-tight px-4 hover:opacity-80 transition-opacity">
            <span class="text-sky-700">Titip</span><span class="text-yellow-400">In</span>
        </a>
    </div>

    <div class="navbar-end hidden lg:flex">
        <ul class="menu menu-horizontal px-4 gap-x-4 font-bold text-lg">

            {{-- HOME --}}
            <li>
                <a href="{{ route('titiper.home') }}"
                    class="px-5 py-2 hover:bg-transparent hover:text-blue-700
                    {{ request()->routeIs('titiper.home') ? 'bg-blue-600 text-white rounded-full hover:!bg-blue-700 hover:!text-white' : '' }}">
                    Home
                </a>
            </li>

            {{-- MENU --}}
            <li>
                <a href="{{ route('titiper.menu.index') }}"
                    class="px-5 py-2 hover:bg-transparent hover:text-blue-700
                    {{ request()->routeIs('titiper.menu.*') ? 'bg-blue-600 text-white rounded-full hover:!bg-blue-700 hover:!text-white' : '' }}">
                    Menu
                </a>
            </li>

            {{-- PESANAN (SUDAH DIPERBAIKI) --}}
            <li>
                <a href="{{ route('titiper.orders.index') }}"
                    class="px-5 py-2 hover:bg-transparent hover:text-blue-700
                    {{ request()->routeIs('titiper.orders.*') ? 'bg-blue-600 text-white rounded-full hover:!bg-blue-700 hover:!text-white' : '' }}">
                    Pesanan
                </a>
            </li>

            {{-- PROFIL --}}
            <li>
                <a href="{{ route('titiper.profile') }}"
                    class="px-5 py-2 hover:bg-transparent hover:text-blue-700
                    {{ request()->routeIs('titiper.profile') || request()->routeIs('profile.update')
                        ? 'bg-blue-600 text-white rounded-full hover:!bg-blue-700 hover:!text-white'
                        : '' }}">
                    Profil
                </a>
            </li>
        </ul>
    </div>

    {{-- MOBILE MENU --}}
    <div class="navbar-end lg:hidden">
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>
            <ul tabindex="0"
                class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52 text-black">
                <li>
                    <a href="{{ route('titiper.home') }}"
                        class="{{ request()->routeIs('titiper.home') ? 'active bg-blue-600 text-white' : '' }}">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('titiper.menu.index') }}"
                        class="{{ request()->routeIs('titiper.menu.*') ? 'active bg-blue-600 text-white' : '' }}">
                        Menu
                    </a>
                </li>

                {{-- PESANAN MOBILE (SUDAH DIPERBAIKI) --}}
                <li>
                    <a href="{{ route('titiper.orders.index') }}"
                        class="{{ request()->routeIs('titiper.orders.*') ? 'active bg-blue-600 text-white' : '' }}">
                        Pesanan
                    </a>
                </li>

                <li>
                    <a href="{{ route('titiper.profile') }}"
                        class="{{ request()->routeIs('titiper.profile') || request()->routeIs('profile.update') ? 'active bg-blue-600 text-white' : '' }}">
                        Profil
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
