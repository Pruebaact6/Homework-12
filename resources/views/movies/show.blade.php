@extends('layouts.app')

@section('title', $movie->name)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-img-container">
                @if($movie->image_path)
                    <img src="{{ asset('storage/' . $movie->image_path) }}" class="card-img-top" alt="{{ $movie->name }}">
                @else
                    <img src="https://via.placeholder.com/300x450?text=No+Image" class="card-img-top" alt="No image available">
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <h1>{{ $movie->name }}</h1>
        <p class="text-muted">
            <strong>Clasificación:</strong> {{ $movie->classification }}<br>
            <strong>Fecha de Estreno:</strong> {{ $movie->release_date->format('d/m/Y') }}<br>
            @if($movie->season)
                <strong>Temporada:</strong> {{ $movie->season }}
            @endif
        </p>
        <h4>Reseña</h4>
        <p>{{ $movie->review }}</p>

        <div class="mt-4">
            <a href="{{ route('movies.edit', $movie) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
            </form>
            <a href="{{ route('movies.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>

@if($movie->characters->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <h2>Personajes</h2>
        <div class="row">
            @foreach($movie->characters as $character)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($character->image_path)
                        <img src="{{ asset('storage/' . $character->image_path) }}" class="card-img-top" alt="{{ $character->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $character->name }}</h5>
                        <p class="card-text">{{ Str::limit($character->description, 100) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection 