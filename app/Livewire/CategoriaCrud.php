<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class CategoriaCrud extends Component
{
    public $nombre, $categoria_id;
    public $modoEdicion = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
    ];

    public function render()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('livewire.categoria-crud', compact('categorias'));
    }

    public function guardar()
    {
        $this->validate();

        Categoria::create(['nombre' => $this->nombre]);
        session()->flash('mensaje', 'Categoría creada correctamente.');
        $this->resetCampos();
    }

    public function editar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $this->categoria_id = $categoria->id;
        $this->nombre = $categoria->nombre;
        $this->modoEdicion = true;
    }

    public function actualizar()
    {
        $this->validate();

        $categoria = Categoria::findOrFail($this->categoria_id);
        $categoria->update(['nombre' => $this->nombre]);

        session()->flash('mensaje', 'Categoría actualizada correctamente.');
        $this->resetCampos();
    }

    public function eliminar($id)
    {
        Categoria::destroy($id);
        session()->flash('mensaje', 'Categoría eliminada.');
    }

    public function resetCampos()
    {
        $this->nombre = '';
        $this->categoria_id = null;
        $this->modoEdicion = false;
    }
}
