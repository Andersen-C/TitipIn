<div class="navbar shadow-sm bg-white px-8 text-black font-bold">
  <div class="navbar-start">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost normal-case text-3xl tracking-tight">
      <span class="text-blue-800 font-bold">TitipIn</span>
    </a>
  </div>

  {{-- Desktop Menu --}}
  <div class="navbar-end hidden lg:flex">
    <ul class="menu menu-horizontal px-4 gap-x-8 font-bold text-xl">

      <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li><a href="{{ route('users.index') }}">Manage</a></li>

      <li class="dropdown dropdown-bottom">
        <a tabindex="0" class="justify-between">
          Language
          <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path d="M7 10l5 5 5-5H7z" />
          </svg>
        </a>
        <ul tabindex="0" class="dropdown-content z-1 menu p-2 bg-white text-black shadow rounded-box w-52">
          <li><a href="#">English</a></li>
          <li><a href="#">Bahasa Indonesia</a></li>
        </ul>
      </li>

    {{-- Logout --}}
      <li>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="cursor-pointer">Logout</button>
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
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="#">Manage</a></li>

        {{-- Mobile Localization Dropdown (FIXED STRUCTURE) --}}
        <li class="dropdown dropdown-left">
          <a tabindex="0" class="justify-between">
            Language
            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path d="M7 10l5 5 5-5H7z" />
            </svg>
          </a>
          <ul tabindex="0" class="dropdown-content z-1 menu p-2 bg-white text-black shadow rounded-box w-40">
            <li><a href="#">English</a></li>
            <li><a href="#">Bahasa Indonesia</a></li>
          </ul>
        </li>

        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</div>
