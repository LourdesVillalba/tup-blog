<div class="max-w-md mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Registrarse</h2>

    <form wire:submit.prevent="register" class="space-y-4">
        <div>
            <label>Nombre</label>
            <input type="text" wire:model="name" class="w-full border rounded p-2">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

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
            <label>Confirmar contraseña</label>
            <input type="password" wire:model="password_confirmation" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Registrarse</button>
    </form>
</div>
