@extends('layouts.app')

@section('title', 'Nueva Película')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Nueva Película</div>
            <div class="card-body">
                <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
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
                            <option value="Acción" {{ old('classification') == 'Acción' ? 'selected' : '' }}>Acción</option>
                            <option value="Drama" {{ old('classification') == 'Drama' ? 'selected' : '' }}>Drama</option>
                            <option value="Comedia" {{ old('classification') == 'Comedia' ? 'selected' : '' }}>Comedia</option>
                            <option value="Suspenso" {{ old('classification') == 'Suspenso' ? 'selected' : '' }}>Suspenso</option>
                            <option value="Ciencia Ficción" {{ old('classification') == 'Ciencia Ficción' ? 'selected' : '' }}>Ciencia Ficción</option>
                        </select>
                        @error('classification')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="release_date" class="form-label">Fecha de Estreno</label>
                        <input type="date" class="form-control @error('release_date') is-invalid @enderror" id="release_date" name="release_date" value="{{ old('release_date') }}" required>
                        @error('release_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="review" class="form-label">Reseña</label>
                        <textarea class="form-control @error('review') is-invalid @enderror" id="review" name="review" rows="4" required>{{ old('review') }}</textarea>
                        @error('review')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="season" class="form-label">Temporada (si es serie)</label>
                        <input type="number" class="form-control @error('season') is-invalid @enderror" id="season" name="season" value="{{ old('season') }}">
                        @error('season')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 