<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class PostCrud extends Component
{
    use WithFileUploads;

    public $posts, $titulo, $contenido, $imagen, $post_id;
    public $modoEdicion = false;

    protected $rules = [
        'titulo' => 'required|string|max:255',
        'contenido' => 'required|string',
        'imagen' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        $this->posts = Post::where('user_id', Auth::id())->get();
        return view('livewire.post-crud')->layout('layouts.app');
    }

    public function resetCampos()
    {
        $this->titulo = '';
        $this->contenido = '';
        $this->imagen = null;
        $this->post_id = null;
        $this->modoEdicion = false;
    }

    public function guardar()
    {
        $this->validate();

        $imagenPath = $this->imagen ? $this->imagen->store('public/posts') : null;

        Post::create([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'imagen' => $imagenPath = $this->imagen ? $this->imagen->store('posts', 'public') : null,
            'user_id' => Auth::id(),
        ]);

        session()->flash('mensaje', 'Post creado correctamente.');
        $this->resetCampos();
    }

    public function editar($id)
    {
        $post = Post::findOrFail($id);

        $this->post_id = $post->id;
        $this->titulo = $post->titulo;
        $this->contenido = $post->contenido;
        $this->modoEdicion = true;
    }

    public function actualizar()
    {
        $this->validate();

        $post = Post::findOrFail($this->post_id);

        $imagenPath = $this->imagen ? $this->imagen->store('public/posts') : $post->imagen;

        $post->update([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'imagen' => $imagenPath ? str_replace('public/', 'storage/', $imagenPath) : null,
        ]);

        session()->flash('mensaje', 'Post actualizado correctamente.');
        $this->resetCampos();
    }

    public function eliminar($id)
    {
        Post::destroy($id);
        session()->flash('mensaje', 'Post eliminado correctamente.');
    }
}
