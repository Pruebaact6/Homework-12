@extends('layouts.app')

@section('title', $character->name)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="character-img-container">
                @if($character->image_path)
                    <img src="{{ asset('storage/' . $character->image_path) }}" class="card-img-top" alt="{{ $character->name }}">
                @else
                    <img src="https://via.placeholder.com/300x300?text=No+Image" class="card-img-top" alt="No image available">
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <h1>{{ $character->name }}</h1>
        <p class="text-muted">
            <strong>Película:</strong> {{ $character->movie->name }}
        </p>
        <h4>Descripción</h4>
        <p>{{ $character->description }}</p>

        <div class="mt-4">
            <a href="{{ route('characters.edit', $character) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('characters.destroy', $character) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
            </form>
            <a href="{{ route('characters.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection 