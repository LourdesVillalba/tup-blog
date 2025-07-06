<div class="max-w-md mx-auto mt-10 p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white text-center">Registrarse</h2>

    <form wire:submit.prevent="register" class="space-y-5">
        {{-- Campo Nombre --}}
        <div>
            <label for="name" class="block mb-2 text-sm font-medium
                @error('name') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">
                Nombre
            </label>
            <input type="text" id="name" wire:model="name"
                class="
                    @error('name')
                        bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-red-500 dark:placeholder-red-500 dark:text-red-500
                    @else
                        bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                    @enderror
                    text-sm rounded-lg block w-full p-2.5"
                placeholder="Tu Nombre">
            @error('name')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Error:</span> {{ $message }}</p>
            @enderror
        </div>

        {{-- Campo Email --}}
        <div>
            <label for="email" class="block mb-2 text-sm font-medium
                @error('email') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">
                Email
            </label>
            <input type="email" id="email" wire:model="email"
                class="
                    @error('email')
                        bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-red-500 dark:placeholder-red-500 dark:text-red-500
                    @else
                        bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                    @enderror
                    text-sm rounded-lg block w-full p-2.5"
                placeholder="tu@ejemplo.com">
            @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Error:</span> {{ $message }}</p>
            @enderror
        </div>

        {{-- Campo Contraseña --}}
        <div>
            <label for="password" class="block mb-2 text-sm font-medium
                @error('password') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">
                Contraseña
            </label>
            <input type="password" id="password" wire:model="password"
                class="
                    @error('password')
                        bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-red-500 dark:placeholder-red-500 dark:text-red-500
                    @else
                        bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                    @enderror
                    text-sm rounded-lg block w-full p-2.5"
                placeholder="••••••••">
            @error('password')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Error:</span> {{ $message }}</p>
            @enderror
        </div>

        {{-- Campo Confirmar Contraseña --}}
        <div>
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Confirmar contraseña
            </label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation"
                class="bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                    text-sm rounded-lg block w-full p-2.5"
                placeholder="••••••••">
            {{-- Normalmente, el error de password_confirmation se maneja en el campo 'password' por la regla 'confirmed' --}}
            @error('password_confirmation') 
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Error:</span> {{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Registrarse
        </button>
    </form>

    {{-- Enlace para iniciar sesión --}}
    <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-6 text-center">
        ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Inicia sesión aquí</a>
    </p>
</div>