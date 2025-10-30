@extends('layouts.app')

@section('title', 'Lista de Edificios')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Lista de Edificios</h1>
            <a href="{{ route('edificios.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Edificio
            </a>
        </div>

        @if($edificios->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Pisos</th>
                            <th>Aulas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($edificios as $edificio)
                        <tr>
                            <td>{{ $edificio->nombre }}</td>
                            <td>{{ $edificio->direccion }}</td>
                            <td>{{ $edificio->pisos }}</td>
                            <td>
                                <span class="badge bg-info">{{ $edificio->aulas_count }} aulas</span>
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('edificios.show', $edificio) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('edificios.edit', $edificio) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('edificios.destroy', $edificio) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('¿Estás seguro de eliminar este edificio?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">
                <h4>No hay edificios registrados</h4>
                <p>Comienza agregando el primer edificio al sistema.</p>
                <a href="{{ route('edificios.create') }}" class="btn btn-primary">Agregar Primer Edificio</a>
            </div>
        @endif
    </div>
</div>
@endsection