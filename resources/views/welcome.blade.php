@extends('layouts.app')

@section('title', 'Inicio - TUPBlog')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Bienvenido a TUPBlog</h1>

        @auth
            <p class="mt-2 text-green-600 dark:text-green-400">Hola, {{ Auth::user()->name }}</p>

            {{-- Formulario de creación --}}
            @livewire('post-crud', ['soloFormulario' => true]){{-- Formulario de creación --}}{{-- Formulario de creación --}}
        @else
            <p class="mt-2 text-gray-700 dark:text-gray-300">
                Explorá los últimos posts o
                <a href="{{ route('login') }}" class="text-blue-600 underline hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">iniciá sesión</a>
                para publicar el tuyo.
            </p>
        @endauth
    </div>

    {{-- Lista de posts públicos --}}
    @livewire('lista-posts-publicos')
@endsection
