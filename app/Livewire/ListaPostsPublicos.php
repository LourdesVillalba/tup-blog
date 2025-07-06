<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class ListaPostsPublicos extends Component
{
    public function render()
    {
        $posts = Post::latest()->get(); // todos los posts
        return view('livewire.lista-posts-publicos', compact('posts'));
    }

    protected $listeners = ['postCreado' => 'recargarPosts'];

    public function recargarPosts()
    {
        // simplemente vuelve a cargar los posts
    }
}
