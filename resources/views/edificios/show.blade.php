@extends('layouts.app')

@section('title', 'Detalle del Edificio')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Edificio: {{ $edificio->nombre }}</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Nombre:</div>
                    <div class="col-md-8">{{ $edificio->nombre }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Dirección:</div>
                    <div class="col-md-8">{{ $edificio->direccion }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Pisos:</div>
                    <div class="col-md-8">{{ $edificio->pisos }}</div>
                </div>

                <h4 class="mt-4">Aulas en este Edificio</h4>
                @if($edificio->aulas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Número</th>
                                    <th>Piso</th>
                                    <th>Capacidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($edificio->aulas as $aula)
                                <tr>
                                    <td>{{ $aula->numero }}</td>
                                    <td>{{ $aula->piso }}</td>
                                    <td>{{ $aula->capacidad }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning">
                        No hay aulas registradas en este edificio.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Agregar Aula</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('edificios.aulas.store', $edificio->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número de Aula *</label>
                        <input type="text" class="form-control @error('numero') is-invalid @enderror" 
                            id="numero" name="numero" value="{{ old('numero') }}" required>
                        @error('numero')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="piso" class="form-label">Piso *</label>
                        <input type="number" class="form-control @error('piso') is-invalid @enderror" 
                            id="piso" name="piso" value="{{ old('piso') }}" 
                            min="1" max="{{ $edificio->pisos }}" required>
                        @error('piso')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="capacidad" class="form-label">Capacidad *</label>
                        <input type="number" class="form-control @error('capacidad') is-invalid @enderror" 
                            id="capacidad" name="capacidad" value="{{ old('capacidad') }}" 
                            min="1" required>
                        @error('capacidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Agregar Aula</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('edificios.edit', $edificio) }}" class="btn btn-warning">Editar Edificio</a>
                    <form action="{{ route('edificios.destroy', $edificio) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" 
                            onclick="return confirm('¿Estás seguro de eliminar este edificio y todas sus aulas?')">
                            Eliminar Edificio
                        </button>
                    </form>
                    <a href="{{ route('edificios.index') }}" class="btn btn-secondary">Volver a la Lista</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection