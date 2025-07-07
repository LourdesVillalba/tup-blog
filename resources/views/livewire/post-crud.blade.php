<div class="max-w-5xl mx-auto p-6 bg-gray-50 dark:bg-gray-900 rounded-lg shadow text-gray-800 dark:text-gray-100">


    @if (session()->has('mensaje'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-2 mb-4 rounded">
            {{ session('mensaje') }}
        </div>
    @endif

    {{-- Mostrar formulario si $soloFormulario es true (crear post) o si se está editando --}}
    @if ($soloFormulario || $modoEdicion)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 {{ $mostrarModal ? '' : 'hidden' }}">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg w-full max-w-xl">
            <h2 class="text-xl font-bold mb-4">Editar Post</h2>
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

                <div class="mb-3">
                    <label class="block">Categoría</label>
                    <select wire:model="categoria_id" class="w-full border p-2 rounded dark:bg-gray-900 dark:text-white">
                        <option value="">-- Seleccioná una categoría --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>


                <div class="mb-4">
                    <label class="block">Imagen</label>
                    <input type="file" wire:model="imagen" :key="$iteration">
                    @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    @if ($imagen)
                    <p class="text-green-600 text-sm mt-2">Imagen seleccionada: {{ $imagen->getClientOriginalName() }}</p>
                    @endif
                </div>
 
                <div class="flex justify-end gap-2 mt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
                    <button type="button" wire:click="cerrarModal" class="bg-gray-300 px-4 py-2 rounded dark:bg-gray-700 dark:text-white">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    @if ($mostrarModal && !$modoEdicion)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg w-full max-w-xl">
            <h2 class="text-xl font-bold mb-4">Crear Post</h2>
            <form wire:submit.prevent="guardar" enctype="multipart/form-data" class="mb-6">
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

                <div class="mb-3">
                    <label class="block">Categoría</label>
                    <select wire:model="categoria_id" class="w-full border p-2 rounded dark:bg-gray-900 dark:text-white">
                        <option value="">-- Seleccioná una categoría --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>


                <div class="mb-4">
                    <label class="block">Imagen</label>
                    <input type="file" wire:model="imagen" :key="$iteration">
                    @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    @if ($imagen)
                        <p class="text-green-600 text-sm mt-2">Imagen seleccionada: {{ $imagen->getClientOriginalName() }}</p>
                    @endif

                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
                    <button type="button" wire:click="cerrarModal" class="bg-gray-300 px-4 py-2 rounded dark:bg-gray-700 dark:text-white">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    @endif


    {{-- Mostrar la lista solo si no estamos en modo "soloFormulario" --}}
@if (!$soloFormulario)
<div class="space-y-6"> {{-- Contenedor principal con espacio entre tarjetas --}}
    @forelse ($posts as $post)
        <div class="relative flex flex-col md:flex-row items-center bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 overflow-hidden">
            @if ($post->imagen)
                <div class="w-full md:w-48 h-48 md:h-auto overflow-hidden flex-shrink-0">
                    <img class="object-cover w-full h-full rounded-t-lg md:rounded-none md:rounded-l-lg" src="{{ asset('storage/' . $post->imagen) }}" alt="Imagen del post: {{ $post->titulo }}">
                </div>
            @endif
            <div class="flex flex-col justify-between p-4 leading-normal w-full">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->titulo }}</h5>
                
                {{-- Badge de la categoría en la esquina superior derecha --}}
                @if ($post->categoria)
                    <span class="absolute top-3 right-3 px-3 py-1 text-sm bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full z-10">
                        {{ $post->categoria->nombre }}
                    </span>
                @endif

                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Str::limit($post->contenido, 120) }}</p>
                <div class="flex justify-between items-center text-sm text-gray-500 dark:text-gray-400 mt-2">
                    {{-- Usando el formato de fecha d/m/Y --}}
                    <span>Publicado: {{ $post->created_at->format('d/m/Y') }}</span> 
                    <div class="flex gap-3">
                        <button wire:click="editar({{ $post->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</button>
                        <button wire:click="eliminar({{ $post->id }})" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-lg text-gray-600 dark:text-gray-300 py-8">No has creado ningún post todavía.</p>
    @endforelse
</div>
@endif

