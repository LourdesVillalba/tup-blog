<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class AdminUsuarios extends Component
{
    public $busqueda = '';

    public function eliminar($id)
    {
        if ($id == auth()->id()) {
            session()->flash('mensaje', 'No podés eliminarte a vos mismo.');
            return;
        }

        User::destroy($id);
        session()->flash('mensaje', 'Usuario eliminado correctamente.');
    }

    public function render()
    {
        $usuarios = User::query()
            ->where('name', 'like', '%' . $this->busqueda . '%')
            ->orWhere('email', 'like', '%' . $this->busqueda . '%')
            ->orderBy('name')
            ->get();

        return view('livewire.admin-usuarios', compact('usuarios'));
    }
}

