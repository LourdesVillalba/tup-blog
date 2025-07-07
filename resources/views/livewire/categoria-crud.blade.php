<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow text-gray-800 dark:text-gray-100">
    <h2 class="text-2xl font-bold mb-4">Gestión de Categorías</h2>

    @if (session()->has('mensaje'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-2 mb-4 rounded">
            {{ session('mensaje') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $modoEdicion ? 'actualizar' : 'guardar' }}" class="mb-4">
        <input type="text" wire:model="nombre" placeholder="Nombre de la categoría" class="w-full p-2 rounded border dark:bg-gray-900 dark:text-white mb-2">
        @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ $modoEdicion ? 'Actualizar' : 'Crear' }}
        </button>
    </form>

    <ul class="divide-y dark:divide-gray-700">
        @foreach ($categorias as $categoria)
            <li class="py-2 flex justify-between items-center">
                <span>{{ $categoria->nombre }}</span>
                <div class="flex gap-2">
                    <button wire:click="editar({{ $categoria->id }})" class="text-blue-600 hover:underline">Editar</button>
                    <button wire:click="eliminar({{ $categoria->id }})" class="text-red-600 hover:underline">Eliminar</button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
