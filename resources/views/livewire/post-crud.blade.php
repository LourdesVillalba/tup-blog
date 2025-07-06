<div class="max-w-3xl mx-auto p-6 bg-gray-50 dark:bg-gray-800 rounded-lg shadow border text-gray-800 dark:text-gray-100">

    <h2 class="text-xl font-bold mb-4">
        {{ $soloFormulario ? 'Crear Post' : 'Editar Post' }}
    </h2>

    @if (session()->has('mensaje'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-2 mb-4 rounded">
            {{ session('mensaje') }}
        </div>
    @endif

    {{-- Mostrar formulario si $soloFormulario es true (crear post) o si se está editando --}}
    @if ($soloFormulario || $modoEdicion)
        <form wire:submit.prevent="{{ $modoEdicion ? 'actualizar' : 'guardar' }}" enctype="multipart/form-data" class="mb-6">
            <div class="mb-3">
                <label class="block">Título</label>
                <input type="text" wire:model="titulo" class="w-full border p-2 rounded dark:bg-gray-900 dark:text-white">
                @error('titulo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="block">Contenido</label>
                <textarea wire:model="contenido" class="w-full border p-2 rounded dark:bg-gray-900 dark:text-white"></textarea>
                @error('contenido') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block">Imagen</label>
                <input type="file" wire:model="imagen">
                @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    {{ $modoEdicion ? 'Actualizar' : 'Guardar' }}
                </button>

                @if ($modoEdicion)
                    <button type="button" wire:click="resetCampos" class="bg-gray-300 px-4 py-2 rounded dark:bg-gray-700 dark:text-white">Cancelar</button>
                @endif
            </div>
        </form>
    @endif

    {{-- Mostrar la lista solo si no estamos en modo "soloFormulario" --}}
    @if (!$soloFormulario)
        <ul class="space-y-4">
            @foreach ($posts as $post)
                <li class="border-b pb-4">
                    <h3 class="font-semibold">{{ $post->titulo }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ Str::limit($post->contenido, 100) }}</p>

                    @if ($post->imagen)
                        <img src="{{ asset('storage/' . $post->imagen) }}" class="mt-2 max-w-xs rounded">
                    @endif

                    <div class="mt-2 flex gap-4">
                        <button wire:click="editar({{ $post->id }})" class="text-blue-600 hover:underline">Editar</button>
                        <button wire:click="eliminar({{ $post->id }})" class="text-red-600 hover:underline">Eliminar</button>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

</div>
