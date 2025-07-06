<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow text-gray-800 dark:text-gray-100">

    <h2 class="text-2xl font-bold mb-4">Administrar Usuarios</h2>

    @if (session()->has('mensaje'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-2 rounded mb-4">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="mb-4">
        <input type="text" wire:model.debounce.500ms="busqueda" placeholder="Buscar por nombre o email"
            class="w-full border px-4 py-2 rounded bg-white dark:bg-gray-900 dark:text-white">
    </div>

    <table class="w-full text-sm">
        <thead class="text-left text-gray-500 border-b dark:border-gray-700">
            <tr>
                <th class="py-2">Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($usuarios as $user)
                <tr class="border-b dark:border-gray-700">
                    <td class="py-2">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->id !== auth()->id())
                            <button wire:click="eliminar({{ $user->id }})"
                                class="text-red-600 hover:underline">Eliminar</button>
                        @else
                            <span class="text-gray-400">Tú</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-gray-500 py-4">No se encontraron usuarios.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
