<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Categoria;

class ListaPostsPublicos extends Component
{
    public $categoriaSeleccionada = null;
    public $categorias;

    protected $listeners = ['postCreado' => 'actualizarLista'];

    public function mount($id = null)
    {
        $this->categorias = Categoria::orderBy('nombre')->get();
        $this->categoriaSeleccionada = $id;
    }

    public function actualizarLista()
    {
        // Forzar re-render, Livewire lo hace automáticamente
    }

    public function render()
    {
        $query = Post::with(['user', 'categoria'])->latest();

        if ($this->categoriaSeleccionada) {
            $query->where('categoria_id', $this->categoriaSeleccionada);
        }

        $posts = $query->get();

        return view('livewire.lista-posts-publicos', compact('posts'))->layout('layouts.app');
    }
}

