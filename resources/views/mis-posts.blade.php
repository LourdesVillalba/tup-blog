@extends('layouts.app')

@section('title', 'Mis Posts')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Administrar mis publicaciones</h1>

    @livewire('post-crud')
@endsection
