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
    public $soloFormulario = false;
    public $mostrarModal = false;
    public $iteration = 0;////////
    protected $listeners = ['abrirModalCrearDesdeNavbar' => 'abrirModalCrear'];

    public $categoria_id;
    public $categorias;

    protected $rules = [
        'titulo' => 'required|string|max:255',
        'contenido' => 'required|string',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        $this->posts = Post::with('categoria')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
    
        return view('livewire.post-crud')->layout('layouts.app');
    }
    

    public function resetCampos()
    {
        $this->titulo = '';
        $this->contenido = '';
        $this->imagen = null;
        $this->categoria_id = null;
        $this->post_id = null;
        $this->modoEdicion = false;
        $this->iteration++;
    }

    public function guardar()
    {
        try {
            $this->validate();
    
            $imagenPath = $this->imagen ? $this->imagen->store('posts', 'public') : null;
    
            Post::create([
                'titulo' => $this->titulo,
                'contenido' => $this->contenido,
                'imagen' => $imagenPath,
                'categoria_id' => $this->categoria_id,
                'user_id' => Auth::id(),
            ]);
    
            session()->flash('mensaje', 'Post creado correctamente.');
            $this->dispatch('postCreado');
            $this->resetCampos();
            $this->mostrarModal = false;
        } catch (\Exception $e) {
            session()->flash('mensaje', 'Error al guardar: ' . $e->getMessage());
        }
    }
    
    

    public function editar($id)
    {
        $post = Post::findOrFail($id);
        $this->titulo = $post->titulo;
        $this->contenido = $post->contenido;
        $this->post_id = $post->id;
        $this->categoria_id = $post->categoria_id;
        $this->modoEdicion = true;
        $this->mostrarModal = true;
    }

        public function cerrarModal()
    {
        $this->reset(['titulo', 'contenido', 'imagen', 'categoria_id', 'modoEdicion']);
        $this->mostrarModal = false;
    }

    public function abrirModalCrear()
    {
        $this->resetCampos(); // Limpiar datos anteriores
        $this->modoEdicion = false;
        $this->mostrarModal = true;
    }

    public function actualizar()
    {
        $this->validate();
    
        $post = Post::findOrFail($this->post_id);
    
        if ($this->imagen && $post->imagen && \Storage::disk('public')->exists($post->imagen)) {
            \Storage::disk('public')->delete($post->imagen);
        }
    
        $imagenPath = $this->imagen ? $this->imagen->store('posts', 'public') : $post->imagen;
    
        $post->update([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'imagen' => $imagenPath,
            'categoria_id' => $this->categoria_id, // ✅ Esto era lo que faltaba
        ]);
    
        session()->flash('mensaje', 'Post actualizado correctamente.');
        $this->resetCampos();
        $this->mostrarModal = false;
    }
    

    

    public function eliminar($id)
    {
        $post = Post::findOrFail($id);
    
        // Eliminar imagen del storage si existe
        if ($post->imagen && \Storage::disk('public')->exists($post->imagen)) {
            \Storage::disk('public')->delete($post->imagen);
        }
    
        $post->delete();
    
        session()->flash('mensaje', 'Post eliminado correctamente.');
    }
    
    /////////////////////////////////////////////
    public function mount($soloFormulario = false)
    {
        $this->soloFormulario = $soloFormulario;
        $this->categorias = \App\Models\Categoria::orderBy('nombre')->get();
    }
    
}
