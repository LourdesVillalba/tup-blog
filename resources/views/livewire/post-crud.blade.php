<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Crear Post</h2>
    

    @if (session()->has('mensaje'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-2 mb-4 rounded">
            {{ session('mensaje') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $modoEdicion ? 'actualizar' : 'guardar' }}" enctype="multipart/form-data">
    <div>
            <label class="block">Título</label>
            <input type="text" wire:model="titulo" class="w-full border p-2 rounded">
            @error('titulo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Contenido</label>
            <textarea wire:model="contenido" class="w-full border p-2 rounded"></textarea>
            @error('contenido') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Imagen (opcional)</label>
            <input type="file" wire:model="imagen">
            @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ $modoEdicion ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>

    <hr class="my-6">

    <h3 class="text-lg font-semibold mb-2">Tus Posts</h3>

    <ul>
        @foreach ($posts as $post)
            <li class="border-b py-2 flex justify-between items-center">
                <div>
                    <strong>{{ $post->titulo }}</strong><br>
                    <small>{{ Str::limit($post->contenido, 100) }}</small>
                    {{-- Mostrar imagen si existe --}}
                @if ($post->imagen)
                    <div class="mt-2">
                        <img src="{{ asset($post->imagen) }}" alt="Imagen del post" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
                </div>
                <div class="flex gap-2">
                    <button wire:click="editar({{ $post->id }})" class="text-blue-600">Editar</button>
                    <button wire:click="eliminar({{ $post->id }})" class="text-red-600">Eliminar</button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
