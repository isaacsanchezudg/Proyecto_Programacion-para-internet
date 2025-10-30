@extends('layouts.app')

@section('title', 'Crear Edificio')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Registrar Nuevo Edificio</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('edificios.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Edificio *</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                            id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección *</label>
                        <input type="text" class="form-control @error('direccion') is-invalid @enderror" 
                            id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pisos" class="form-label">Número de Pisos *</label>
                        <input type="number" class="form-control @error('pisos') is-invalid @enderror" 
                            id="pisos" name="pisos" value="{{ old('pisos') }}" 
                            min="1" max="50" required>
                        @error('pisos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('edificios.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar Edificio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection