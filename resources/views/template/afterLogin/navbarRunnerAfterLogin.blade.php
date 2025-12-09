<div class="navbar shadow-sm bg-white px-8 text-black font-bold">
  <!-- Navbar Start: Logo -->
  <div class="navbar-start">
    <a href="{{ route('runner.home') }}" class="btn btn-ghost normal-case text-3xl tracking-tight">
    <span class="text-blue-800 font-bold">TitipIn</span>
    </a>
  </div>

  <div class="navbar-end hidden lg:flex">
    <ul class="menu menu-horizontal px-4 gap-x-8 font-bold text-xl">
      <li><a href="{{ route('runner.home') }}">Home</a></li>
      <li><a href="#">Pesanan</a></li>
      <li><a href="#">Histori</a></li>
      <li><a href="#">Profil</a></li>
    </ul>
  </div>

  <div class="navbar-end lg:hidden">
    <div class="dropdown">
      <label tabindex="0" class="btn btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </label>
      <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="{{ route('runner.home') }}">Home</a></li>
        <li><a href="#">Pesanan</a></li>
        <li><a href="#">History</a></li>
        <li><a href="#">Profil</a></li>
      </ul>
    </div>
  </div>
</div>