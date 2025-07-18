<div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow space-y-6">
    @forelse ($posts as $post)
        {{-- Card de cada post --}}
        <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-md hover:shadow-lg transition-all duration-300 ease-in-out relative"> 
            {{-- Sección de la imagen (si existe) --}}
            @if ($post->imagen)
                <div class="w-full h-48 sm:h-64 overflow-hidden rounded-t-lg">
                    <img src="{{ asset('storage/' . $post->imagen) }}" alt="Imagen del post: {{ $post->titulo }}" class="w-full h-full object-cover transition-transform duration-300 ease-in-out transform hover:scale-105">
                </div>
            @endif

            {{-- Contenido del post --}}
            <div class="p-5">
                {{-- Título del post --}}
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 leading-tight hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                    {{ $post->titulo }}
                </h2>
                
                {{-- Badge de la categoría --}}
                @if ($post->categoria)
                    <span class="absolute top-3 right-3 px-3 py-1 text-sm bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full z-10">
                        {{ $post->categoria->nombre }}
                    </span>
                @endif

                {{-- Contenido limitado del post --}}
                <p class="text-base text-gray-700 dark:text-gray-300 mb-4">
                    {{ Str::limit($post->contenido, 150) }}
                </p>

                {{-- Meta información: Autor y Fecha --}}
                <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                    <span>Publicado por <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $post->user->name }}</span></span>
                    <span>
                        {{ $post->created_at->format('d/m/Y') }}
                    </span>
                </div>
            </div>
        </div>
    @empty
        <p class="text-lg text-gray-600 dark:text-gray-300 text-center py-8">No hay posts disponibles todavía.</p>
    @endforelse
</div>
