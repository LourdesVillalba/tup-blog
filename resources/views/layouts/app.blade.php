<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'TUPBlog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">

{{-- Navbar fijo superior --}}
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
      <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
          <div class="flex items-center justify-start rtl:justify-end">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
             </button>
            <a href="{{ route('inicio') }}" class="flex ms-2 md:me-24">
              <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="Logo TUPBlog" />
              <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">TUPBlog</span>
            </a>
          </div>
          <div class="flex items-center">
          @auth
              <button 
                  onclick="Livewire.dispatch('abrirModalCrearDesdeNavbar')" 
                  class="bg-green-600 text-white px-4 py-2 rounded text-sm me-4 hover:bg-green-700"
              >
                  Crear Post
              </button>
          @endauth
              <div class="flex items-center ms-3">
                <div>
                  <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    @auth
                        <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url ?? 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}" alt="{{ Auth::user()->name }}">
                    @else
                        <svg class="w-8 h-8 rounded-full bg-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" >
                            <circle cx="12" cy="12" r="10" stroke="none"></circle>
                            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        </svg>
                    @endauth
                  </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                  @auth
                    <div class="px-4 py-3" role="none">
                      <p class="text-sm text-gray-900 dark:text-white" role="none">
                        {{ Auth::user()->name }}
                      </p>
                      <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                        {{ Auth::user()->email }}
                      </p>
                    </div>
                    <ul class="py-1" role="none">
                      <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                      </li>
                      <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                      </li>
                      <li>
                        {{-- Logout Livewire --}}
                        @livewire('auth.logout')
                      </li>
                    </ul>
                  @else
                    <div class="px-4 py-3" role="none">
                      <p class="text-sm text-gray-900 dark:text-white" role="none">Invitado</p>
                    </div>
                    <ul class="py-1" role="none">
                      <li><a href="{{ route('login') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">Iniciar sesión</a></li>
                      <li><a href="{{ route('register') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">Registrarse</a></li>
                    </ul>
                  @endauth
                </div>
              </div>
            </div>
        </div>
      </div>
    </nav>

    {{-- Sidebar --}}
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full sm:translate-x-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
       <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
          <ul class="space-y-2 font-medium">
             <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                   {{-- ícono SVG aquí --}}
                   <span class="ms-3">Dashboard</span>
                </a>
             </li>
             {{-- Agrega más ítems aquí --}}
             @auth
                <a href="{{ route('mis-posts') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                    Mis Posts
                </a>
            @endauth
             <li>
                @livewire('auth.logout')
            </li>
          </ul>
       </div>
    </aside>

    {{-- Contenido principal --}}
    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

        {{-- contenido Blade tradicional --}}
        @yield('content')

        {{-- Para Livewire slot --}}
        @isset($slot)
            {{ $slot }}
        @endisset
        </div>
    </div>

    @livewireScripts

    {{-- Opcional: script para toggle sidebar (usando Flowbite) --}}
    <script>
      document.querySelectorAll('[data-drawer-toggle]').forEach(button => {
        button.addEventListener('click', () => {
          const targetId = button.getAttribute('data-drawer-target');
          const sidebar = document.getElementById(targetId);
          sidebar.classList.toggle('-translate-x-full');
        });
      });
    </script>
</body>
</html>
