<div class="navbar shadow-sm bg-white px-8 text-black font-bold">
  <!-- Navbar Start: Logo -->
    <div class="navbar-start">
        <a href="{{ route('landing') }}"
            class="text-3xl font-extrabold tracking-tight px-4 hover:opacity-80 transition-opacity">
            <span class="text-sky-700">Titip</span><span class="text-yellow-400">In</span>
        </a>
    </div>

  <div class="navbar-end hidden lg:flex">
    <ul class="menu menu-horizontal px-4 gap-x-8 font-bold text-xl">
      <li><a href="{{ route('featurePage') }}" class="px-5 py-2 hover:bg-transparent hover:text-blue-700
             {{ request()->routeIs('featurePage') ? 'bg-blue-600 text-white rounded-full hover:!bg-blue-700 hover:!text-white' : '' }}">
            Fitur
          </a>
      </li>
      <li><a href="{{ route('HowItWorksPage') }}" class="px-5 py-2 hover:bg-transparent hover:text-blue-700
             {{ request()->routeIs('HowItWorks') ? 'bg-blue-600 text-white rounded-full hover:!bg-blue-700 hover:!text-white' : '' }}">
            Cara Kerja
          </a>
      </li>
      <li><a href="{{ route('loginPage') }}" class="px-5 py-2 hover:bg-transparent hover:text-blue-700
             {{ request()->routeIs('loginPage') ? 'bg-blue-600 text-white rounded-full hover:!bg-blue-700 hover:!text-white' : '' }}">
              Login
          </a>
      </li>
      <li><a href="{{ route('registerPage') }}" class="px-5 py-2 hover:bg-transparent hover:text-blue-700
             {{ request()->routeIs('registerPage') ? 'bg-blue-600 text-white rounded-full hover:!bg-blue-700 hover:!text-white' : '' }}">
              Register
          </a>
      </li>
    </ul>
  </div>

  <div class="navbar-end lg:hidden">
    <div class="dropdown">
      <label tabindex="0" class="btn btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </label>
      <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-white rounded-box w-20">
        <li><a href="{{ route('featurePage') }}">Fitur</a></li>
        <li><a href="{{ route('HowItWorksPage') }}">Cara Kerja</a></li>
        <li><a href="{{ route('loginPage') }}">Login</a></li>
        <li><a href="{{ route('registerPage') }}">Register</a></li>
      </ul>
    </div>
  </div>
</div>