<div class="flex items-center ms-3">
    @auth
        <button wire:click="salir" class="
            px-3 py-1.5  <!-- Aumentado de py-1 a py-1.5 -->
            text-sm font-medium 
            text-white 
            bg-red-600 hover:bg-red-700 
            rounded 
            shadow 
            transition-colors duration-200
            me-3
            focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2
            dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-600
            flex items-center
            h-9  <!-- Altura fija para consistencia -->
        ">
            Cerrar sesión
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
        </button>
    @endauth
</div>
