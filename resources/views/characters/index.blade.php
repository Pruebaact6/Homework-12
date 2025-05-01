@extends('layouts.app')

@section('title', 'Personajes')

@section('content')
<div class="row mb-4">
    <div class="col text-end">
        <a href="{{ route('characters.create') }}" class="btn btn-primary">Nuevo Personaje</a>
    </div>
</div>

<div class="row">
    @foreach($characters as $character)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="character-img-container">
                @if($character->image_path)
                    <img src="{{ asset('storage/' . $character->image_path) }}" class="card-img-top" alt="{{ $character->name }}">
                @else
                    <img src="https://via.placeholder.com/300x300?text=No+Image" class="card-img-top" alt="No image available">
                @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $character->name }}</h5>
                <p class="card-text">{{ Str::limit($character->description, 100) }}</p>
                <p class="card-text">
                    <small class="text-muted">
                        Película: {{ $character->movie->name }}
                    </small>
                </p>
                <div class="btn-group">
                    <a href="{{ route('characters.show', $character) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                    <a href="{{ route('characters.edit', $character) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    <form action="{{ route('characters.destroy', $character) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection 