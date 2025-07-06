<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\PostCrud;
use App\Models\Post; 


// Ruta para la página de inicio
Route::get('/', function () {
    $posts = Post::latest()->get(); // Obtiene los posts más recientes
    return view('welcome', compact('posts')); 
})->name('inicio');


// Rutas protegidas por autenticación
/*REVISAR RUTA */
Route::middleware(['auth'])->group(function () {
    Route::get('/posts', PostCrud::class)->name('posts.index');
});

// Rutas de autenticación (login y registro)
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');


/////////////////////////////////////////////////////////
Route::get('/mis-posts', function () {
    return view('mis-posts');
})->middleware('auth')->name('mis-posts');


// Middleware para admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin.panel');
});

