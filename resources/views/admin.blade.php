@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded shadow">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Panel de Administración</h1>

        @livewire('admin-usuarios')
    </div>
@endsection
