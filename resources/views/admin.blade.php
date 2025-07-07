@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
    <div class="max-w-4xl mx-auto space-y-10">
        {{-- Sección de usuarios --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Administrar Usuarios</h2>
            @livewire('admin-usuarios')
        </div>

        {{-- Sección de categorías --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Administrar Categorías</h2>
            @livewire('categoria-crud')
        </div>
    </div>
@endsection
