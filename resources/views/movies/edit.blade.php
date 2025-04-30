@extends('layouts.app')

@section('title', 'Editar Película')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Editar Película</div>
            <div class="card-body">
                <form method="POST" action="{{ route('movies.update', $movie) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $movie->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="classification" class="form-label">Clasificación</label>
                        <select class="form-select @error('classification') is-invalid @enderror" id="classification" name="classification" required>
                            <option value="">Seleccione una clasificación</option>
                            <option value="Acción" {{ old('classification', $movie->classification) == 'Acción' ? 'selected' : '' }}>Acción</option>
                            <option value="Drama" {{ old('classification', $movie->classification) == 'Drama' ? 'selected' : '' }}>Drama</option>
                            <option value="Comedia" {{ old('classification', $movie->classification) == 'Comedia' ? 'selected' : '' }}>Comedia</option>
                            <option value="Suspenso" {{ old('classification', $movie->classification) == 'Suspenso' ? 'selected' : '' }}>Suspenso</option>
                            <option value="Ciencia Ficción" {{ old('classification', $movie->classification) == 'Ciencia Ficción' ? 'selected' : '' }}>Ciencia Ficción</option>
                        </select>
                        @error('classification')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="release_date" class="form-label">Fecha de Estreno</label>
                        <input type="date" class="form-control @error('release_date') is-invalid @enderror" id="release_date" name="release_date" value="{{ old('release_date', $movie->release_date->format('Y-m-d')) }}" required>
                        @error('release_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="review" class="form-label">Reseña</label>
                        <textarea class="form-control @error('review') is-invalid @enderror" id="review" name="review" rows="4" required>{{ old('review', $movie->review) }}</textarea>
                        @error('review')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="season" class="form-label">Temporada (si es serie)</label>
                        <input type="number" class="form-control @error('season') is-invalid @enderror" id="season" name="season" value="{{ old('season', $movie->season) }}">
                        @error('season')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen</label>
                        @if($movie->image_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $movie->image_path) }}" alt="{{ $movie->name }}" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 