<div class="bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="max-w-xl w-full mx-auto p-8 bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <h2 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white text-center">Iniciar sesión</h2>

        <form wire:submit.prevent="login" class="space-y-6">
            {{-- Campo Email --}}
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Email
                </label>
                <input type="email" id="email" wire:model="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                    @error('email') border-red-500 dark:border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="tu@ejemplo.com">
                @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Error:</span> {{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Contraseña --}}
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Contraseña
                </label>
                <input type="password" id="password" wire:model="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                    @error('password') border-red-500 dark:border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="••••••••">
                @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Error:</span> {{ $message }}</p>
                @enderror
            </div>

            {{-- Recordarme --}}
            <div class="flex items-center">
                <input id="remember" type="checkbox" wire:model="remember"
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Recordarme</label>
            </div>

            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Entrar
            </button>
        </form>

        {{-- Enlace para registrarse --}}
        <p class="text-base font-light text-gray-500 dark:text-gray-400 mt-8 text-center">
            ¿No tienes una cuenta? <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Regístrate aquí</a>
        </p>
    </div>
</div>