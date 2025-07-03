<div class="max-w-md mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Iniciar sesión</h2>

    <form wire:submit.prevent="login" class="space-y-4">
        <div>
            <label>Email</label>
            <input type="email" wire:model="email" class="w-full border rounded p-2">
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Contraseña</label>
            <input type="password" wire:model="password" class="w-full border rounded p-2">
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label><input type="checkbox" wire:model="remember"> Recordarme</label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Entrar</button>
    </form>
</div>
