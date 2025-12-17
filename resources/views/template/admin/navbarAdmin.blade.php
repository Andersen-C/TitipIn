<div class="navbar shadow-sm bg-white px-8 text-black font-bold">
    <div class="navbar-start">
        <a href="{{ route('admin.dashboard') }}"
            class="text-3xl font-extrabold tracking-tight px-4 hover:opacity-80 transition-opacity">
            <span class="text-blue-700">Titip</span><span class="text-yellow-400">In</span>
        </a>
    </div>

  {{-- Desktop Menu --}}
  <div class="navbar-end hidden lg:flex">
    <ul class="menu menu-horizontal px-4 gap-x-8 font-bold text-xl">

      <li>
        <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 hover:bg-transparent hover:text-blue-700
        {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white rounded-full hover:!bg-blue-700 hover:!text-white' : '' }}">
          {{ __('navbarAdmin.Menu1') }}
        </a>
      </li>

      <li>
        <a href="{{ route('admin.manage') }}" class="px-5 py-2 hover:bg-transparent hover:text-blue-700
        {{ request()->routeIs('admin.manage') ? 'bg-blue-600 text-white rounded-full hover:!bg-blue-700 hover:!text-white' : '' }}">
          {{ __('navbarAdmin.Menu2') }}
        </a>
      </li>

      <li class="dropdown dropdown-bottom">
        <a tabindex="0" class="justify-between hover:bg-transparent hover:text-blue-700">
           {{ __('navbarAdmin.Menu3') }}
          <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path d="M7 10l5 5 5-5H7z" />
          </svg>
        </a>
        <ul tabindex="0" class="dropdown-content z-1 menu p-2 bg-white text-black shadow rounded-box w-52">
          <li><a href="{{ route('lang.switch', 'en') }}" class="hover:bg-transparent hover:text-blue-700">{{ __('navbarAdmin.SubMenu3-1') }}</a></li>
          <li><a href="{{ route('lang.switch', 'id') }}" class="hover:bg-transparent hover:text-blue-700">{{ __('navbarAdmin.SubMenu3-2') }}</a></li>
        </ul>
      </li>

    {{-- Logout --}}
      <li>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="cursor-pointer hover:bg-transparent hover:text-blue-700">{{ __('navbarAdmin.Menu4') }}</button>
        </form>
      </li>
    </ul>
  </div>

  {{-- Mobile Menu --}}
  <div class="navbar-end lg:hidden">
    <div class="dropdown">
      <label tabindex="0" class="btn btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </label>
      <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52 text-white">
        <li><a href="{{ route('admin.dashboard') }}">{{ __('navbarAdmin.Menu1') }}</a></li>
        <li><a href="{{ route('admin.manage') }}">{{ __('navbarAdmin.Menu2') }}</a></li>

        <li class="dropdown dropdown-left">
          <a tabindex="0" class="px-5 py-2 flex items-center gap-1 hover:bg-transparent hover:text-blue-700">
            {{ __('navbarAdmin.Menu3') }}
            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path d="M7 10l5 5 5-5H7z" />
            </svg>
          </a>
          <ul tabindex="0" class="dropdown-content z-1 menu p-2 bg-white text-black shadow rounded-box w-20">
            <li><a href="{{ route('lang.switch', 'en') }}">{{ __('navbarAdmin.SubMenu3-1') }}</a></li>
            <li><a href="{{ route('lang.switch', 'id') }}">{{ __('navbarAdmin.SubMenu3-2') }}</a></li>
          </ul>
        </li>

        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">{{ __('navbarAdmin.Menu4') }}</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</div>
