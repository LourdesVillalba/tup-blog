<div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 rounded shadow space-y-6">
    @forelse ($posts as $post)
        <div class="rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 shadow-sm hover:shadow-md transition">
            @if ($post->imagen)
                <img src="{{ asset('storage/' . $post->imagen) }}" alt="Imagen del post" class="max-w-xs w-full mx-auto mb-4 rounded">
            @endif
            <div class="p-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{ $post->titulo }}</h2>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                    {{ Str::limit($post->contenido, 100) }}
                </p>
                <span class="text-xs text-gray-500 dark:text-gray-400">Publicado por {{ $post->user->name }}</span>
            </div>
        </div>
    @empty
        <p class="text-gray-600 dark:text-gray-300">No hay posts disponibles todavía.</p>
    @endforelse
</div>
