@extends('layouts.app')

@section('title', 'Inicio - TUPBlog')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Bienvenido a TUPBlog</h1>

        @auth
            <p class="mt-2 text-green-600 dark:text-green-400">Hola, {{ Auth::user()->name }} 👋</p>

            {{-- Botón de Crear Post --}}
            <div class="mt-4">
                <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    Crear Post
                </a>
            </div>
        @else
            <p class="mt-2 text-gray-700 dark:text-gray-300">
                Explorá los últimos posts o
                <a href="{{ route('login') }}" class="text-blue-600 underline hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">iniciá sesión</a>
                para publicar el tuyo.
            </p>
        @endauth
    </div>

    {{-- Lista de Posts --}}
    <div class="flex flex-col gap-6">
        @forelse ($posts as $post)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition hover:shadow-lg">
                @if ($post->imagen)
                <img src="{{ asset('storage/' . $post->imagen) }}" alt="Imagen del post">
                @endif
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{ $post->titulo }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                        {{ Str::limit($post->contenido, 100) }}
                    </p>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Publicado por {{ $post->user->name }}</span>
                </div>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-300">No hay posts disponibles todavía.</p>
        @endforelse
    </div>
@endsection
