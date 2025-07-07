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
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <a href="{{ route('inicio') }}" class="flex ms-2 md:me-24">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="Logo TUPBlog" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">TUPBlog</span>
                </a>
            </div>

            {{-- Botón Crear y Login/Logout --}}
            <div class="flex items-center ms-3">
                @auth
                    <button onclick="Livewire.dispatch('abrirModalCrearDesdeNavbar')" class="bg-green-600 text-white px-4 py-2 rounded text-sm me-4 hover:bg-green-700">
                        Crear Post
                    </button>
                @endauth

                @auth
                @livewire('auth.logout')

                @else
                <a href="{{ route('login') }}"
                class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition-colors duration-200 dark:bg-blue-500 dark:hover:bg-blue-600">
                  Iniciar sesión
              </a>

                @endauth
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
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>


            @auth
                <li>
                    <a href="{{ route('mis-posts') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="ms-3">Mis Posts</span>
                    </a>
                </li>
            @endauth

            <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>

            @php
                use App\Models\Categoria;
                $categoriasNavbar = Categoria::orderBy('nombre')->get();
            @endphp

            <li>
                <button type="button" class="flex items-center justify-between w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group" onclick="toggleCategories()">
                    <span class="ms-3">Categorías</span>
                    <svg id="categories-arrow" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown-categorias" class="hidden pl-4 mt-2 space-y-2">
                    @foreach ($categoriasNavbar as $cat)
                        <a href="{{ route('posts.por-categoria', ['id' => $cat->id]) }}"
                           class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                            <span class="ms-3">{{ $cat->nombre }}</span>
                        </a>
                    @endforeach
                </div>
            </li>

            <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>

            @auth
                @if (auth()->user()->is_admin)
                    <li>
                        <a href="{{ route('admin.panel') }}" class="flex items-center p-2 text-red-600 rounded-lg hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-700 group">
                            <span class="ms-3">Panel de Administración</span>
                        </a>
                    </li>
                @endif
            @endauth
        </ul>
    </div>

    <script>
        function toggleCategories() {
            const dropdown = document.getElementById('dropdown-categorias');
            const arrow = document.getElementById('categories-arrow');
            
            dropdown.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }
    </script>

    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
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

{{-- script para toggle sidebar (Flowbite) --}}
<script>
    document.querySelectorAll('[data-drawer-toggle]').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-drawer-target');
            const sidebar = document.getElementById(targetId);
            sidebar.classList.toggle('-translate-x-full');
        });
    });

    document.querySelector('[data-dropdown-toggle="dropdown-categorias"]').addEventListener('click', () => {
        document.getElementById('dropdown-categorias').classList.toggle('hidden');
    });
</script>

</body>
</html>
