@extends('layouts.app')

@section('title', 'Películas')

@section('content')
<div class="row mb-4">
    <div class="col">
        <div class="btn-group" role="group">
            <a href="{{ route('movies.index') }}" class="btn btn-outline-primary">Todas</a>
            <a href="{{ route('movies.filter', 'recientes') }}" class="btn btn-outline-primary">Recientes</a>
            <a href="{{ route('movies.filter', 'proximos') }}" class="btn btn-outline-primary">Próximos Estrenos</a>
            <a href="{{ route('movies.filter', 'anteriores') }}" class="btn btn-outline-primary">Anteriores</a>
        </div>
    </div>
    <div class="col text-end">
        <a href="{{ route('movies.create') }}" class="btn btn-primary">Nueva Película</a>
    </div>
</div>

<div class="row">
    @foreach($movies as $movie)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-img-container">
                @if($movie->image_path)
                    <img src="{{ asset('storage/' . $movie->image_path) }}" class="card-img-top" alt="{{ $movie->name }}">
                @else
                    <img src="https://via.placeholder.com/300x450?text=No+Image" class="card-img-top" alt="No image available">
                @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $movie->name }}</h5>
                <p class="card-text">
                    <strong>Clasificación:</strong> {{ $movie->classification }}<br>
                    <strong>Fecha de Estreno:</strong> {{ $movie->release_date->format('d/m/Y') }}<br>
                    @if($movie->season)
                    <strong>Temporada:</strong> {{ $movie->season }}
                    @endif
                </p>
                <p class="card-text">{{ Str::limit($movie->review, 100) }}</p>
                <div class="btn-group">
                    <a href="{{ route('movies.show', $movie) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                    <a href="{{ route('movies.edit', $movie) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline">
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