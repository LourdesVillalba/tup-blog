<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\PostCrud;
use App\Models\Post; // Asegúrate de que este import esté presente

// Ruta para la página de inicio
Route::get('/', function () {
    $posts = Post::latest()->get(); // Obtiene los posts más recientes
    return view('welcome', compact('posts')); // Asegúrate de que el nombre de la vista sea 'inicio'
})->name('inicio');


// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Ruta para el componente Livewire PostCrud (gestión de posts del usuario)
    Route::get('/posts', PostCrud::class)->name('posts.index');
});

// Rutas de autenticación (login y registro)
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');